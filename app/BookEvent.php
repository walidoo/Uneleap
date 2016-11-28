<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookEvent extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'book_events';
    protected $fillable = [
        'event_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function event() {
        return $this->belongsTo('App\Events', 'event_id');
    }

}
