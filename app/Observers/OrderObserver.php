<?php

namespace App\Observers;

use App\Helper\NotificationsHelper;
use App\Models\Notification;
use App\Models\Order;
//use App\order;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $user =  app('App\Repositories\Admin\UserRepository')->findWithoutFail($order->user_id);

        Mail::send('email.order_confirm', ['user' => $user, 'order' => $order], function ($message) use ($user, $order) {
            $message->from('noreply@petspace.com', 'Petspace');
            $message->to($user->email, $user->name)->subject('Order Confirmation');
        });
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\order  $order
     * @return void
     */
    public function updated(order $order)
    {
        $devices = app('App\Repositories\Admin\UDeviceRepository')->findWhere(['user_id' => $order->user_id]);

        if ($order->progress_status == Order::DRIVER_ON_WAY) {
            //Push Notification
            if (count($devices) > 0) {
                $notificationsHelper = new NotificationsHelper();
                $notificationsHelper->sendPushNotifications(config('constants.notifications.technician-on-way'), $devices,['action_type' => Notification::DRIVER_ON_WAY, 'ref_id' => $order->id]);
            }
        }else if ($order->progress_status == Order::AT_LOCATON) {
            //Push Notification
            if (count($devices) > 0) {
                $notificationsHelper = new NotificationsHelper();
                $notificationsHelper->sendPushNotifications(config('constants.notifications.technician-at-location'), $devices,['action_type' => Notification::AT_LOCATON, 'ref_id' => $order->id]);
            }
        }else if ($order->progress_status == Order::SERVICE_IN_PROGRESS) {
            //Push Notification
            if (count($devices) > 0) {
                $notificationsHelper = new NotificationsHelper();
                $notificationsHelper->sendPushNotifications(config('constants.notifications.service-in-progress'), $devices,['action_type' => Notification::SERVICE_IN_PROGRESS, 'ref_id' => $order->id]);
            }
        }else if ($order->progress_status == Order::SREVICE_COMPLETED) {
            //Push Notification
            if (count($devices) > 0) {
                $notificationsHelper = new NotificationsHelper();
                $notificationsHelper->sendPushNotifications(config('constants.notifications.service-completed'), $devices,['action_type' => Notification::SREVICE_COMPLETED, 'ref_id' => $order->id]);
            }
        }

        if ($order->status == Order::COMPLETE) {
            $cartId = rand(10000000,99999999);

            $transaction =  app('App\Repositories\Admin\TransactionRepository')->findWhere(array("order_id" => $order->id))->first();
            if($transaction){
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://secure.telr.com/gateway/remote.xml",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<remote>\n  <store>25561</store>\n  <key>VCV28@KRkF^hsgTv</key>\n  <tran>\n    <type>capture</type>\n    <class>ecom</class>\n    <cartid>".$cartId."</cartid>\n    <description>Test Remote API</description>\n    <test>1</test>\n    <currency>AED</currency>\n    <amount>".$transaction->amount."</amount>\n    <ref>".$transaction->transaction_id."</ref>\n  </tran>\n</remote>",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/xml",
                        "cache-control: no-cache"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);
                    $json = json_encode($xml);
                    $array = json_decode($json,TRUE);

                    $data = array(
                        "message" => $array['auth']['message'],
                        "status_code" => $array['auth']['code'],
                        "status_text" => $array['auth']['status']
                    );
                    $transaction =  app('App\Repositories\Admin\TransactionRepository')->updateRecord($data,$transaction);
                }
            }

            //Push Notification
            if (count($devices) > 0) {
                $notificationsHelper = new NotificationsHelper();
                $notificationsHelper->sendPushNotifications(config('constants.notifications.rating-reminder'), $devices,['action_type' => Notification::RATING_REMINDER, 'ref_id' => $order->id ]);
            }
        }
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\order  $order
     * @return void
     */
    public function deleted(order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\order  $order
     * @return void
     */
    public function restored(order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\order  $order
     * @return void
     */
    public function forceDeleted(order $order)
    {
        //
    }
}
