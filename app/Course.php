<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'courses';
    protected $fillable = [
        'name',
    ];
    
}
