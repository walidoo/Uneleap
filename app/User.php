<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
        'country',
        'gender',
        'university',
        'university_id',
        'degree',
        'country',
        'type',
        'job_title',
        'description',
        'user_type',
        'profile_picture_path',
        'profile_picture_filename',
        'profile_cover_path',
        'profile_cover_filename',
        'language',
        'status',
        'privacy',
        'university_list_id',
        'course_list_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions() {
        return $this->hasMany('App\Question');
    }

    public function experiences() {
        return $this->hasMany('App\Experience');
    }

    public function skills() {
        return $this->hasMany('App\Skill');
    }

    public function educations() {
        return $this->hasMany('App\Education');
    }

    public function chats() {
        //return $this->hasMany('App\Chat','sender_id')->orWhere('receiver_id',\Auth::id());
        return $this->hasMany('App\Chat', 'sender_id')->orWhere('receiver_id', \Auth::id());
    }

    public function allFollowerList() {
        return $this->hasMany('App\Follower', 'follower_id');
    }

    public function followings() {
        return $this->hasMany('App\Follower', 'follower_id')->where('status', Config::get('constants.FollowApproved'));
    }

    public function followers() {
        return $this->hasMany('App\Follower', 'following_id')->where('status', Config::get('constants.FollowApproved'));
    }

    public function pendingFollowers() {
        return $this->hasMany('App\Follower', 'following_id')->where('status', Config::get('constants.FollowPending'));
    }

    public function pendingFollowings() {
        return $this->hasMany('App\Follower', 'follower_id')->where('status', Config::get('constants.FollowPending'));
    }

    public function getProfilePicturePathAttribute($value) {
        if (empty($value)) {
            return '/images/profile.png';
        }
        return $value;
    }

    

}
