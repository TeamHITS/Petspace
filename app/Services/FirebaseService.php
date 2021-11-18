<?php
/**
 * Created by PhpStorm.
 * User: Raheel Sarfraz
 * Date: 5/28/2021
 * Time: 2:59 PM
 */

namespace App\Services;

use App\Models\UserDevice;
use GuzzleHttp\Client;

class FirebaseService
{
    private function getHeaders()
    {
        return array(
            'Authorization' => 'key=' . config('services.firebase.server_api_key'),
            'Content-Type' => 'application/json'
        );
    }

    public static function sendNotification(array $payLoad, $user)
    {
        $client = new Client();
        $headers = (new self)->getHeaders();
        $body = array(
            "registration_ids" => [$user->device_token],
            "notification" => array(
                "title" => $payLoad['title'],
                "body" => $payLoad['body'],
                "click_action" => env('APP_URL')
            ),
        );

        return $client->post('https://fcm.googleapis.com/fcm/send', [
            'headers' => $headers,
            'body' => json_encode($body)
        ]);
    }

    public static function sendBellNotification($user_id , $title, $body, array $details = null )
    {
        $device_token = UserDevice::where('user_id',$user_id)->where('device_type','web')->first();

        $client = new Client();
        $headers = (new self)->getHeaders();
        $message = [
            "to" => $device_token ? $device_token->device_token: "",
            "notification" => [
                "title" => $title,
                "body" => $body,
                // "content-available" => 1,
                // "priority" => "normal",
                // "badge" => 9,
                // "sound" => "default",
                // "details" => $details
            ],

        ];
        
        return $client->post('https://fcm.googleapis.com/fcm/send', [
            'headers' => $headers,
            'body' => json_encode($message)
        ]);
    }

    public static function subscribeTopic($token, $topic)
    {
        $client = new Client();
        $headers = (new self)->getHeaders();
        $url = sprintf('https://iid.googleapis.com/iid/v1/%s/rel/topics/%s', $token, $topic);

        return $client->post($url, [
            'headers' => $headers,
        ]);
    }
}
