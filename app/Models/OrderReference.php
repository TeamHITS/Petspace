<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderReference extends Model
{
    public $fillable = [
        'order_id',
        'reference'
    ];
}
