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
 *      definition="OrderServiceAddon",
 *      required={"order_service_id", "submenu_service_id", "price"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="order_service_id",
 *          description="order_service_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="submenu_service_id",
 *          description="submenu_service_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
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
class OrderServiceAddon extends Model
{
    use SoftDeletes;

    public $table = 'order_service_addons';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'order_service_id',
        'submenu_service_id',
        'duration',
        'price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'order_service_id'   => 'integer',
        'submenu_service_id' => 'integer',
        'duration'           => 'integer',
        'price'              => 'float'
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
    protected $appends = ['submenu_name'];

    /**
     * The attributes that should be visible in toArray.
     *
     * @var array
     */
    protected $visible = [
        "id",
        "order_service_id",
        "submenu_service_id",
        "price",
        'duration',
        "submenu_name"
    ];

    /**
     * Validation create rules
     *
     * @var array
     */
    public static $rules = [
        'order_service_id'   => 'required',
        'submenu_service_id' => 'required',
        'duration'           => 'required',
        'price'              => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'order_service_id'   => 'required',
        'submenu_service_id' => 'required',
        'duration'           => 'required',
        'price'              => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'order_service_id'   => 'required',
        'submenu_service_id' => 'required',
        'duration'           => 'required',
        'price'              => 'required'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'order_service_id'   => 'required',
        'submenu_service_id' => 'required',
        'price'              => 'required',
        'duration'           => 'required',
    ];

    public function serviceSubmenu()
    {
        return $this->belongsTo(SubmenuService::class, "submenu_service_id", "id");
    }

    public function getSubmenuNameAttribute()
    {
        if (isset($this->submenu_service_id)) {
            return $this->serviceSubmenu->name;
        }
        return null;
    }
}
