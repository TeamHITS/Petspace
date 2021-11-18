<?php

namespace App\Http\Controllers;

use App\Models\UserDevice;
use App\Services\FirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirebaseNotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        if(Auth::check()) 
        {
            $user = UserDevice::updateOrCreate([
                'device_type' => 'web',
                'user_id' => auth()->user()->id
            ],[
                'device_type' => 'web',
                'user_id' => auth()->user()->id,
                'device_token' => $request->token,
                'push_notification' => 1,
            ]);
            return response()->noContent();
        }
    }


    public function subscribe(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'topic' => 'required'
        ]);

        FirebaseService::subscribeTopic($request->token, $request->topic);

        return response()->noContent();
    }
}
