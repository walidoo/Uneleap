<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Question extends Model {

    protected $fillable = [
        'title',
        'description',
        'link',
        'path',
        'extension',
        'filename',
        'privacy',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\QuestionComment');
    }

    public function likes() {
        return $this->hasMany('App\QuestionLike');
    }

    public function likedByMe() {
        return $this->hasOne('App\QuestionLike')->where("user_id", \Auth::user()->id);
    }

    public function filters() {
        return $this->hasMany('App\QuestionFilter');
    }

    public function countries() {
        return $this->hasMany('App\QuestionFilter')->where("type", Config::get('constants.Filter_Type_Country'));
    }

    public function tags() {
        return $this->hasMany('App\QuestionFilter')->where("type", Config::get('constants.Filter_Type_Tag'));
    }

    public function universities() {
        return $this->hasMany('App\QuestionFilter')->where("type", Config::get('constants.Filter_Type_University'));
    }

    public function courses() {
        return $this->hasMany('App\QuestionFilter')->where("type", Config::get('constants.Filter_Type_Course'));
    }

}
