<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmsSentController extends Controller
{

    public function smsSent($data,$templateid){
       
        $textmobileno =  $data['mobileno'];
        if(strlen($textmobileno) == 10){
            $mobileno = '91'.$textmobileno;
        }else{
            $mobileno = $textmobileno;
        }
        //1 - appointment, 2-otp
        if($templateid == 1){
            $message = "Dear".$data['firstname'].", Thanks for visiting our store and hope you had a great shopping. Click the link to download the invoice".$data['link'].".  Keep visiting us once again, Have a great day.";	
        }
        
        $apiKey = urlencode('NGI0NjZhNzk1MzU2MzE1MTZiNDI0OTZmNzIzMzY2NmU=');
        
        // Message details
        $numbers = array($mobileno);
        $sender = urlencode('GMNPRO');
        $message = rawurlencode($message);
         $numbers = implode(',', $numbers);
         // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        // Send the POST request with cURL
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        if($templateid == 2){
            
        }
        
    }


}
