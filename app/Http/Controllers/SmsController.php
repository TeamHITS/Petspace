<?php

namespace App\Http\Controllers;

use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class SmsController extends Controller
{
    public function sendSms($number, $code)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $serviceId  = "VA741f813fd4ab11f6bd4b8f57048dc4be";
       // $appSid     = config('app.twilio')['TWILIO_APP_SID'];
        try {
            $client = new Client($accountSid, $authToken);
        } catch (ConfigurationException $e) {
        }
        try
        {
            // Use the client to do fun stuff like send text messages!
            $verification = $client->verify->v2->services($serviceId)
                ->verifications
                ->create($number, "sms");
        }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function sendVerificationSms($number, $code)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $serviceId  = "VA741f813fd4ab11f6bd4b8f57048dc4be";
        //$appSid     = config('app.twilio')['TWILIO_APP_SID'];
        try {

            $client = new Client($accountSid, $authToken);
        } catch (ConfigurationException $e) {
        }
        try
        {
            $verification = $client->verify->v2->services($serviceId)
                ->verifications
                ->create($number, "sms",["locale" => "en"]);
        }
        catch (Exception $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function verifyCode($number, $code)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $serviceId  = "VA741f813fd4ab11f6bd4b8f57048dc4be";
        //$appSid     = config('app.twilio')['TWILIO_APP_SID'];
        try {
            $client = new Client($accountSid, $authToken);
        } catch (ConfigurationException $e) {
        }
        try
        {
            $verification_check = $client->verify->v2->services($serviceId)
                ->verificationChecks
                ->create($code, // code
                    ["to" => $number]
                );
            return $verification_check->status;
        }
        catch (Exception $e)
        {
            return "invalid";
        }
    }
}
