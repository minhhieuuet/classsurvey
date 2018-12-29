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
    //Admin Home
    public function index(){
      $teacherCount = TeacherAccount::count();
      $studentCount = StudentAccount::count();
      $surveyCount = Survey::count();
      $courseCount = Course::count();
      return view('home',compact('teacherCount','studentCount','surveyCount','courseCount'));
    }

    //Check existing account
    public function checkExistingAccount($username){
      return User::where('name',$username)->count()>0?'true':'false';
    }

    //Get content of the default survey
    public function getDefaultSurveyContent(){
      $defaultSurveyContent = Survey::where('default',1)->firstOrFail();
      return $defaultSurveyContent['content'];
    }
}
