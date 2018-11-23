<?php

namespace App\Http\Controllers;
use Auth;
use App\TeacherAccount;
use Illuminate\Http\Request;
use App\Course;
use App\User;
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
    // About me
    public function me(){
      $teacher_username = \Auth::user()->name;
      $teacher = TeacherAccount::where('username',$teacher_username)->first();
      return view('TeacherLayout.me',compact('teacher'));
    }

    // Change password
    public function changePass(){
      return view('TeacherLayout.changepass');
    }

    public function postChangePass(Request $request){
      $request->validate([
        "oldPass"=>"required",
        "newPass"=>"required|min:8|same:confirmNewPass",
        "confirmNewPass"=>"required:min:8"
      ]);
      if(\Hash::check($request->oldPass,\Auth::user()->password)){
        $user = User::find(\Auth::user()->id);
        $user->password = bcrypt($request->newPass);
        $user->save();
        return redirect()->back()->with('success',"Thay doi thanh cong");
      }else{
        return redirect()->back()->with("error","Mật khẩu hiện tại không đúng");
      }

    }
}
