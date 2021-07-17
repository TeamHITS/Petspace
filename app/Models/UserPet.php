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
 *      definition="UserPet",
 *      required={"user_id", "name", "type", "gender", "breed", "weight", "color", "chip_id_num", "image", "birthdate", "neutered", "instruction", "created_at", "updated_at", "deleted_at"},
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
 *     @SWG\Property(
 *          property="neutered",
 *          description="neutered",
 *          type="boolean"
 *      ),
 *     @SWG\Property(
 *          property="instruction",
 *          description="instruction",
 *          type="string"
 *      )
 * )
 */
class UserPet extends Model
{
    use SoftDeletes;

    public $table = 'user_pets';


    protected $dates = ['deleted_at'];

    //Type
    const WOOF = 10;
    const MEOW = 20;

    //Gender
    const MALE   = 10;
    const FEMALE = 20;

    public static $PET_TYPE = [
        self::WOOF => 'Woof',
        self::MEOW => 'Meow'
    ];

    public static $PET_GENDER = [
        self::MALE   => 'Male',
        self::FEMALE => 'Female'
    ];

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
        'instruction',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'name'        => 'string',
        'type'        => 'integer',
        'gender'      => 'integer',
        'breed'       => 'string',
        'weight'      => 'string',
        'color'       => 'string',
        'chip_id_num' => 'string',
        'image'       => 'string',
        'birthdate'   => 'date:Y-m-d',
        'neutered'    => 'boolean',
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
    protected $appends = ["type_text", "gender_text", 'image_url'];

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
        'user_id'     => 'sometimes',
        'name'        => 'sometimes',
        'type'        => 'sometimes',
        'gender'      => 'sometimes',
        'breed'       => 'sometimes',
        'weight'      => 'sometimes',
        'color'       => 'sometimes',
        'chip_id_num' => 'sometimes',
        'image'       => 'required',
        'birthdate'   => 'required',
        'neutered'    => 'sometimes',
        'instruction' => 'sometimes',
        'created_at'  => 'sometimes',
        'updated_at'  => 'sometimes',
        'deleted_at'  => 'sometimes'
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'user_id'     => 'sometimes',
        'name'        => 'sometimes',
        'type'        => 'sometimes',
        'gender'      => 'sometimes',
        'breed'       => 'sometimes',
        'weight'      => 'sometimes',
        'color'       => 'sometimes',
        'chip_id_num' => 'sometimes',
        'image'       => 'sometimes',
        'birthdate'   => 'sometimes',
        'neutered'    => 'sometimes',
        'instruction' => 'sometimes',
        'created_at'  => 'sometimes',
        'updated_at'  => 'sometimes',
        'deleted_at'  => 'sometimes'
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'user_id'     => 'sometimes',
        'name'        => 'sometimes',
        'type'        => 'sometimes',
        'gender'      => 'sometimes',
        'breed'       => 'sometimes',
        'weight'      => 'sometimes',
        'color'       => 'sometimes',
        'chip_id_num' => 'sometimes',
        'image'       => 'sometimes',
        'birthdate'   => 'sometimes',
        'neutered'    => 'sometimes',
        'instruction' => 'sometimes'
    ];

    /**
     * Validation api update rules
     *
     * @var array
     */
    public static $api_update_rules = [
        'user_id'     => 'sometimes',
        'name'        => 'sometimes',
        'type'        => 'sometimes',
        'gender'      => 'sometimes',
        'breed'       => 'sometimes',
        'weight'      => 'sometimes',
        'color'       => 'sometimes',
        'chip_id_num' => 'sometimes',
        'image'       => 'sometimes',
        'birthdate'   => 'sometimes',
        'neutered'    => 'sometimes',
        'instruction' => 'sometimes'
    ];

    public function getGenderTextAttribute()
    {
        if (isset($this->gender) && isset(self::$PET_GENDER[$this->gender])){
            return self::$PET_GENDER[$this->gender];
        }
        return null;
    }

    public function getTypeTextAttribute()
    {
        if (isset($this->type) && isset(self::$PET_TYPE[$this->type])){
            return self::$PET_TYPE[$this->type];
        }
        return null;
    }

    public function getImageUrlAttribute()
    {
        return ($this->image && storage_path(url('storage/app/' . $this->image))) ? route('api.resize', ['img' => $this->image]) : route('api.resize', ['img' => 'pets/pet.png', 'w=100', 'h=100']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
