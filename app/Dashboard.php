<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'dashboards';
    protected $with = ['user']; 
    protected $fillable = [
        'dashboardable_id',
        'dashboardable_type',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function dashboardable() {
        return $this->morphTo();
    }

}
