<?php

namespace App\Models;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer id
 * @property integer user_id
 * @property string first_name
 * @property string last_name
 * @property string phone
 * @property string address
 * @property integer gender
 * @property string image
 * @property string date_of_birth
 * @property integer area_id
 * @property integer is_verified
 * @property integer email_updates
 * @property integer is_social_login
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @property string image_url
 *
 * @property User user
 *
 * * @SWG\Definition(
 *      definition="Details",
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="phone",
 *          description="phone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          description="image",
 *          type="string"
 *      ), @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="integer"
 *      ),@SWG\Property(
 *          property="date_of_birth",
 *          description="date_of_birth",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="email_updates",
 *          description="email_updates, acceptable values 0,1. ",
 *          type="integer"
 *      )
 * )
 */
class UserDetail extends Model
{
    use SoftDeletes;
    public $table = 'user_details';


    //Gender
    const MALE   = 10;
    const FEMALE = 20;

    public static $USER_GENDER = [
        self::MALE   => 'Male',
        self::FEMALE => 'Female'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'gender',
        'date_of_birth',
        'address',
        'image',
        'email_updates',
        'technician_color',
        'service_assignment',
        'is_verified',
        'is_social_login'
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
    protected $appends = [
        'image_url',
        'full_name',
        "gender_text"
    ];

    /**
     * The attributes that should be visible in toArray.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'first_name',
        'last_name',
        'full_name',
        'phone',
        'gender',
        'address',
        'image',
        'date_of_birth',
        'image_url',
        "gender_text",
        'area_id',
        'is_verified',
        'email_updates',
        'is_social_login',
        'technician_color',
        'service_assignment',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return ($this->first_name != $this->last_name) ? $this->first_name . " " . $this->last_name : $this->first_name;
    }
    /**
     * @return string
     */
    public function getImageUrlAttribute()
    {
        return ($this->image && storage_path(url('storage/app/' . $this->image))) ? route('api.resize', ['img' => $this->image]) : route('api.resize', ['img' => 'users/user.png', 'w=100', 'h=100']);
    }

    public function getGenderTextAttribute()
    {
        if(isset($this->gender) && isset(self::$USER_GENDER[$this->gender])){
            return self::$USER_GENDER[$this->gender];
        }
        return null;
    }
}
