<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Sponsor;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Stripe;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        // Card Name: Test
        // Card Number: 4242424242424242
        // Month: 04
        // Year: 2024
        // CVV: 123
        
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

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $payment = Stripe\Charge::create([
            "amount" => $amount * 100,
            "currency" => "USD",
            "source" => $request->stripeToken,
            "description" => "This payment is testing purpose of websolutionstuff",
        ]);

        if ($payment->status != "succeeded") {
            Session::flash('error', "Payment status: " . $payment->status);
            return back();
        }



        Sponsorship::create([
            'user_id' => Auth::user()->id,
            'sponsor_amount' => $amount,
            'sponsor_oder_id' => $payment->id,
            'sponsor_status' => $payment->status,
            'sponsor_link' => $payment->receipt_url,
            'sponsor_method' => $payment->payment_method_details->card->brand,
            'sponsor_id' => $sponsor_id,
            'league_id' => $request->league_id,
        ]);

        Session::flash('success', __('sponsor.payment.payment-success') . "<br> Receipt: <a href='$payment->receipt_url' target='_blacnk'>$payment->receipt_url</a>");

        return back();
    }
}
