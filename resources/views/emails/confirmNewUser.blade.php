
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
        max-width: 600px !important;
        background-color: #ffffff !important;
        border: none !important;
        border-collapse: separate !important;
        border-radius: 16px !important;
        border-spacing: 0 !important;
        color: #4e4e4e !important;
        margin: 0 !important;
        padding: 32px !important;
        font-size: 14px !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        box-shadow: 0 4px 10px rgb(0 0 0/3%) !important;
      ">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <img src="https://cms.groupeditors.com/img//8f9e2838-da40-4a25-aa39-66d8c7a5e4f5.jpg"
                                alt="logo"
                                style="width: 128px; margin-bottom: 30px; clear: both; display: inline-block" />
                            <br />
                            <h6 style="display: inline-block; font-size: 16px; margin: 0; font-weight: 500">Thông báo
                            </h6>
                            <div>
                                <p>
                                    Bạn đã được cấp một tài khoản
                                </p>
                                <h6 style="display: inline-block; font-size: 16px; margin: 10px 0; font-weight: 500">
                                    Thông
                                    tin
                                    người dùng:</h6>
                                <ul style="list-style: none; padding-left: 0">
                                    <li style="margin-top: 5px">Họ và tên: <b>{{ $mailData['body']['name'] }} </b></li>
                                    <li style="margin-top: 5px">Email: <b>{{ $mailData['body']['email'] }} </b></li>
                                    <li style="margin-top: 5px">Số điện thoại: <b>{{ $mailData['body']['phone'] }} </b>
                                    </li>
                                    <li style="margin-top: 5px">Loại người dùng:
                                        @foreach ($mailData['body']['roles'] as $role)
                                            <span
                                                style="
                                            margin-right:0.5rem;
                                            border:1px solid rgb(61, 61, 228);
                                            border-radius: 30px;
                                            color: black;
                                            padding: 0.2rem 0.4rem 0.2rem;
                                            ">{{ $role->name }}</span>
                                        @endforeach
                                    </li>
                                    <li style="margin-top: 5px">Mật khẩu: <b>{{ $mailData['body']['password'] }} </b>
                                    </li>
                                    <li style="margin-top: 5px"><small><i>Hãy đăng nhập và thay đổi mật khẩu
                                                nhé!</i></small></li>
                                </ul>
                                <div style="margin-top: 15px">
                                    <p>Cảm ơn bạn đã xem.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table style="margin-top: 30px; padding-bottom: 20px; margin-bottom: 40px; width: 600px">
            <tbody>
                <tr>
                    <td style="text-align: center; vertical-align: center">
                        <p
                            style="font-size: 10px; text-decoration: none; line-height: 1; color: #afafaf; margin-top: 0px">
                            Nêu có bất kỳ vất đề gì vui lòng gửi mail về hệ thống qua email:
                            <a href="mailto:phamle21@gmail.com?subject=Feedback+for+create+new+user">
                                phamle21@gmail.com
                            </a>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
