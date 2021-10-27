<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'subjects_code', 'teacher_id', 'course_des','updated_at', 'created_at'];

    function subjects() 
    {
        return $this->belongsTo(Subject::class);
        }

        function teacher() 
        {
            return $this->belongsTo(Teacher::class);
            }
}


