<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Sponsor;
use App\Models\Sponsorship;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Stripe;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    public function index($league_id)
    {
        $tournament = League::find($league_id);
        $sponsor_list_1 = Sponsor::where('user_id', Auth::user()->id)->get();
        $sponsor_list_2 = Auth::user()->sponsors;
        $sponsor_list = [];

        foreach ($sponsor_list_1 as $v) {
            $sponsor_list[] = $v;
        }
        foreach ($sponsor_list_2 as $v) {
            $sponsor_list[] = $v;
        }
        $sponsor_list = array_unique($sponsor_list);



        return view('client.tournament.sponsor', compact('tournament', 'sponsor_list'));
    }

    protected function base64ImgToFile($img)
    {
        $folderPath = "storage/sponsor/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imgName = uniqid() . '.' . $image_type;
        $file = $folderPath . $imgName;

        file_put_contents($file, $image_base64);

        return 'sponsor/' . $imgName;
    }

    protected function convertFileToBase64($file)
    {
        $path = "storage/$file";
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }

    public function processing(Request $request)
    {
        if ($request->payment_method == "paypal") {
            Session::flash('error', 'Phương thức thanh toán paypal đang được bảo trì, xin hãy quay lại sau');
            return back();
        }

        if ($request->payment_method == "stripe") {
            if ($request->select_status == "new") {
                // kiểm tra có files sẽ xử lý
                if ($request->hasFile('sponsor_logo')) {
                    $allowedfileExtension = ['jpg', 'jpeg', 'tiff', 'psd', 'eps', 'gif', 'png', 'raw', 'svg',];
                    $files = $request->file('sponsor_logo');
                    // flag xem có thực hiện lưu DB không. Mặc định là có
                    $exe_flg = true;

                    // kiểm tra tất cả các files xem có đuôi mở rộng đúng không
                    foreach ($files as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);

                        if (!$check) {
                            // nếu có file nào không đúng đuôi mở rộng thì đổi flag thành false
                            $exe_flg = false;
                            break;
                        }
                    }

                    // nếu không có file nào vi phạm validate thì tiến hành lưu DB
                    if ($exe_flg) {

                        // Thực hiện lưu file
                        $file = $request->file('sponsor_logo');
                        $extension = $file->getClientOriginalExtension();

                        $storagePath = Storage::put('public/sponsor/logo', $file);
                        $path_logo = 'storage/sponsor/logo/' . basename($storagePath);
                    } else {
                        return redirect()->back()->with('error', 'Logo tải lên không đúng định dạng.');
                    }
                } else {
                    return redirect()->back()->with('error', 'Chưa tải lên logo.');
                }

                $sponsor = Sponsor::create([
                    'name' => $request->sponsor_name,
                    'logo' => $path_logo,
                    'introduce' => $request->sponsor_introduce,
                    'link' => $request->sponsor_link,
                    'user_id' => Auth::user()->id,
                ]);

                $sponsor_id = $sponsor->id;
            } elseif ($request->select_status == "old") {
                $sponsor_id = $request->sponsor_select;
            } else {
                Session::flash('error', __('sponsor.payment.payment-err'));
                return back();
            }

            $amount = $request->sponsor_amount;

            if ($amount < 1) {
                Session::flash('error', __('sponsor.payment.payment-err-minimun-amount'));
                return back();
            }

            $league_id = $request->league_id;
            $tournament = League::find($request->league_id);
            return view('client.tournament.payment-sponsor-stripe', compact(
                'amount',
                'sponsor_id',
                'league_id',
                'tournament'
            ));
        }
    }

    public function processStripe(Request $request)
    {
        $amount = $request->amount;
        $sponsor_id = $request->sponsor_id;

        $vnd_to_usd = 0.000042326316; // 1vnd = 0.000042326316 USD
        $vnd_to_aud = 0.000062; // 1vnd = 0,000062 AUD


        $amount_payment = $amount * $vnd_to_aud * 100;

        $token = $request->token;
        $scheme = $request->scheme;

        $merchantCode = '5AR0055';
        $clientId = '0oaxb9i8P9vQdXTsn3l5';
        $clientSecret = '0aBsGU3x1bc-UIF_vDBA2JzjpCPHjoCP7oI6jisp';
        $oauthEndpoint = 'https://welcome.api2.sandbox.auspost.com.au/oauth/token';
        $restAPIEndpoint = 'https://payments-stest.npe.auspost.zone/v2/';
        $cookieName = 'SecurePayAccessTokenUAT';

        $accessToken = NULL;

        if (!isset($_COOKIE[$cookieName])) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $oauthEndpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Basic ' . base64_encode("$clientId:$clientSecret"),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials&audience=https://api.payments.auspost.com.au');

            $response = json_decode(curl_exec($ch));
            setcookie($cookieName, $response->access_token, time() + ($response->expires_in), "/");
            $accessToken = $response->access_token;

            curl_close($ch);
        } else {
            $accessToken = $_COOKIE[$cookieName];
        }

        if ($accessToken) {

            // Create payment
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                //whether ip is from proxy
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                //whether ip is from remote address
                $ip_address = $_SERVER['REMOTE_ADDR'];
            }

            $paymentData = [
                'amount' => $amount_payment,
                'merchantCode' => $merchantCode,
                'token' => $token,
                'ip' => $ip_address,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $restAPIEndpoint . 'payments');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accessToken,
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));

            $response = (array) json_decode(curl_exec($ch));

            if (isset($response['errors'])) {
                print_r(json_encode(['status' => 'error', 'message' => $response['errors'][0]->detail]));
            } else {
                if ($response['status'] !== 'paid') {
                    print_r(json_encode(['status' => 'error', 'message' => $response['gatewayResponseMessage']]));
                } else {

                    $infor_sponsorship = Sponsorship::create([
                        'user_id' => Auth::user()->id,
                        'sponsor_payment_amount' => $amount,
                        'sponsor_payment_oder_id' => $response['orderId'],
                        'sponsor_payment_status' => $response['status'],
                        'sponsor_payment_link' => '',
                        'sponsor_payment_method' => $scheme,
                        'sponsor_id' => $sponsor_id,
                        'league_id' => $request->league_id,
                    ]);

                    $infor_sponsorship->time = date("d/m/Y H:i:s", strtotime($response['createdAt']));

                    $email_league = User::find(League::find($request->league_id)->user_id)->email;

                    Mail::send('emails.confirmSponsorForLeague', ['infor_sponsorship' => $infor_sponsorship], function ($message) use ($email_league) {
                        $message->to([$email_league, Auth::user()->email]);
                        $message->subject('Reset Password');
                    });

                    print_r(json_encode(['status' => 'success', 'message' => $response['gatewayResponseMessage']]));
                }
            }

            curl_close($ch);
        }
    }
}
