<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $primaryKey = 'DepartmentID';

    protected $fillable = [
        'CollegeID',
        'DepartmentName',
        'DepartmentCode',
        'IsActive'
    ];

    public function college() 
    {
        return $this->belongsTo(College::class, 'CollegeID', 'CollegeID');
    }
}
