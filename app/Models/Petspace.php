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
 *      definition="Petspace",
 *      required={"name", "grooming", "is_delivery_fee","email", "is_pick_drop_available", "min_order", "delivery_fee", "latitude", "longitude", "image","rating","google_rating","is_approved"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *       @SWG\Property(
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="grooming",
 *          description="grooming",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="is_delivery_fee",
 *          description="is_delivery_fee",
 *          type="boolean"
 *      ),
 *     @SWG\Property(
 *          property="is_approved",
 *          description="is_approved",
 *          type="boolean"
 *      ),
 *     @SWG\Property(
 *          property="is_temporary_closed",
 *          description="is_temporary_closed",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="is_pick_drop_available",
 *          description="is_pick_drop_available",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="delivery_fee",
 *          description="delivery_fee",
 *          type="number",
 *          format="number"
 *      ), @SWG\Property(
 *          property="min_order",
 *          description="min_order",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="rating",
 *          description="rating",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="latitude",
 *          description="latitude",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="longitude",
 *          description="longitude",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string"
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
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Petspace extends Model
{
    use SoftDeletes;

    public $table = 'petspaces';


    protected $dates = ['deleted_at'];

    //Grooming
    const CAT  = 10;
    const DOG  = 20;
    const BOTH = 30;

    const AVAILABLE     = 1;
    const NOT_AVAILABLE = 0;

    public static $GROOMING_TEXT = [
        self::CAT  => 'Grooming for Cats',
        self::DOG  => 'Grooming for Dogs',
        self::BOTH => 'Grooming for Dogs . Cats'
    ];

    public static $GROOMING_WEB_TEXT = [
        self::CAT  => 'Cats',
        self::DOG  => 'Dogs',
        self::BOTH => 'Both'
    ];

    public static $DELIVERY_TEXT = [
        self::AVAILABLE     => 'Available',
        self::NOT_AVAILABLE => 'Not Available'
    ];

    public $fillable = [
        'user_id',
        'name',
        'grooming',
        'is_delivery_fee',
        'is_pick_drop_available',
        'delivery_fee',
        'min_order',
        'latitude',
        'longitude',
        'image',
        'email',
        'phone',
        'address',
        'address_two',
        'area',
        'city',
        'google_rating',
        'is_approved',
        'is_temporary_closed',
        'open_text',
        'rating'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                     => 'integer',
        'name'                   => 'string',
        'grooming'               => 'integer',
        'is_delivery_fee'        => 'boolean',
        'is_pick_drop_available' => 'boolean',
        'delivery_fee'           => 'float',
        'min_order'              => 'float',
        'rating'                 => 'float',
        'google_rating'          => 'float',
        'rating'                 => 'float',
        'latitude'               => 'string',
        'longitude'              => 'string',
        'image'                  => 'string',
        'email'                  => 'string',
        'phone'                  => 'string',
        'address'                => 'string',
        'address_two'            => 'string',
        'area'                   => 'string',
        'city'                   => 'string',
        'is_approved'            => 'boolean',
        'is_temporary_closed'    => 'boolean',
        'open_text'              => 'string',

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
    protected $appends = ['grooming_text', 'image_url', 'order_count', 'delivery_text', 'pick_drop_text'];

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
        'user_id'                => 'sometimes',
        'name'                   => 'required',
        'grooming'               => 'required',
        'is_delivery_fee'        => 'required',
        'is_pick_drop_available' => 'required',
        'delivery_fee'           => 'sometimes',
        'min_order'              => 'sometimes',
        'latitude'               => 'sometimes',
        'longitude'              => 'sometimes',
        'image'                  => 'required',
        'email'                  => 'required',
        'phone'                  => 'required',
        'address'                => 'required',
        'address_two'            => 'sometimes',
        'area'                   => 'required',
        'city'                   => 'required',
        'first_name'             => 'sometimes',
        'last_name'              => 'sometimes',
        'phone'                  => 'sometimes',
        'rating'                 => 'sometimes',
        'google_rating'          => 'sometimes',
        'is_approved'            => 'sometimes',
        'is_temporary_closed'    => 'sometimes',
        'open_text'              => 'sometimes',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name'                   => 'sometimes',
        'grooming'               => 'sometimes',
        'is_delivery_fee'        => 'sometimes',
        'is_pick_drop_available' => 'sometimes',
        'delivery_fee'           => 'sometimes',
        'min_order'              => 'sometimes',
        'latitude'               => 'sometimes',
        'longitude'              => 'sometimes',
        'image'                  => 'sometimes',
        'email'                  => 'sometimes',
        'phone'                  => 'sometimes',
        'address'                => 'sometimes',
        'address_two'            => 'sometimes',
        'area'                   => 'sometimes',
        'city'                   => 'sometimes',
        'rating'                 => 'sometimes',
        'google_rating'          => 'sometimes',
        'is_approved'            => 'sometimes',
        'is_temporary_closed'    => 'sometimes',
        'open_text'              => 'sometimes'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'name'                   => 'required',
        'grooming'               => 'required',
        'is_delivery_fee'        => 'required',
        'is_pick_drop_available' => 'required',
        'delivery_fee'           => 'required',
        'min_order'              => 'sometimes',
        'latitude'               => 'required',
        'longitude'              => 'required',
        'image'                  => 'required',
        'email'                  => 'required',
        'phone'                  => 'required',
        'address'                => 'required',
        'address_two'            => 'sometimes',
        'area'                   => 'required',
        'city'                   => 'required',
        'rating'                 => 'sometimes',
        'google_rating'          => 'sometimes',
        'is_approved'            => 'sometimes',
        'is_temporary_closed'    => 'sometimes',
        'open_text'              => 'sometimes',
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'name'                   => 'sometimes',
        'grooming'               => 'sometimes',
        'is_delivery_fee'        => 'sometimes',
        'is_pick_drop_available' => 'sometimes',
        'delivery_fee'           => 'sometimes',
        'min_order'              => 'sometimes',
        'latitude'               => 'sometimes',
        'longitude'              => 'sometimes',
        'image'                  => 'sometimes',
        'email'                  => 'sometimes',
        'phone'                  => 'sometimes',
        'address'                => 'sometimes',
        'address_two'            => 'sometimes',
        'area'                   => 'sometimes',
        'city'                   => 'sometimes',
        'rating'                 => 'sometimes',
        'google_rating'          => 'sometimes',
        'is_approved'            => 'sometimes',
        'is_temporary_closed'    => 'sometimes',
        'open_text'              => 'sometimes',
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getOrderCountAttribute()
    {
        return $this->orders()->count();
    }

    public function getGroomingTextAttribute()
    {
        return self::$GROOMING_TEXT[$this->grooming];
    }

    public function getDeliveryTextAttribute()
    {
        if ($this->is_delivery_fee) {
            return "Delivery fee";
        } else {
            return "No delivery fee";
        };
    }

    public function getPickDropTextAttribute()
    {
        if ($this->is_pick_drop_available) {
            return "Pickup & Drop off available";
        } else {
            return "Pickup & Drop off not available";
        };
    }

    public function getImageUrlAttribute()
    {
        return ($this->image && storage_path(url('storage/app/' . $this->image))) ? route('api.resize', ['img' => $this->image]) : route('api.resize', ['img' => 'petspace/petspace.png', 'w=100', 'h=100']);
    }

}
