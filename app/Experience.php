<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Experience extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 
        'job_title', 
        'location',
        'date_from', 
        'date_to', 
        'project_title',
        'is_currently_working', 
        'description', 
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
