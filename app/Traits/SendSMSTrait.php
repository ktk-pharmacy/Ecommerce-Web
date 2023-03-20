<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait SendSMSTrait
{
    public function sendBySMSPoh($to, $msg)
    {
        $url = config('services.sms.smspoh.endpoint');
        $header = array(
            'Cache-Control:no-cache',
            'Authorization: Bearer ' . config('services.sms.smspoh.token'),
            'Content-Type: application/json'
        );

        $data = '{
            "sender" : "'.config('services.sms.smspoh.sender').'",
            "to" : "'.$to.'",
            "message" : "'.$msg.'"
        }';

        if (!env('SMS_SERVICE')) {
            Log::channel('sms')->info($msg);
            return '{"status":true}';
        }


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            $error_msg = curl_error($ch);
            Log::channel('sms')->info($error_msg);
        }

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $result;
    }
}
