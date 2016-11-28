<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityNews extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'university_news';
    protected $fillable = [
        'title',
        'description',
        'attachment',
        'filename',
        'university_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\University');
    }

    //awais
}
