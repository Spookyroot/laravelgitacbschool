<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'sub_name', 'id','updated_at','created_at'];

function course()
    {
        return $this->belongsToMany(Course::class);
    }


    function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }



}
