<?php
/**
 * Created by PhpStorm.
 * User: Shafqat Ali
 * Date: 10/27/2021
 * Time: 8:50 PM
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class PusherChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toPusher($notifiable);
    }
}