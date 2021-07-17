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
 *      definition="SubmenuService",
 *      required={"submenu_id", "name", "description", "price", "discount", "service_duration","in_stock"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="submenu_id",
 *          description="submenu_id",
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
 *          property="service_duration",
 *          description="service_duration",
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
class SubmenuService extends Model
{
    use SoftDeletes;

    public $table = 'submenu_services';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'submenu_id',
        'name',
        'description',
        'price',
        'discount',
        'service_duration',
        'in_stock'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'submenu_id'       => 'integer',
        'name'             => 'string',
        'description'      => 'string',
        'price'            => 'float',
        'discount'         => 'float',
        'service_duration' => 'integer',
        'in_stock'         => 'boolean'
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
        'submenu_id'       => 'required',
        'name'             => 'required',
        'description'      => 'required',
        'price'            => 'required',
        'discount'         => 'required',
        'service_duration' => 'required',
        'in_stock'         => 'sometimes'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'submenu_id'       => 'required',
        'name'             => 'required',
        'description'      => 'required',
        'price'            => 'required',
        'discount'         => 'required',
        'service_duration' => 'required',
        'in_stock'         => 'sometimes'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'submenu_id'       => 'required',
        'name'             => 'required',
        'description'      => 'required',
        'price'            => 'required',
        'discount'         => 'required',
        'service_duration' => 'required',
        'in_stock'         => 'sometimes'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'submenu_id'       => 'required',
        'name'             => 'required',
        'description'      => 'required',
        'price'            => 'required',
        'discount'         => 'required',
        'service_duration' => 'required',
        'in_stock'         => 'sometimes'
    ];


}
