<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CalendarSlots extends Model
{
   // use SoftDeletes;

    public $table = 'calendar_slots';


    public $fillable = [
        "petspace_id",
        "description",
        "block_entire_day", 
        "start_time",
        "end_time", 
        "start_date", 
        "end_date",/*,
        "order_ids", 
        "assigned_technicians_ids", */
        'reserved_days',
        'reserved_type',
        "total_booking_count", 
        "available_booking_count",
        "comments", 
        "slot_type",
        "slots_count"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'petspace_id' => 'integer',
        'start_time' => 'time',
        'end_time' => 'time',
        'start_date' => 'date',
        'end_date' => 'date'/*,
        'reserved_days' => 'longtext', 
        'reserved_type'  => 'string',
        'total_booking_count' => 'integer',
        'available_booking_count' => 'integer', 
        'comments' => 'string', 
        'slot_type' => 'string'*/
    ];

  

    /**
     * Validation create rules
     *
     * @var array
     */
    public static $rules = [
        'petspace_id' => 'required',
        'start_time' => 'required',
        'end_time' => 'required', 
        'start_date' => 'required', 
        'end_date' => 'required', 
        /*'order_ids' => 'required', 
        'assigned_technicians_ids' => 'required', 
        'reserved_days' => 'required', 
        'reserved_type'  => 'required',
        'total_booking_count' => 'required',
        'available_booking_count' => 'required', 
        'comments' => 'required',*/ 
        'slot_type' => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'start_time' => 'sometimes',
        'end_time' => 'sometimes', 
        'start_date' => 'sometimes', 
        'end_date' => 'sometimes'/*, 
        'order_ids' => 'sometimes', 
        'assigned_technicians_ids' => 'sometimes', 
        'reserved_days' => 'sometimes', 
        'reserved_type'  => 'sometimes',
        'total_booking_count' => 'sometimes', 
        'available_booking_count' => 'sometimes',
        'comments' => 'sometimes', 
        'slot_type' => 'sometimes'*/
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'start_time' => 'sometimes',
        'end_time' => 'sometimes', 
        'start_date' => 'sometimes', 
        'end_date' => 'sometimes'/*, 
        'order_ids' => 'required', 
        'assigned_technicians_ids' => 'required', 
        'reserved_days' => 'required', 
        'reserved_type'  => 'sometimes',
        'total_booking_count' => 'sometimes', 
        'available_booking_count' => 'sometimes',
        'comments' => 'sometimes', 
        'slot_type' => 'sometimes'*/
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'start_time' => 'sometimes',
        'end_time' => 'sometimes', 
        'start_date' => 'sometimes', 
        'end_date' => 'sometimes'/*, 
        'order_ids' => 'sometimes', 
        'assigned_technicians_ids' => 'sometimes', 
        'reserved_days' => 'sometimes', 
        'reserved_type'  => 'sometimes',
        'total_booking_count' => 'sometimes', 
        'available_booking_count' => 'sometimes',
        'comments' => 'sometimes', 
        'slot_type' => 'sometimes'*/
    ];


   
}
