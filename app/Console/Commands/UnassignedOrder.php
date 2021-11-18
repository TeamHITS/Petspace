<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Petspace;
use App\Services\FirebaseService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UnassignedOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:order-unassigned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'vendor unassigned orders';

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
        $current_time = Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s');

        $orders = Order::where('created_at','>', $current_time)->where('technician_id',null)->get();

        foreach ($orders as $order) {
            $petspace = Petspace::where('id',$order->petspace_id)->first();
            $technician_id = $petspace->user_id;
            $title = __('notifications.order.unassigned_order.title');
            $message =  __('notifications.order.unassigned_order.message');

            Notification::create_notification($technician_id, $title, $message);
            FirebaseService::sendBellNotification($technician_id, $title, $message);
        }
        echo $current_time . "        ". count($orders);
        return $current_time;
    }
}
