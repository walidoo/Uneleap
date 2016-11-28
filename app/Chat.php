<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Chat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'chats';
    protected $fillable = [
        'message', 
        'sender_id', 
        'receiver_id',
        'is_read',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    //awais
}
