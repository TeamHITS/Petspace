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
 *      definition="UserCard",
 *      required={"user_id", "ref", "type", "first_digits", "last_digits", "country", "expire_month", "expire_year"},
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
 *          property="ref",
 *          description="ref",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="first_digits",
 *          description="first_digits",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="last_digits",
 *          description="last_digits",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="country",
 *          description="country",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="expire_month",
 *          description="expire_month",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="expire_year",
 *          description="expire_year",
 *          type="integer",
 *          format="int32"
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
class UserCard extends Model
{
    use SoftDeletes;

    public $table = 'user_cards';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'ref',
        'type',
        'first_digits',
        'last_digits',
        'country',
        'expire_month',
        'expire_year'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'user_id'      => 'integer',
        'ref'          => 'string',
        'type'         => 'string',
        'first_digits' => 'string',
        'last_digits'  => 'string',
        'country'      => 'string',
        'expire_month' => 'integer',
        'expire_year'  => 'integer'
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
        'user_id'      => 'required',
        'ref'          => 'required',
        'type'         => 'required',
        'first_digits' => 'required',
        'last_digits'  => 'required',
        'country'      => 'required',
        'expire_month' => 'required',
        'expire_year'  => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'user_id'      => 'required',
        'ref'          => 'required',
        'type'         => 'required',
        'first_digits' => 'required',
        'last_digits'  => 'required',
        'country'      => 'required',
        'expire_month' => 'required',
        'expire_year'  => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'user_id'      => 'required',
        'ref'          => 'required',
        'type'         => 'required',
        'first_digits' => 'required',
        'last_digits'  => 'required',
        'country'      => 'required',
        'expire_month' => 'required',
        'expire_year'  => 'required'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'user_id'      => 'required',
        'ref'          => 'required',
        'type'         => 'required',
        'first_digits' => 'required',
        'last_digits'  => 'required',
        'country'      => 'required',
        'expire_month' => 'required',
        'expire_year'  => 'required'
    ];


}
