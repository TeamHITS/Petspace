<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property string name
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @SWG\Definition(
 *      definition="Transaction",
 *      required={"user_id", "order_id", "transaction_id", "payment_status", "amount", "message"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="order_id",
 *          description="order_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="transaction_id",
 *          description="transaction_id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="payment_status",
 *          description="payment_status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="delated_at",
 *          description="delated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'card_type',
        'amount',
        'currency',
        'message',
        'status_text',
        'status_code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'user_id'        => 'integer',
        'order_id'       => 'integer',
        'transaction_id' => 'string',
        'card_type'      => 'string',
        'currency'       => 'string',
        'status_code'    => 'integer',
        'status_text'    => 'string',
        'message'        => 'string',
        'amount'         => 'float',
        'delated_at'     => 'datetime'
    ];

    /**
     * The objects that should be append to toArray.
     *
     * @var array
     */
    protected $with = [];

    /**
     * The attributes that should be append to toArray.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be visible in toArray.
     *
     * @var array
     */
    protected $visible = [];

    /**
     * Validation create rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'        => 'required',
        'order_id'       => 'required',
        'transaction_id' => 'required',
        'card_type'      => 'required',
        'currency'       => 'required',
        'status_code'    => 'required',
        'status_text'    => 'required',
        'message'        => 'sometimes',
        'amount'         => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'user_id'        => 'required',
        'order_id'       => 'required',
        'transaction_id' => 'required',
        'card_type'      => 'required',
        'currency'       => 'required',
        'status_code'    => 'required',
        'status_text'    => 'required',
        'message'        => 'sometimes',
        'amount'         => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'user_id'        => 'required',
        'order_id'       => 'required',
        'transaction_id' => 'required',
        'card_type'      => 'required',
        'currency'       => 'required',
        'status_code'    => 'required',
        'status_text'    => 'required',
        'amount'         => 'required',
        'message'        => 'sometimes'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'user_id'        => 'required',
        'order_id'       => 'required',
        'transaction_id' => 'required',
        'card_type'      => 'required',
        'currency'       => 'required',
        'status_code'    => 'required',
        'status_text'    => 'required',
        'amount'         => 'required',
        'message'        => 'sometimes'
    ];


}
