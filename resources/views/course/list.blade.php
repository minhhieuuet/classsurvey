@extends('index')
@section('content')
<h1 class="title">
  Các cuộc khảo sát
</h1>
<div class="row">

@foreach($courses as $course)
    <table class="table col-md-6 table-bordered" >
      <thead class="text-center">
        <tr class="text-uppercase" style="font-weight:bold;">
          <td colspan="2">{{$course['name']}}</td>
        </tr>
      </thead>
      <tbody>
        <tr class="success">
          <td><strong>Môn học</strong> </td>
          <td>{{$course['name']}}</td>
        </tr>
        <tr>
          <td> <strong>Mã môn học</strong> </td>
          <td>{{$course['code']}}</td>
        </tr>
        <tr>
          <td> <strong>Giảng viên</strong> </td>
          <td>{{$course['teacher_name']}}</td>
        </tr>
        <tr>
          <td> <strong>Số sinh viên </strong> </td>
          <td> {{$course->students->count()}} </td>
        </tr>
        <tr>
          <td> <strong>Sinh viên đã tham gia</strong> </td>
          <td>  {{$course->joiningCount($course['id'])}} </td>
        </tr>
        <tr>
          <td>Hành động</td>
          <td>
            <a href="{{asset('admin/khao-sat/thong-ke/'.$course['id'])}}">
            <button type="button" class="btn btn-info" name="button">
              <i class="fas fa-info-circle"></i> Xem chi tiết
            </button>
          </a>
          </td>
        </tr>
      </tbody>
    </table>
  @endforeach
</div>
@endsection
