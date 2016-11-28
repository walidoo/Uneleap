<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class University extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'universities';
    protected $fillable = [
        'name', 
    ];
}
