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
 *      definition="SubmenuList",
 *      required={"cat_service_id", "name", "description", "condition_option", "select_count"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cat_service_id",
 *          description="cat_service_id",
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
 *          property="condition_option",
 *          description="condition_option",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="select_count",
 *          description="select_count",
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
class SubmenuList extends Model
{
    use SoftDeletes;

    public $table = 'submenu_lists';


    protected $dates = ['deleted_at'];

    //Grooming
    const MINIMUM = 10;
    const EQUAL   = 20;
    const MAXIMUM = 30;

    public static $CONDITION_TEXT = [
        self::MINIMUM => 'Minimum',
        self::EQUAL   => 'Equal',
        self::MAXIMUM => 'Maximum'
    ];

    public $fillable = [
        'cat_service_id',
        'name',
        'description',
        'condition_option',
        'select_count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'cat_service_id'   => 'integer',
        'name'             => 'string',
        'description'       => 'string',
        'condition_option' => 'integer',
        'select_count'     => 'integer'
    ];

    /**
     * The objects that should be append to toArray.
     *
     * @var array
     */
    protected $with = ['service'];

    /**
     * The attributes that should be append to toArray.
     *
     * @var array
     */
    protected $appends = ['condition_text'];

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
        'cat_service_id'   => 'required',
        'name'             => 'required',
        'description'       => 'required',
        'condition_option' => 'required',
        'select_count'     => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'cat_service_id'   => 'required',
        'name'             => 'required',
        'description'       => 'required',
        'condition_option' => 'required',
        'select_count'     => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'cat_service_id'   => 'required',
        'name'             => 'required',
        'description'       => 'required',
        'condition_option' => 'required',
        'select_count'     => 'required'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'cat_service_id'   => 'required',
        'name'             => 'required',
        'description'       => 'required',
        'condition_option' => 'required',
        'select_count'     => 'required'
    ];

    public function getConditionTextAttribute()
    {
        if (isset($this->condition_option) && isset(self::$CONDITION_TEXT[$this->condition_option])){
            return self::$CONDITION_TEXT[$this->condition_option];
        }
        return null;
    }

    public function service()
    {
        return $this->hasMany(SubmenuService::class, 'submenu_id', 'id');
    }
}
