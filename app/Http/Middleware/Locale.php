<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Lấy dữ liệu lưu trong Session, không có thì trả về default lấy trong config
        $language = Session::get('website_language', config('app.locale'));

        // Chuyển ứng dụng sang ngôn ngữ được chọn
        config(['app.locale' => $language]);

        return $next($request);
    }
}
