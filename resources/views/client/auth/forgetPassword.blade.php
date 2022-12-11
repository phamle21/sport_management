@extends('client.master.template')

@section('body_content')
    <!-- Login Section Section Starts Here -->
    <div class="login-section padding-top padding-bottom">
        <div class=" container">
            <div class="account-wrapper">

                <form action="{{ route('forget.password.post') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group w-100 text-center d-flex justify-content-center mt-3">
                        <button class="d-block default-button"><span>Lấy lại mật khẩu</span></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->
@endsection
