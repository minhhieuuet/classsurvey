<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\Course;
use App\Result;
use App\StudentAccount;
class StudentLayoutController extends Controller
{
    public function index(){
      $studentCode = \Auth::user()->name;
      $student = Student::where('student_code','like',"%".$studentCode."%")->first();
      return view('StudentLayout.home',compact('student'));
    }
    // About me page
    public function me(){
      $studentCode = \Auth::user()->name;
      $student = Student::where('student_code','like',"%".$studentCode."%")->first();
      return view('StudentLayout.me',compact('student'));
    }
    // Survey
    public function survey($id){
      $name = \Auth::user()->name;
      $course = Course::find($id);
      $survey = Course::find($id)['survey'];
      $result = Result::where(['course_id'=>$id,'student_account_id'=>StudentAccount::where('username','like','%'.\Auth::user()->name.'%')->first()['id']])->first()['content'];
      $courses = Student::where('student_code','like','%'.$name.'%')->first()->courses->toArray();
      // Check if student join in the right survey
      foreach($courses as $course){
        // if all courses student joining contain this course
        if($course['code'] == Course::find($id)['code']){
          return view('StudentLayout.survey',compact('survey','course','result'));
        }
      }
      return redirect()->back();


    }

    public function submitSurvey(Request $request){
      $studentCode = \Auth::user()->name;
      $studentAccount = StudentAccount::where('username','like','%'.$studentCode.'%')->first();
      $course = Course::find($request->course_id);

      $resultCount = Result::where(['course_id' => $request->course_id,'student_account_id' => $studentAccount['id']])->count();
      if(!$resultCount){
        Result::create([
          'course_id' => $request->course_id,
          'survey_id' => $request->survey_id,
          'content' => $request->content,
          'student_account_id'=>$studentAccount['id']
        ]);
      }else{
        $result = Result::where(['course_id' => $request->course_id,'student_account_id' => $studentAccount['id']])->first();
        $result -> content = $request->content;
        $result ->save();
      }


      return redirect()->route('studentHome')->with('submitSuccess','Bạn đã hoàn thành khảo sát \"'.$course['name'].'\"');
    }
    // Change password
    public function changePass(){
      return view('StudentLayout.changepass');
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
