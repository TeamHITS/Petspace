<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    public $table = 'order_history';

    public $fillable = [
        "order_id",
        "total"
    ];
}
