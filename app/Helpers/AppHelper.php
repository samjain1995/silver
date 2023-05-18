<?php
if (!function_exists('getSiteSettings')) {
    function getSiteSettings()
    {
        return \App\Models\Setting::find(1);
    }
}

if (!function_exists('sendMail')) {
    function sendMail($template, $mail_data, $body_data)
    {
        \Mail::send($template, array('data' => $body_data), function ($message) use ($mail_data) {
            $message->to($mail_data['email'], $mail_data['to_name'])
                ->from(env('MAIL_FROM_ADDRESS'))
                ->subject($mail_data['subject']);
        });
    }
}
