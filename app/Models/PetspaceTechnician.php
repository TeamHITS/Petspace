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
 *      definition="PetspaceTechnician",
 *      required={"user_id", "petspace_id", "status", "is_approved"},
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
 *          property="status",
 *          description="status",
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
class PetspaceTechnician extends Model
{
    use SoftDeletes;

    public $table = 'petspace_technicians';


    protected $dates = ['deleted_at'];

    //Grooming
    const AVAILABLE = 10;
    const INACTIVE  = 20;
    const DELIVERY  = 30;

    public static $STATUS_TEXT = [
        self::AVAILABLE => 'Available',
        self::INACTIVE  => 'In Active',
        self::DELIVERY  => 'Delivery'
    ];

    public static $STATUS_COLOR = [
        self::AVAILABLE => 'blue',
        self::INACTIVE  => 'pink',
        self::DELIVERY  => 'yellow'
    ];

    public $fillable = [
        'user_id',
        'petspace_id',
        'status',
        'is_approved'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'petspace_id' => 'integer',
        'status'      => 'integer',
        'is_approved' => 'boolean'
    ];

    /**
     * The objects that should be append to toArray.
     *
     * @var array
     */
    protected $with = ['user', 'shop'];

    /**
     * The attributes that should be append to toArray.
     *
     * @var array
     */
    protected $appends = ['status_text', 'status_color'];

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
        'user_id'     => 'required',
        'petspace_id' => 'required',
        'status'      => 'required',
        'is_approved' => 'sometimes'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'user_id'     => 'required',
        'petspace_id' => 'required',
        'status'      => 'required',
        'is_approved' => 'sometimes'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'user_id'     => 'required',
        'petspace_id' => 'required',
        'status'      => 'required',
        'is_approved' => 'sometimes'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'user_id'     => 'required',
        'petspace_id' => 'required',
        'status'      => 'required',
        'is_approved' => 'sometimes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getStatusTextAttribute()
    {
        return self::$STATUS_TEXT[$this->status];
    }

    public function getStatusColorAttribute()
    {
        return self::$STATUS_COLOR[$this->status];
    }

    public function shop()
    {
        return $this->belongsTo(Petspace::class, "petspace_id", "id");
    }
}
