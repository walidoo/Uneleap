<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionFilter extends Model
{
    protected $table = 'question_filters';
    protected $fillable = [
        'filter', 
        'type', 
        'question_id',
        'user_id'
    ];
    
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
