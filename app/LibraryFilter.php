<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryFilter extends Model
{
    protected $table = 'library_filters';
    protected $fillable = [
        'filter', 
        'type', 
        'library_id',
        'user_id'
    ];
    
    public function library()
    {
        return $this->belongsTo('App\Library');
    }
}
