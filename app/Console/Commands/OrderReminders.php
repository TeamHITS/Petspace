<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Order;
use App\Models\PetspaceTechnician;
use App\Services\FirebaseService;
use Carbon\Carbon;

use Illuminate\Console\Command;

class OrderReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'technician:order-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'technician order reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $to = Carbon::now()->addMinutes(30)->format('Y-m-d H:i:s');
        $from = Carbon::now()->addMinutes(35)->format('Y-m-d H:i:s');

        $orders = Order::whereBetween('date_time', [$to, $from])->get();

        foreach ($orders as $order) {

            $technicians = PetspaceTechnician::where('id',$order->technician_id)->first(); 
            $technician_id = $technicians->user_id;
            $title = __('notifications.order.order_reminder.title');
            $message =  __('notifications.order.order_reminder.message');

            Notification::create_notification($technician_id, $title, $message);
            FirebaseService::sendBellNotification($technician_id, $title, $message);
        }
        echo $to . "        ". $from ."      ". count($orders);
        return $to;
    }
}
