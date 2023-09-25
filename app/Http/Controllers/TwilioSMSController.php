<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Exception;

class TwilioSMSController extends Controller
{
    /*Must create a twilio account
        * Add those to env
     *
     * TWILIO_SID=AC1dc2ffd8d74fa3f13a06242be03ce35f
     * TWILIO_TOKEN=a98726e6fb******db8c81400f1123d
     * TWILIO_FROM=+1517888***
     *
    */

    public function index()
    {
        $receiverNumber = "+8801638574281";
        $message = "This is test message with OTP = " . rand(100000, 999999) ;

        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);
            dd('SMS Sent Successfully.');

        } catch (Exception $e) {

            dd("Error: ". $e->getMessage());
        }
    }
}
