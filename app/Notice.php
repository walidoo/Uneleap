<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Notice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'notices';
    protected $fillable = [
        'title', 
        'description', 
        'path',
        'filename',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
