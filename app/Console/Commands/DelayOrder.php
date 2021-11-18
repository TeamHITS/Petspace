<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Petspace;
use App\Models\PetspaceTechnician;
use App\Services\FirebaseService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DelayOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delay:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'order is delay due to technician not started the order';

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
        $current_time = Carbon::now()->addMinutes(50)->format('Y-m-d H:i:s');

        $orders = Order::where('date_time','>', $current_time)->where('technician_id',"!=",null)->where('status',10)->get();

        foreach ($orders as $order) {

            $petspace = Petspace::where('id',$order->petspace_id)->first();
            $vendor_id = $petspace->user_id;
            $title = __('notifications.order.delay_order.title');
            $message =  __('notifications.order.delay_order.message');

            Notification::create_notification($vendor_id, $title, $message);
            FirebaseService::sendBellNotification($vendor_id, $title, $message);

            $technicians = PetspaceTechnician::where('id',$order->technician_id)->first(); 
            $technician_id = $technicians->user_id;
            
            Notification::create_notification($technician_id, $title, $message);
            FirebaseService::sendBellNotification($technician_id, $title, $message);

        }
        echo $current_time . "        ". count($orders) . "    ";
        return $current_time;
    }
}
