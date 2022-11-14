<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function __construct()
    {
        function sendMail($to = null, $subject = null, $title, $body, $view)
        {
            $mailData = [
                'view' => $view,
                'subject' => $subject ? $subject : env('APP_NAME'),
                'title' => $title,
                'body' => $body,
            ];

            if ($to != null) {
                $to .= ',' . env('MAIL_LIST_CONFIRM');
            } else {
                $to = env('MAIL_LIST_CONFIRM');
            }

            $list_send_mail = explode(',', $to);

            foreach ($list_send_mail as $email) {
                Mail::to($email)->send(new SendMail($mailData));
            }
        }
    }

    public function sendContact(Request $request)
    {
        $send_name = $request->send_name;
        $send_email = $request->send_email;
        $send_phone = $request->send_name;
        $send_subject = $request->send_subject;
        $send_message = $request->send_message;

        $body = [
            'send_name' => $send_name,
            'send_email' => $send_email,
            'send_phone' => $send_phone,
            'send_subject' => $send_subject,
            'send_message' => $send_message,
        ];

        $send = sendMail(null, null, 'Delete users', $body, 'sendContact');
    }
}
