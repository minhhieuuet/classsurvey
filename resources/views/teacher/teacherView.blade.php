@extends('index')
@section('content')
  <style media="screen">
    .card td{
      width:300px;

    }
  </style>

  <div class="card" style="width:60%; margin:0px auto;">
    <div class="card-header">
      Thông tin giảng viên
    </div>
    <div class="card-body" style="font-size:20px;">
      <h3 class="card-title">{{$teacher['full_name']}}</h3>
      <table class="table table-hover">
        <tr>
          <td>Tên đăng nhập </td>
          <td>{{$teacher['username']}}</td>
        </tr>
        <tr>
          <td>VNU email</td>
          <td>{{$teacher['vnu_mail']}}</td>
        </tr>
        <tr>
          <td>Ngày tạo</td>
          <td>{{$teacher['created_at']}}</td>
        </tr>
        <tr>
          <td>Sửa lần cuối</td>
          <td>{{$teacher['updated_at']}}</td>
        </tr>
      </table>

    </div>
  </div>

@endsection
