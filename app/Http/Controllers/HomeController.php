<?php

namespace App\Http\Controllers;
use App\TeacherAccount;
use App\StudentAccount;
use App\Course;
use App\Survey;
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
}
