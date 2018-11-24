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

      $arr = json_decode(json_encode($results));
      $resultsArr = [];

      foreach($arr as $item){
        array_push($resultsArr,json_decode($item->content,true));
      }
      $input = $resultsArr;
      $survey_keys = [];
      foreach($input as $sinhvien) {
        $keys = array_keys($sinhvien);
        $survey_keys = array_merge($survey_keys, $keys);
      }
      $survey_keys = array_unique($survey_keys);

      $survey_values = array_fill(0, sizeof($survey_keys), 0);

      $survey_result = array_combine($survey_keys, $survey_values);

      $survey = array_fill(0, sizeof($input), $survey_result);

      $i = 0;
      foreach($input as $sinhvien) {
          foreach($sinhvien as $key => $value) {
            $survey[$i][$key] = $sinhvien[$key];
          }
          $i++;
      }

      $count = $survey_result;

      // gia tri trung binh
      $sum1 = $survey_result;
      foreach($survey as $sinhvien) {
        foreach($sinhvien as $key => $value) {
          if($value > 0) {
            $sum1[$key] += $value;
            $count[$key]++;
          }
         }
      }
      $result1 = $survey_result;
      foreach($result1 as $key => $value) {
        $result1[$key] = $sum1[$key]/$count[$key];
      }



      $sum2 = $survey_result;
      foreach($survey as $sinhvien) {
        foreach($sinhvien as $key => $value) {
          if($value > 0) {
            $temp = ($value - $result1[$key]);
            $temp = pow($temp, 2);
            $sum2[$key] += $temp;
          }
         }
      }

      $result2 = $survey_result;
      foreach($result2 as $key => $value) {
        if($count[$key] == 1) {
          $result2[$key] = $sum2[$key]/($count[$key]);
        }
        else {
          $result2[$key] = $sum2[$key]/($count[$key]-1);
        }
        $result2[$key] = sqrt($result2[$key]);
      }

      return view('TeacherLayout.course-info',compact('course','survey_keys','result1','result2'));
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
