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
 *      definition="OrderServicePet",
 *      required={"user_id", "name", "type", "gender", "breed", "weight", "color", "chip_id_num", "image", "birthdate", "neutered", "instruction"},
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
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          description="type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="breed",
 *          description="breed",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="weight",
 *          description="weight",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="color",
 *          description="color",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="chip_id_num",
 *          description="chip_id_num",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="birthdate",
 *          description="birthdate",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="neutered",
 *          description="neutered",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="instruction",
 *          description="instruction",
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
class OrderServicePet extends Model
{
    use SoftDeletes;

    public $table = 'order_service_pets';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'name',
        'type',
        'gender',
        'breed',
        'weight',
        'color',
        'chip_id_num',
        'image',
        'birthdate',
        'neutered',
        'instruction'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'type' => 'integer',
        'gender' => 'integer',
        'breed' => 'string',
        'weight' => 'string',
        'color' => 'string',
        'chip_id_num' => 'string',
        'image' => 'string',
        'birthdate' => 'date',
        'neutered' => 'boolean',
        'instruction' => 'string'
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
        'user_id' => 'required',
        'name' => 'required',
        'type' => 'required',
        'gender' => 'required',
        'breed' => 'required',
        'weight' => 'required',
        'color' => 'required',
        'chip_id_num' => 'required',
        'image' => 'required',
        'birthdate' => 'required',
        'neutered' => 'required',
        'instruction' => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'user_id' => 'required',
        'name' => 'required',
        'type' => 'required',
        'gender' => 'required',
        'breed' => 'required',
        'weight' => 'required',
        'color' => 'required',
        'chip_id_num' => 'required',
        'image' => 'required',
        'birthdate' => 'required',
        'neutered' => 'required',
        'instruction' => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'user_id' => 'required',
        'name' => 'required',
        'type' => 'required',
        'gender' => 'required',
        'breed' => 'required',
        'weight' => 'required',
        'color' => 'required',
        'chip_id_num' => 'required',
        'image' => 'required',
        'birthdate' => 'required',
        'neutered' => 'required',
        'instruction' => 'required'
    ];
	
	/**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'user_id' => 'required',
        'name' => 'required',
        'type' => 'required',
        'gender' => 'required',
        'breed' => 'required',
        'weight' => 'required',
        'color' => 'required',
        'chip_id_num' => 'required',
        'image' => 'required',
        'birthdate' => 'required',
        'neutered' => 'required',
        'instruction' => 'required'
    ];

    
}
