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
                            <h6 style="display: inline-block; font-size: 16px; margin: 0; font-weight: 500">Liên hệ từ
                                người dùng
                            </h6>
                            <div>
                                <p>
                                    Có người dùng liên hệ
                                </p>
                                <h6 style="display: inline-block; font-size: 16px; margin: 10px 0; font-weight: 500">
                                    Thông
                                    tin:</h6>
                                <ul style="list-style: none; padding-left: 0">
                                    <li style="margin-top: 5px">Họ và tên: <b>{{ $mailData['body']['send_name'] }} </b></li>
                                    <li style="margin-top: 5px">Email: <b>{{ $mailData['body']['send_email'] }} </b></li>
                                    <li style="margin-top: 5px">Số điện thoại: <b>{{ $mailData['body']['send_phone'] }} </b>
                                    </li>
                                    <li style="margin-top: 5px">Nội dung: <b>{{ $mailData['body']['send_message'] }} </b></li>
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

    </div>
</div>
