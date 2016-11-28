<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Education extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'educations';
    protected $fillable = [
        'school_name', 
        'field_of_study', 
        'grade',
        'starting_year', 
        'starting_year', 
        'is_current',
        'description', 
        'activities', 
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
