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
 *      definition="Category",
 *      required={"petspace_id", "name", "description"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
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
class Category extends Model
{
    use SoftDeletes;

    public $table = 'categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'petspace_id',
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'petspace_id' => 'integer',
        'name' => 'string',
        'description' => 'string'
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
        'petspace_id' => 'required',
        'name' => 'required',
        'description' => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'petspace_id' => 'required',
        'name' => 'required',
        'description' => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'petspace_id' => 'required',
        'name' => 'required',
        'description' => 'required'
    ];
	
	/**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'petspace_id' => 'required',
        'name' => 'required',
        'description' => 'required'
    ];

    public function service()
    {
        return $this->hasMany(CategoryService::class);
    }

}
