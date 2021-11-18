<?php

namespace App\Http\Resources;

use App\Bookings;
use Illuminate\Http\Resources\Json\Resource;

class NotificationCollection extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'title' => $this->action_type,
            'message' => $this->message,
            'url' => $this->url,
            'ref_id' => $this->ref_id,
            'sender_id' => $this->sender_id,
            'status' => $this->status,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->format('g:i A, d M Y'),
        ];
    }
}
    