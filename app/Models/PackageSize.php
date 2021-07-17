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
 *      definition="PackageSize",
 *      required={"name", "description", "price", "discount"},
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
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="discount",
 *          description="discount",
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
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class PackageSize extends Model
{
    use SoftDeletes;

    public $table = 'package_sizes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'price',
        'discount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'price' => 'float',
        'discount' => 'float'
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
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'discount' => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'discount' => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'discount' => 'required'
    ];
	
	/**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'discount' => 'required'
    ];

    
}
