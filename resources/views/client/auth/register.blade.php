@extends('client.master.template')

@section('body_content')
    <!-- Login Section Section Starts Here -->
    <div class="login-section padding-top padding-bottom">
        <div class=" container">
            <div class="account-wrapper">
                <h3 class="title">{{ __('register.register') }}</h3>
                <form class="account-form" method="POST" action="{{ route('register.submit') }}">
                    <div class="form-group">
                        <input type="text" placeholder="{{ __('register.name') }}" name="name">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="{{ __('register.check-email') }}" onchange="checkEmail(this.value)" name="email">
                        <p id="err-email" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="{{ __('register.phone') }}" onchange="checkPhone(this.value)" name="phone">
                        <p id="err-phone" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="{{ __('register.password') }}" name="password">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" onkeyup="checkRePass(this.val)" placeholder="{{ __('register.re-password') }}"
                            name="password">
                        <p id="err-repass" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                        <button class="d-block default-button"><span>{{ __('register.submit') }}</span></button>
                    </div>
                </form>
                <div class="account-bottom">
                    <span class="d-block cate pt-10">{{ __('register.text') }} <a href="/login">{{ __('register.login') }}</a></span>
                    <span class="or"><span>or</span></span>
                    <ul class="match-social-list d-flex flex-wrap align-items-center justify-content-center mt-4">
                        <li>
                            <a class="ml-1 btn btn-primary border-0 m-0 p-0 mx-3" href="{{ url('auth/facebook') }}"
                                id="btn-fblogin" style="width: 3rem; height: 3rem; border-radius: 50%;">
                                <i class="fa-brands fa-facebook" style="font-size: 3rem"></i>
                            </a>
                        </li>
                        <li>
                            <a class="ml-1 btn btn-primary border-0 m-0 p-0 mx-3" href="{{ route('auth.google') }}"
                                id="btn-fblogin" style="width: 3rem; height: 3rem; border-radius: 50%;">
                                <img src="https://e7.pngegg.com/pngimages/337/722/png-clipart-google-search-google-account-google-s-google-play-google-company-text.png"
                                    style=" border-radius: 50%">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function checkEmail(val) {
            $.ajax({
                type: "POST",
                url: "/api/users/check-account",
                data: {
                    type: "Email",
                    value: val
                },
                success: function(res) {
                    console.log
                    if (res.status === 'email_exists') {
                        $('#err-email').html('Đã tồn tại email')
                    } else {
                        $('#err-email').html('')
                    }
                }
            })
        }

        function checkPhone(val) {
            $.ajax({
                type: "POST",
                url: "/api/users/check-account",
                data: {
                    type: "Phone",
                    value: val
                },
                success: function(res) {
                    console.log
                    if (res.status === 'phone_exists') {
                        $('#err-phone').html('Đã tồn tại số điện thoại')
                    } else {
                        $('#err-phone').html('')
                    }
                }
            })
        }

        function checkRePass(val) {
            const pass = $('#password').val();
            if (pass !== val) {
                $('#err-repass').html('Mật khẩu xác nhận không đúng')
            } else {
                $('#err-repass').html('')
            }
        }
    </script>
@endsection
