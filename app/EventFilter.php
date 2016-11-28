<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventFilter extends Model
{
    protected $table = 'event_filters';
    protected $fillable = [
        'filter', 
        'type', 
        'event_id',
        'user_id'
    ];
    
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
