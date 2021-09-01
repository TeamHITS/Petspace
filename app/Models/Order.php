<?php

namespace App\Models;

use DateTime;
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
 *      definition="Order",
 *      required={"user_id","cart_id", "petspace_id", "user_address_id","technician_id", "slot_id", "date_time", "status", "progress_status", "sub_total", "tax", "delivery_fee", "total", "rating", "rating_comment", "note","promo_code"},
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
 *          property="petspace_id",
 *          description="petspace_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_address_id",
 *          description="user_address_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="technician_id",
 *          description="technician_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="slot_id",
 *          description="slot_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="date_time",
 *          description="date_time",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="sub_total",
 *          description="sub_total",
 *          type="number",
 *          format="number"
 *      ),
 *       @SWG\Property(
 *          property="delivery_fee",
 *          description="delivery_fee",
 *          type="number",
 *          format="number"
 *      ),
 *       @SWG\Property(
 *          property="tax",
 *          description="tax",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="total",
 *          description="total",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="note",
 *          description="note",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="promo_code",
 *          description="promo_code",
 *          type="string"
 *      )
 * )
 */
class Order extends Model
{
    use SoftDeletes;

    public $table = 'orders';


    protected $dates = ['deleted_at'];

    const SCHEDULE = 10;
    const ACTIVE   = 20;
    const COMPLETE = 30;
    const CANCEL   = 40;

    public static $STATUS_TEXT = [
        self::SCHEDULE => 'Schedule',
        self::ACTIVE   => 'Active',
        self::COMPLETE => 'Complete',
        self::CANCEL   => 'Cancel'
    ];

    public static $STATUS_COLOR = [
        self::SCHEDULE => 'scheduled',
        self::ACTIVE   => 'active',
        self::COMPLETE => 'completed',
        self::CANCEL   => 'canceled'
    ];

    public static $STATUS_LABLE_COLOR = [
        self::SCHEDULE => 'blue',
        self::ACTIVE   => 'yellow',
        self::COMPLETE => 'blue',
        self::CANCEL   => 'pink'
    ];

    const DRIVER_ON_WAY       = 10;
    const AT_LOCATON          = 20;
    const SERVICE_IN_PROGRESS = 30;
    const SREVICE_COMPLETED   = 40;

    public static $PROGRESS_STATUS = [
        self::DRIVER_ON_WAY       => 'Driver on the way',
        self::AT_LOCATON          => 'At the location',
        self::SERVICE_IN_PROGRESS => 'Service in progress',
        self::SREVICE_COMPLETED   => 'Service is completed'
    ];

    public $fillable = [
        "user_id",
        "cart_id",
        "petspace_id",
        "user_address_id",
        "technician_id",
        "slot_id",
        "date_time",
        "status",
        "progress_status",
        "sub_total",
        "tax",
        "delivery_fee",
        "total",
        "rating",
        "rating_comment",
        "note",
        "promo_code"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'user_id'         => 'integer',
        'cart_id'         => 'integer',
        'petspace_id'     => 'integer',
        'user_address_id' => 'integer',
        'technician_id'   => 'integer',
        'slot_id'         => 'string',
        'date_time'       => 'datetime',
        'status'          => 'string',
        'progress_status' => 'string',
        'sub_total'       => 'float',
        'tax'             => 'float',
        'delivery_fee'    => 'float',
        'total'           => 'float',
        'rating'          => 'float',
        'rating_comment'  => 'string',
        'note'            => 'string',
        'promo_code'      => 'string'
    ];

    /**
     * The objects that should be append to toArray.
     *
     * @var array
     */
    protected $with = ["user", "address", "shop", "services", "technician",'progress','promo'];

    /**
     * The attributes that should be append to toArray.
     *
     * @var array
     */
    protected $appends = ["status_text", "status_color", "booking_day", "progress_status_text", "status_lable_color"];

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
        'user_id'         => 'required',
        'cart_id'         => 'required',
        'petspace_id'     => 'required',
        'user_address_id' => 'required',
        'technician_id'   => 'sometimes',
        'slot_id'         => 'required',
        'date_time'       => 'required',
        'status'          => 'required',
        'sub_total'       => 'required',
        'tax'             => 'required',
        'delivery_fee'    => 'required',
        'total'           => 'required',
        'rating'          => 'sometimes',
        'rating_comment'  => 'sometimes',
        'note'            => 'sometimes',
        'promo_code'      => 'sometimes'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'user_id'         => 'sometimes',
        'cart_id'         => 'sometimes',
        'petspace_id'     => 'sometimes',
        'user_address_id' => 'sometimes',
        'technician_id'   => 'sometimes',
        'slot_id'         => 'sometimes',
        'date_time'       => 'sometimes',
        'status'          => 'sometimes',
        'progress_status' => 'sometimes',
        'sub_total'       => 'sometimes',
        'tax'             => 'sometimes',
        'delivery_fee'    => 'sometimes',
        'total'           => 'sometimes',
        'rating'          => 'sometimes',
        'rating_comment'  => 'sometimes',
        'note'            => 'sometimes',
        'promo_code'      => 'sometimes'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'user_id'         => 'sometimes',
        'cart_id'         => 'sometimes',
        'petspace_id'     => 'required',
        'user_address_id' => 'required',
        'technician_id'   => 'sometimes',
        'slot_id'         => 'required',
        'date_time'       => 'required',
        'status'          => 'required',
        'progress_status' => 'sometimes',
        'sub_total'       => 'required',
        'tax'             => 'required',
        'delivery_fee'    => 'required',
        'total'           => 'required',
        'rating'          => 'sometimes',
        'rating_comment'  => 'sometimes',
        'note'            => 'sometimes',
        'promo_code'      => 'sometimes'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'user_id'         => 'sometimes',
        'cart_id'         => 'sometimes',
        'petspace_id'     => 'sometimes',
        'user_address_id' => 'sometimes',
        'technician_id'   => 'sometimes',
        'slot_id'         => 'sometimes',
        'date_time'       => 'sometimes',
        'status'          => 'sometimes',
        'progress_status' => 'sometimes',
        'sub_total'       => 'sometimes',
        'tax'             => 'sometimes',
        'delivery_fee'    => 'sometimes',
        'total'           => 'sometimes',
        'rating'          => 'sometimes',
        'rating_comment'  => 'sometimes',
        'note'            => 'sometimes',
        'promo_code'      => 'sometimes'
    ];

    public function address()
    {
        return $this->belongsTo(UserAddress::class, "user_address_id", "id")->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id")->withTrashed();
    }

    public function progress()
    {
        return $this->hasMany(OrderProgress::class, "order_id", "id")->withTrashed();
    }


    public function technician()
    {
        return $this->belongsTo(PetspaceTechnician::class, "technician_id", "id")->withTrashed();
    }

    public function shop()
    {
        return $this->belongsTo(Petspace::class, "petspace_id", "id")->withTrashed();
    }

    public function services()
    {
        return $this->hasMany(OrderService::class)->withTrashed()->withTrashed();
    }

    public function getStatusTextAttribute()
    {
        if (isset($this->status) && isset(self::$STATUS_TEXT[$this->status])) {
            return self::$STATUS_TEXT[$this->status];
        }
        return null;
    }

    public function getStatusColorAttribute()
    {
        if (isset($this->status) && isset(self::$STATUS_COLOR[$this->status])) {
            return self::$STATUS_COLOR[$this->status];
        }
        return null;
    }

    public function getStatusLableColorAttribute()
    {
        if (isset($this->status) && isset(self::$STATUS_LABLE_COLOR[$this->status])) {
            return self::$STATUS_LABLE_COLOR[$this->status];
        }
        return null;
    }

    public function getBookingDayAttribute()
    {
        if (isset($this->date_time)) {
            $datetime = new DateTime($this->date_time);
            return $datetime->format('l');
        }
        return null;
    }

    public function getProgressStatusTextAttribute()
    {
        if (isset($this->progress_status) && isset(self::$PROGRESS_STATUS[$this->progress_status])) {
            return self::$PROGRESS_STATUS[$this->progress_status];
        }
        return null;
    }

    public function promo()
    {
        return $this->belongsTo(PromoCode::class, "promo_code", "id")->withTrashed();
    }
}
