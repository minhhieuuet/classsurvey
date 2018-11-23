@extends('TeacherLayout.master')
@section('content')
  <style media="screen">
    .card td{
      width:300px;

    }
  </style>

  <div class="card" style="width:60%; margin:0px auto;">
    <div class="card-header">
      Thông tin giảng viên {{$teacher['full_name']}}
    </div>
    <div class="card-body" style="font-size:20px;">
      <h3 class="card-title"></h3>
      <table class="table table-dashed">
        <tr>
          <td>Họ và tên</td>
          <td> {{$teacher['full_name']}} </td>
        </tr>
        <tr>
          <td>Tên đăng nhập </td>
          <td> {{Auth::user()->name}} </td>
        </tr>
        <tr>
          <td>VNU email</td>
          <td> {{Auth::user()->email}} </td>
        </tr>
        <tr>
          <td>Ngày tạo</td>
          <td> {{Auth::user()->created_at}} </td>
        </tr>
        <tr>
          <td>Sửa lần cuối</td>
          <td> {{Auth::user()->updated_at}} </td>
        </tr>
      </table>

    </div>
  </div>
@endsection
