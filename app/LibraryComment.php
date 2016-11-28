<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryComment extends Model
{
    protected $table = 'library_comments';
    protected $fillable = [
        'comment', 
        'library_id', 
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
