<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    protected $table = 'question_comments';
    protected $fillable = [
        'comment', 
        'question_id', 
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
