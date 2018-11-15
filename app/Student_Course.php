<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Course extends Model
{
    protected $table = 'students_courses';
    protected $fillable=['student_id','course_id'];
}
