@extends('client.master.template')

@section('body_content')
    <!-- Login Section Section Starts Here -->
    <div class="login-section padding-top padding-bottom">
        <div class=" container">
            <div class="account-wrapper">
                <h3 class="title">Login</h3>
                <form class="account-form" method="POST" action="{{ route('login.submit') }}">
                    <div class="form-group">
                        <input type="text" placeholder="Email or Phone number" name="username">
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between flex-wrap pt-sm-2">
                            {{-- <div class="checkgroup">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Remember Me</label>
                            </div> --}}
                            {{-- <a href="#">Forget Password?</a> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="d-block default-button"><span>Submit Now</span></button>
                    </div>
                </form>
                <div class="account-bottom">
                    <span class="d-block cate pt-10">Don’t Have any Account? <a href="/register"> Sign Up</a></span>
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
    <!-- Login Section Section Ends Here -->
@endsection
