<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
class Library extends Model
{
    protected $table = 'libraries';
    protected $fillable = [
        'title', 
        'description', 
        'cover',
        'cover_extension',
        'cover_filename',
        'attachment',
        'attachment_extension',
        'attachment_filename', 
        'author',
        'privacy',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function filters()
    {
        return $this->hasMany('App\LibraryFilter');
    }
    public function comments()
    {
        return $this->hasMany('App\LibraryComment');
    }
    public function tags() {
        return $this->hasMany('App\LibraryFilter')->where("type", Config::get('constants.Filter_Type_Tag'));
    }
}