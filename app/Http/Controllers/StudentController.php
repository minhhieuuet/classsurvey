<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Student;
use App\StudentAccount;
use App\User;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //Student accounts list
    public function index()
    {
        $accounts = StudentAccount::orderBy('id','DESC')->paginate(20);
        return view('student.index',compact('accounts'));
    }

    //Students list
    public function list(){
        $students = Student::orderBy('id','DESC')->paginate(20);
        return view('student.list',compact('students'));
    }

    //Store student
    public function store(Request $request)
    {
      $request->validate([
        "username"=>"required|unique:student_accounts",
        "password"=>"required|min:7",
        "full_name"=>"required",
        "vnu_mail"=>"required|email"
      ]);

      StudentAccount::create(["username"=>$request['username'],"full_name"=>$request['full_name'],
      "vnu_mail"=>$request['vnu_mail'],"school_year"=>$request['school_year']]);
      User::updateOrCreate(['name'=>$request['username'],"password"=>bcrypt($request['password']),"email"=>$request['vnu_mail'],"role"=>3]);
      return redirect()->back()->with('create-success','Thêm thành công');
    }

     // Import students account from excel
     public function import(Request $request){
       // import teacher form file

       if($request->hasFile('file')){

         $file = $request -> file;
         if($file->getClientOriginalExtension() == 'xlsx'){
           $students = (new FastExcel)->import($file)->toArray();
           // check if the first column is STT
           if(strtolower(array_keys($students[0])[0])!="stt"){
             return redirect()->back()->with('error','File không đúng định dạng');
           }


           $arr = array_filter($students,function($student){
             return $student['STT'] != '';
           });

             foreach($arr as $student){
               $value = array_values($student);
               // filter only number
               $username = preg_replace('/[^0-9]/', '', $value[1]);
               StudentAccount::updateOrCreate(["username"=>$this->trim_str($username)],
               ["username"=>$this->trim_str($username),"full_name"=>$value[3],
               "vnu_mail"=>$value[4],"school_year"=>$value[5]]);
               User::updateOrCreate(["name"=>$this->trim_str($username)],['name'=>$this->trim_str($username),"password"=>bcrypt($value[2]),"email"=>$value[4],"role"=>3]);
             }

             return redirect()->back()->with('success','Done');
         }
         else{
           return redirect()->back()->with('error','File không đúng định dạng');
         }

     }else{
       return redirect()->back();
     }
   }

   //Update student information
    public function update(Request $request, $id)
    {
      $request->validate([
        "username"=>'required|unique:student_accounts,username,'.$id,
        "full_name"=>"required",
        "vnu_mail"=>"email"
      ]);
      $student = StudentAccount::findOrFail($id);
      $student ->  username = $this->trim_str($request['username']);
      $student -> full_name = $request['full_name'];
      $student -> vnu_mail = $request['vnu_mail'];
      $student -> school_year = $request['school_year'];

      $studentUser = User::where('name',$student ->  username)->first();
      if($request['password']!= null && $request['password']==$request['re_password']){
        $studentUser -> password = bcrypt($request['password']);
      }
      $studentUser->save();
      $student -> save();
      return redirect()->back();
    }

    //Delete student
    public function destroy($id)
    {
        $student = StudentAccount::findOrFail($id);
        User::where('name',$student['student_code'])->delete();
        $student->delete();
        return redirect()->back()->with('del-success','Xóa thành công');
    }
}
