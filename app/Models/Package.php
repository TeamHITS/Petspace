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
 *      definition="Package",
 *      required={"petspace_id", "name", "package_type", "description", "image"},
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
 *          property="package_type",
 *          description="package_type",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
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
class Package extends Model
{
    use SoftDeletes;

    public $table = 'packages';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'petspace_id',
        'name',
        'package_type',
        'description',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'petspace_id'  => 'integer',
        'name'         => 'string',
        'package_type' => 'integer',
        'description'  => 'string',
        'image'        => 'string'
    ];

    /**
     * The objects that should be append to toArray.
     *
     * @var array
     */
    protected $with = ['packageSizes','packageAddons'];

    /**
     * The attributes that should be append to toArray.
     *
     * @var array
     */
    protected $appends = ['image_url','package_type_text'];

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
        'petspace_id'  => 'required',
        'name'         => 'required',
        'package_type' => 'required',
        'description'  => 'required',
        'image'        => 'required'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'petspace_id'  => 'required',
        'name'         => 'required',
        'package_type' => 'required',
        'description'  => 'required',
        'image'        => 'required'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'petspace_id'  => 'required',
        'name'         => 'required',
        'package_type' => 'required',
        'description'  => 'required',
        'image'        => 'required'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'petspace_id'  => 'sometimes',
        'name'         => 'sometimes',
        'package_type' => 'sometimes',
        'description'  => 'sometimes',
        'image'        => 'sometimes'
    ];

    public function packageSizes()
    {
        return $this->hasMany(PackageSize::class);
    }

    public function packageAddons()
    {
        return $this->hasMany(PackageAddon::class);
    }
    public function packageType()
    {
        return $this->hasOne(PackageType::class, 'id', 'package_type');
    }

    public function getPackageTypeTextAttribute(){

        $type = $this->packageType()->first();
        return $type->type;
    }

    public function getImageUrlAttribute()
    {
        return ($this->image && storage_path(url('storage/app/' . $this->image))) ? route('api.resize', ['img' => $this->image]) : route('api.resize', ['img' => 'packages/package.png', 'w=100', 'h=100']);
    }
}
