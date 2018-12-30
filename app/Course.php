<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Result;

class Course extends Model
{
    protected $table = "courses";

    //Survey has many courses
    public function survey(){
      return $this -> belongsTo('App\Survey','survey_id','id');
    }

    //Course has one teacher
    public function teacher(){
      return $this -> hasOne('App\TeacherAccount','id','teacher_account_id');
    }

    //Course has many students and student has many courses
    public function students(){
      return $this ->belongsToMany('App\Student','students_courses','course_id','student_id');
    }

    //Courses has many results
    public function results(){
      return $this ->hasMany('App\Result');
    }
    // Count joining students
    public function joiningCount($courseId){
      return Result::where('course_id',$courseId)->count();
    }
    //Check student done the survey
    public function done($username,$course_id){
      $studentAccount = StudentAccount::where('username','like','%'.$username.'%')->first();
      if(Result::where(['course_id'=>$course_id,'student_account_id'=>$studentAccount['id']])->count()){
        return true;
      }
      return false;
    }
}
