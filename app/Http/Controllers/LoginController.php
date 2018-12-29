<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

  const ADMIN_ROLE = 1;
  const TEACHER_ROLE = 2;
  const STUDENT_ROLE = 3;
//Login page
    public function index(){
      if(Auth::check()){
        return redirect()->back();
      }else{
        return view('login');
      }
    }
//Authentication and redirect
    public function authLogin(Request $request){

      //Admin
      if(Auth::attempt(["name"=>$request['username'],"password"=>$request["password"],"role"=>self::ADMIN_ROLE])){
        return redirect()->route('home')->with('login-success','Chào mừng');
      }
      else{
        //Student
        if(Auth::attempt(["name"=>$request['username'],"password"=>$request["password"],"role"=>self::STUDENT_ROLE])){
          return redirect()->route('studentHome')->with('login-success','Chào mừng');
        }
        else{
          ///Teacher
            if(Auth::attempt(["name"=>$request['username'],"password"=>$request["password"],"role"=>self::TEACHER_ROLE])){
              return redirect()->route('teacherHome')->with('login-success','Chào mừng');
            }
            else{
              return redirect()->back()->with(['error'=>'Tài khoản hoặc mật khẩu không khớp','info'=>$request->all()]);
            }
        }

      }
    }

    //Log out
    public function logout(){
      Auth::logout();
      return redirect()->route('login');
    }
}
