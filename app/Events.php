<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model {

    protected $table = 'events';

    public function filters() {
        return $this->hasMany('App\EventFilter', 'event_id');
    }

    public function countries() {
        return $this->hasMany('App\EventFilter')->where("type", Config::get('constants.Filter_Type_Country'));
    }

    public function tags() {
        return $this->hasMany('App\EventFilter')->where("type", Config::get('constants.Filter_Type_Tag'));
    }

    public function universities() {
        return $this->hasMany('App\EventFilter')->where("type", Config::get('constants.Filter_Type_University'));
    }

    public function courses() {
        return $this->hasMany('App\EventFilter')->where("type", Config::get('constants.Filter_Type_Course'));
    }

    public function bookings() {
        return $this->hasMany('App\BookEvent','event_id');
    }

}
