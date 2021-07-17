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
 *      definition="UserAddress",
 *      required={"user_id", "type", "address","street","apartment_number", "latitude", "longitude"},
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="address",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="apartment_number",
 *          description="apartment_number",
 *          type="string"
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
 *      )
 * )
 */
class UserAddress extends Model
{
    use SoftDeletes;

    public $table = 'user_addresses';


    protected $dates = ['deleted_at'];

    //Gender
    const HOUSE     = 10;
    const APARTMENT = 20;

    public static $ADDRESS_TYPE = [
        self::HOUSE     => 'House',
        self::APARTMENT => 'Apartment'
    ];


    public $fillable = [
        'user_id',
        'type',
        'address',
        'street',
        'apartment_number',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'user_id'          => 'integer',
        'type'             => 'integer',
        'street'           => 'string',
        'address'          => 'string',
        'apartment_number' => 'string',
        'latitude'         => 'string',
        'longitude'        => 'string'
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
    protected $appends = ["type_text"];

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
        'user_id'          => 'required',
        'type'             => 'required',
        'street'           => 'sometimes',
        'address'          => 'required',
        'apartment_number' => 'required',
        'latitude'         => 'required',
        'longitude'        => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'user_id'          => 'sometimes',
        'type'             => 'sometimes',
        'street'           => 'sometimes',
        'address'          => 'sometimes',
        'apartment_number' => 'sometimes',
        'latitude'         => 'sometimes',
        'longitude'        => 'sometimes'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'user_id'          => 'sometimes',
        'type'             => 'sometimes',
        'street'           => 'sometimes',
        'address'          => 'sometimes',
        'apartment_number' => 'sometimes',
        'latitude'         => 'sometimes',
        'longitude'        => 'sometimes'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'user_id'          => 'sometimes',
        'type'             => 'sometimes',
        'street'           => 'sometimes',
        'address'          => 'sometimes',
        'apartment_number' => 'sometimes',
        'latitude'         => 'sometimes',
        'longitude'        => 'sometimes'
    ];

    public function getTypeTextAttribute()
    {
        if (isset($this->type) && isset(self::$ADDRESS_TYPE[$this->type])) {
            return self::$ADDRESS_TYPE[$this->type];
        }
        return null;
    }
}
