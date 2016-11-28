<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Feedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'feedbacks';
    protected $fillable = [
        'suggestion', 
        'rating', 
        'attachment',
        'filename',
        'description', 
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
