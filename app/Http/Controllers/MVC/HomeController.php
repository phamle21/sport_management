<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('client.index.index');
    }

    public function about()
    {
        return view('client.about.about');
    }

    public function login()
    {

        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('client.auth.login');
    }

    public function loginSubmit(Request $request)
    {
        $login_email = [
            'email' =>  $request->username,
            'password' => $request->password,
        ];

        $login_phone = [
            'phone' => $request->username,
            'password' => $request->password
        ];

        if ((Auth::attempt($login_email) || Auth::attempt($login_phone))) {
            return back();
        } else {
            return back()->with('error', 'Tài khoản hoặc mật khẩu sai!');
        }
    }

    public function register()
    {
        return view('client.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $checkTK = DB::table('users')
            ->where('phone', $request->phone)
            ->orWhere('email', $request->email)
            ->get();

        if (count($checkTK) > 0) {
            return back()->with('notify_fail', 'Sđt hoặc email đã tồn tại!');
        }

        if ($request->password != $request->repass) {
            return back()->with('notify_fail', 'Mật khẩu xác nhận không chính xác');
        }

        $createTK = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        if ($createTK) {
            return back()->with('notify_success', 'Tạo tài khoản thành công!!!');
        } else {
            return back()->with('notify_fail', 'Lỗi tạo tài khoản không thành công!!!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
