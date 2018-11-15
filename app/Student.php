<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_code','name','school_year'];

    public function account(){
      return $this->hasOne('App\StudentAccount','username','student_code');
    }

    public function courses(){
      return $this->belongsToMany('App\Course','students_courses','student_id','course_id');
    }
}
