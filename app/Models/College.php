<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    //
    protected $primaryKey = 'CollegeID';

    protected $fillable = [
        'CollegeName',
        'CollegeCode',
        'IsActive',
    ];

    public function departments() 
    {
        return $this->hasMany(Department::class, 'CollegeID', 'CollegeID');
    }
}
