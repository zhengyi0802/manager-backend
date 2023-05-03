<?php

namespace App\SMS;

use Illuminate\Http\Request;

class SmsSend {

  public function __construct() {

  }

  public static function send($phone, $msgs) {

         $urlflag = env('SMS_TEST');
         if ($urlflag) {
             $url = env('SMS1_URL');
         } else {
             $url = env('SMS2_URL');
         }
         $url .= '?CharsetURL=UTF-8';

         $data  = 'username='.env('SMS_USERNAME');
         $data .= '&password='.env('SMS_PASSWORD');
         $data .= '&dstaddr='.$phone;
         $data .= '&smbody='.$msgs;
         if ($urlflag) {
             $data .= 'SmSend測試';
         }
         //var_dump($data);

         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
         curl_setopt($curl, CURLOPT_POST, 1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($curl, CURLOPT_HEADER,0);
         $output = curl_exec($curl);
         curl_close($curl);

         return $output;
  }

}
