<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'notifications';
    protected $fillable = [
        'title', 
        'description', 
        'type',
        'is_read',
		'notificationable_id',
		'notificationable_type',
		'user_id',
		
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function notificationable()
    {
        return $this->morphTo();
    }
    
}
