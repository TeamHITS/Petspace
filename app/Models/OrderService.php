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
 *      definition="OrderService",
 *      required={"pet_id", "order_id", "service_id", "price"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="pet_id",
 *          description="pet_id",
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
 *          property="service_id",
 *          description="service_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="number",
 *          format="number"
 *      ),
 *     @SWG\Property(
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
class OrderService extends Model
{
    use SoftDeletes;

    public $table = 'order_services';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'pet_id',
        'order_id',
        'service_id',
        'name',
        'duration',
        'price',
        'discount',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'pet_id'     => 'integer',
        'order_id'   => 'integer',
        'service_id' => 'integer',
        'name'       => 'string',
        'duration'   => 'integer',
        'price'      => 'float',
        'discount'   => 'float'
    ];

    /**
     * The objects that should be append to toArray.
     *
     * @var array
     */
    protected $with = ["pet", "addons"];

    /**
     * The attributes that should be append to toArray.
     *
     * @var array
     */
    protected $appends = ['service_name'];

    /**
     * The attributes that should be visible in toArray.
     *
     * @var array
     */
    protected $visible = [
        'pet_id',
        'order_id',
        'service_id',
        'name',
        'service_name',
        'duration',
        'price',
        'discount',
        'pet',
        'addons',
    ];

    /**
     * Validation create rules
     *
     * @var array
     */
    public static $rules = [
        'pet_id'     => 'required',
        'order_id'   => 'required',
        'service_id' => 'required',
        'name'       => 'required',
        'duration'   => 'required',
        'price'      => 'required',
        'discount'   => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'pet_id'     => 'required',
        'order_id'   => 'required',
        'service_id' => 'required',
        'name'       => 'required',
        'duration'   => 'required',
        'price'      => 'required',
        'discount'   => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'pet_id'     => 'required',
        'order_id'   => 'required',
        'service_id' => 'required',
        'name'       => 'required',
        'duration'   => 'required',
        'price'      => 'required',
        'discount'   => 'required'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'pet_id'     => 'required',
        'order_id'   => 'required',
        'service_id' => 'required',
        'name'       => 'required',
        'duration'   => 'required',
        'price'      => 'required',
        'discount'   => 'required'
    ];

    public function addons()
    {
        return $this->hasMany(OrderServiceAddon::class, "order_service_id", "id");
    }

    public function categoryService()
    {
        return $this->belongsTo(CategoryService::class, "service_id", "id");
    }

    public function getServiceNameAttribute()
    {
        if (isset($this->service_id)) {
            return $this->categoryService->name;
        }
        return null;
    }

    public function pet()
    {
        return $this->belongsTo(OrderServicePet::class, "pet_id", "id")->withTrashed();
    }
}
