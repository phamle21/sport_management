<div
    style="
            height: auto !important;
            max-width: 600px !important;
            font-family: Helvetica, Arial, sans-serif !important;
            margin-bottom: 40px;
            margin-left: auto;
            margin-right: auto;
          ">
    <div style="margin-bottom: 100px">
        <div
            style="
                border-top-left-radius: 30px;
                border-top-right-radius: 30px;
                background-image: linear-gradient(#efff00,#fefff4);
                display: flex;
                justify-content: center;
                color: blue;
                text-shadow: 2px 3px 4px #ffffff;
                font-size: 1.1rem;
                text-align: center;
        ">
            <h1></h1>
        </div>
        <table
            style="
                max-width: 600px;
                background-color: #fdffdefd;
                border: 2px;
                border-collapse: separate !important;
                border-bottom-left-radius: 30px;
                border-bottom-right-radius: 30px;
                border-spacing: 0;
                color: #4e4e4e;
                margin: 0;
                padding: 32px;
                padding-top: 1rem;
                font-size: 14px;
                font-weight: 400;
                line-height: 1.5;
                box-shadow: 0px 10px 30px rgba(239, 231, 143, 0.715) !important;
              ">
            <tbody>
                <tr>
                    <td>
                        <img src="https://pnclogosofficial.s3.us-west-2.amazonaws.com/2017/02/12130054/The-9Best-Sports-Logo-Designs-in-History-1.png"
                            alt="logo"
                            style="width: 200px; margin-bottom: 15px; clear: both; display: inline-block; margin-left: 31%;" />
                        <br />
                        <h6
                            style="width: 536px; display: inline-block; font-size: 20px; margin: 10px 0; font-weight: 500; text-align: center;">
                            <b>Quên mật khẩu</b>
                        </h6>
                        <div>
                            <p>
                                {{ __('email.link-reset-password') }}
                                <a href="{{ route('reset.password.get', ['token' => $token, 'email' => $email]) }}">{{ __('email.reset-password') }}</a>
                            </p>

                            <p style="margin-top: 50px;">Cám ơn bạn đã xem.</p>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top: 30px; padding-bottom: 20px; margin-bottom: 40px; width: 600px">
            <tbody>
                <tr>
                    <td style="text-align: center; vertical-align: center">
                        <p
                            style="font-size: 10px; text-decoration: none; line-height: 1; color: #afafaf; margin-top: 0px">
                            Hãy ghé thăm website của chúng tôi để trải nghiệm nhiều hơn
                            <a href="{{ env('APP_URL') }}" target="_blank"
                                style="color: #2499e3; text-decoration: none">Quản lý các
                                giải đấu</a>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
