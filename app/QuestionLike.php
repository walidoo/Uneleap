<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionLike extends Model
{
    protected $table = 'question_likes';
    protected $fillable = [
        'question_id', 
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
