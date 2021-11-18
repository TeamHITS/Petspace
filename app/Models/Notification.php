<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property integer sender_id
 * @property integer ref_id
 * @property string action_type
 * @property string url
 * @property string message
 * @property integer status
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 *
 * @property User users
 *
 * @SWG\Definition(
 *      definition="Notification",
 *      required={"sender_id", "url", "action_type", "ref_id", "message", "status"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="sender_id",
 *          description="sender_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="url",
 *          description="url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="action_type",
 *          description="action_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ref_id",
 *          description="ref_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="message",
 *          description="message",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="boolean"
 *      )
 * )
 *
 * @SWG\Definition(
 *      definition="Push-Notification",
 *      required={"reciever_id", "action_type", "ref_id", "message"},
 *      @SWG\Property(
 *          property="reciever_id",
 *          description="reciever_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="action_type",
 *          description="action_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ref_id",
 *          description="ref_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="message",
 *          description="message",
 *          type="string"
 *      )
 * )
 */
class Notification extends Model
{
    use SoftDeletes;

    public $table = 'notifications';

    protected $dates = ['deleted_at'];

    const DRIVER_ON_WAY       = 'driver_on_way';
    const AT_LOCATON          = 'at_location';
    const SERVICE_IN_PROGRESS = 'service_in_progress';
    const SREVICE_COMPLETED   = 'service_completed';
    const RATING_REMINDER     = "rating_reminder";
    const PROMOTION           = "promotion";

    public static $ACTION_TYPES = [
        self::DRIVER_ON_WAY       => 'Technician on the way',
        self::AT_LOCATON          => 'Technician at your location',
        self::SERVICE_IN_PROGRESS => 'Service in Progress',
        self::SREVICE_COMPLETED   => 'Service Completed',
        self::RATING_REMINDER     => 'Rate service',
        self::PROMOTION           => 'promotion',

    ];

    public $fillable = [
        'sender_id',
        'url',
        'action_type',
        'ref_id',
        'message',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'url'         => 'string',
        'action_type' => 'string',
        'message'     => 'string',
        'status'      => 'boolean'
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
        'action_type' => 'required',
        'message'     => 'required',
    ];

    /**
     * Validation update rules
     *
     * @var array
     */
    public static $update_rules = [
        'action_type' => 'required',
        'message'     => 'required',
    ];

    /**
     * Validation api rules
     *
     * @var array
     */
    public static $api_rules = [
        'action_type' => 'required',
        'message'     => 'required'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_users')->withPivot('status');
    }

    public function getUsersCsvAttribute()
    {
        return implode(",", $this->users->pluck('name')->all());
    }

    public static function add_new_notification($data)
    {
      return Notification::create($data);
       
    }
    
    public static function create_notification($user_id, $title, $message){
        $sender_id = \Auth::id();
        $notification = Notification::create([
            'sender_id' =>  $sender_id ? $sender_id : 1,
            'url' => null,
            'action_type' => $title,
            'ref_id' => $user_id,
            'message' => $message,
            'status' => 1
        ]);
        logger($notification);
        return $notification;
    }

    public function markAsRead()
    {
        return $this->update([
            'status' =>1
        ]);
    }

}
