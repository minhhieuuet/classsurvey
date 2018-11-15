<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
      if(Auth::check()){
        return redirect()->back();
      }else{
        return view('login');
      }
    }
    public function authLogin(Request $request){
      if(Auth::attempt(["name"=>$request['username'],"password"=>$request["password"],"role"=>1])){
        return redirect()->route('home')->with('login-success','Chào mừng');
      }
      else{
        if(Auth::attempt(["name"=>$request['username'],"password"=>$request["password"],"role"=>3])){
          return redirect()->route('studentHome')->with('login-success','Chào mừng');
        }
        else{
            if(Auth::attempt(["name"=>$request['username'],"password"=>$request["password"],"role"=>2])){
              return redirect()->route('teacherHome')->with('login-success','Chào mừng');
            }
            else{
              return redirect()->back()->with('error','Tài khoản hoặc mật khẩu không khớp');
            }
        }

      }
    }

    public function logout(){
      Auth::logout();
      return redirect()->back();
    }
}
