<?php

namespace App\Http\Controllers;
use App\TeacherAccount;
use App\StudentAccount;
use App\Course;
use App\Survey;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
      $teacherCount = TeacherAccount::count();
      $studentCount = StudentAccount::count();
      $surveyCount = Survey::count();
      $courseCount = Course::count();
      return view('home',compact('teacherCount','studentCount','surveyCount','courseCount'));
    }

    public function checkExistingAccount($username){
      return User::where('name',$username)->count()>0?'true':'false';
    }
}
