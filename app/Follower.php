<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Follower extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'followers';
    protected $fillable = [
        'follower_id', 
        'following_id', 
        'status',
        'attempts',
    ];
    public function follower()
    {
        return $this->belongsTo('App\User','follower_id');
    }
    public function following()
    {
        return $this->belongsTo('App\User','following_id');
    }
    public function notifications()
    {
        return $this->morphMany('App\Notification', 'notificationable');
    }
}
