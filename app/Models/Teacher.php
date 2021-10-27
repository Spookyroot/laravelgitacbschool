<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    use HasFactory;
    protected $fillable = ['code', 't_firstname', 't_lastname','t_special','subject_id','id','updated_at', 'created_at'];

function course()
    {
        return $this->belongsToMany(Course::class);
    }

    function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}