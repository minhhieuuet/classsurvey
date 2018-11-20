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
      $full_name = trim(TeacherAccount::where('username','like',"%".\Auth::user()->name."%")->first()['full_name']);
      $courses = Course::where('teacher_name','like','%'.$full_name.'%')->get();
      return view('TeacherLayout.home',compact('teacher','courses','test'));
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

    public function courseStudents($id){
      $course = Course::findOrFail($id);
      $students = $course->students;
      return view('TeacherLayout.course-students',compact('students'));
    }
}
