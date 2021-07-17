<?php

namespace App\Helper;

use Edujugon\PushNotification\PushNotification;
use Illuminate\Support\Facades\Config;

class NotificationsHelper
{
    function sendPushNotifications($msg = '', $deviceObject = [], $extraPayLoadData = [])
    {
        $androidDeviceToken          = [];
        $iosDeviceToken              = [];
        $extraPayLoadData['message'] = $msg;
        foreach ($deviceObject as $device):

//            $device = $device[0];
            if (strtolower($device['device_type']) == 'android') {
                $androidDeviceToken[] = $device['device_token'];
            } elseif (strtolower($device['device_type']) == 'ios') {
                $iosDeviceToken[] = $device['device_token'];
            }
        endforeach;

        if ($androidDeviceToken) {
            $push = new PushNotification('fcm');
            $push->setMessage([
                'notification' => [
                    'title' => "Petspace",
                    'body'  => $msg,
                    'sound' => 'default'
                ],
                'data'         => [
                    'extra_payload' => $extraPayLoadData
                ],
                'android'      => [
                    'ttl'          => '86400',
                    'notification' => [
                        'click_action' => 'MainActivity'
                    ]
                ]
            ])
                ->setApiKey(Config::get('pushnotification.fcm.apiKey'))
                ->setConfig(['dry_run' => false])
                ->setDevicesToken($androidDeviceToken)
                ->send();
        }
        if ($iosDeviceToken) {
            $push = new PushNotification('fcm');
            $push->setMessage([
                'notification' => [
                    'title' => "Petspace",
                    'body'  => $msg,
                    'sound' => 'default'
                ],
                'data'         => [
                    'extra_payload' => $extraPayLoadData
                ]
            ])
                ->setApiKey(Config::get('pushnotification.fcm.apiKey'))
                ->setConfig(['dry_run' => false])
                ->setDevicesToken($iosDeviceToken)
                ->send();
        }

        /*if ($androidDeviceToken) {
            $push = new PushNotification('fcm');
            $push->setMessage([
                'notification' => [
                    'title' => config('app.name'),
                    'body'  => $msg,
                    'sound' => 'default'
                ],
                'data'         => [
                    'action_type' => $extraPayLoadData['action_type'],
                    'ref_id'      => $extraPayLoadData['ref_id'],
                    'sender_id'   => $extraPayLoadData['sender_id']
                ],
                'android'      => [
                    'ttl'          => '86400',
                    'notification' => [
                        'click_action' => 'MainActivity'
                    ]
                ]
            ])
                ->setApiKey(Config::get('constants.pushnotification.fcm'))
                ->setConfig(['dry_run' => false])
                ->setDevicesToken($androidDeviceToken)
                ->send();
        }*/

        /*Apn*/
        /*   if ($iosDeviceToken) {
               $push = new PushNotification('fcm');

               $push->setMessage([
                   'aps' => [
   //                    'alert'        => [
   //                        'title' => config('app.name'),
   //                        'body'  => $msg
   //                    ],
                       'sound'        => 'default',
                       'extraPayLoad' => [
                           'action_type' => $extraPayLoadData['action_type'],
                           'ref_id'      => $extraPayLoadData['ref_id'],
                           'message'     => $msg,
                       ]
                   ]
               ])->setDevicesToken($iosDeviceToken)->send();
           }*/
        return true;
    }
}


