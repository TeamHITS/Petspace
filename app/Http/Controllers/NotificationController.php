<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('ref_id',Auth::user()->id)->latest('created_at')->where('status',1)->get();
        return NotificationCollection::collection($notifications);
    }

    public function markAsRead()
    {
        $notifications = Notification::where('ref_id',Auth::user()->id)->update(['status'=>0]);
        
        return "All Notification marked as read";
    }
}
