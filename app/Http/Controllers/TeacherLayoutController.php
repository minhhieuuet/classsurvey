<?php

namespace App\Http\Controllers;
use Auth;
use App\TeacherAccount;
use Illuminate\Http\Request;
use App\Course;
class TeacherLayoutController extends Controller
{
    public function index(){
      $teacher = TeacherAccount::where('username','like','%'.Auth::user()->name.'%')->first();
      $courses = Course::where('teacher_name','like','%'.$teacher['full_name'].'%')->get();
      return view('TeacherLayout.home',compact('teacher','courses'));
    }

    public function courseInfo($id){
      $course = Course::find($id);
      $results = Course::find($id)->results;
      // Get all keys of all result
      $arrKeys =[];
      foreach($results as $result){
        $arrKeys = array_unique(array_merge($arrKeys,array_keys(json_decode($result['content'],true)))) ;
      }
      return view('TeacherLayout.course-info',compact('course','arrKeys'));
    }
}
