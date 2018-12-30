<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_code','name','school_year'];

    //Student has one Student Account
    public function account(){
      return $this->hasOne('App\StudentAccount','username','student_code');
    }

    //Course has many student 
    public function courses(){
      return $this->belongsToMany('App\Course','students_courses','student_id','course_id');
    }
}
