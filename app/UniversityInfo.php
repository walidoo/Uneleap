<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityInfo extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'university_infos';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'description1',
        'description2',
        'description3',
        'cover',
        'cover_filename',
        'profile',
        'profile_filename',
        'university_id',
        'user_id',
        'website',
        'tag_line',
    ];

    public function user() {
        return $this->belongsTo('App\University');
    }
    
    public function getProfileAttribute($value)
    {
        if (empty($value)) {
            return '/afowode@my.fit.edu_back.jpg';
        }
        return $value;
    }
    public function getCoverAttribute($value)
    {
        if (empty($value)) {
            return '/afowode@my.fit.edu_back.jpg';
        }
        return $value;
    }

    //awais
}
