<?php

namespace App\Http\Controllers;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Http\Request;
use App\TeacherAccount;
use App\User;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Teacher HomePage
    public function index()
    {
        $accounts = TeacherAccount::paginate(20);
        return view('teacher.index',compact('accounts'));
    }

    // Import teacher  from xlsx

    public function import(Request $request){
      // import teacher form file
      if($request->hasFile('teachers')){

        $file = $request -> teachers;
        if($file->getClientOriginalExtension() == 'xlsx'){
          $teachers = (new FastExcel)->import($file)->toArray();
          // check if the first column is STT
          if(strtolower(array_keys($teachers[0])[0])!="stt"){
            return redirect()->back()->with('error','File không đúng định dạng');
          }


          $arr = array_filter($teachers,function($teacher){
            return $teacher['STT'] != '';
          });

            foreach($arr as $teacher){
              $value = array_values($teacher);
              TeacherAccount::updateOrCreate(["username"=>trim($value[1])],
              ["username"=>$this->trim_str($value[1]),
              "full_name"=> $this->trim_str($value[3]),
              "vnu_mail"=>$this->trim_str($value[4])]);

              User::firstOrCreate(["name"=>$this->trim_str($value[1])],["name"=>$this->trim_str($value[1]),
              "email"=>$this->trim_str($value[4]),
              "password"=>bcrypt(trim($value[2])),
              "role"=>2]);
            }

            return redirect()->back()->with('success','Done');
        }
        else{
          return redirect()->back()->with('error','File không đúng định dạng');
        }


      }
      // return $request;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Store a Teacher
    public function store(Request $request)
    {
      $request->validate([
        "username"=>"required|unique:teacher_accounts",
        "password"=>"required|min:7",
        "full_name"=>"required",
        "vnu_mail"=>"required|email"
      ]);
      //Create Teacher Account
      TeacherAccount::create(["username"=>$request['username'],"full_name"=>$request['full_name'],
      "vnu_mail"=>$request['vnu_mail']]);
      //Create Teacher User
      User::create(["name"=>$request['username'],"password"=>bcrypt($request['password']),"email"=>$request['vnu_mail']]);
      return redirect()->back()->with('create-success','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //Show Teacher Information
    public function show($id)
    {
        $teacher = TeacherAccount::findOrFail($id);
        return view('teacher.teacherView',compact('teacher'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //Update teacher information
    public function update(Request $request, $id)
    {
      $request->validate([
        "username"=>'required|unique:teacher_accounts,username,'.$id,
        "full_name"=>"required",
        "vnu_mail"=>"required|email"
      ]);

      $teacher = TeacherAccount::findOrFail($id);
      //User table
      $teacherAccount = User::where('name',$teacher['username'])->first();
      $teacherAccount -> name = $request['username'];
      if($request['password']!= null && $request['password']==$request['re_password']){
        $teacherAccount -> password = bcrypt($request['password']);
      }
      $teacherAccount -> email = $request['vnu_mail'];
      $teacherAccount -> save();

      //Teacher Account table
      $teacher ->  username = $request['username'];
      $teacher -> full_name = $request['full_name'];
      $teacher -> vnu_mail = $request['vnu_mail'];

      $teacher -> save();


      return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //Delete a teacher from database
    public function destroy($id)
    {

        $account = TeacherAccount::findOrFail($id);
        $account ->delete();
        $userAccount = User::where('name','like','%'.$account['username'].'%')->first();
        if($userAccount){
          $userAccount -> delete();
        }
        return redirect()->back()->with('del-success','Xóa thành công');
    }

}
