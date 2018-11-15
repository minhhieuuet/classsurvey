@extends('StudentLayout.master')
@section('content')


<script type="text/javascript">
// Session  login success
@if(session('login-success'))
  swal({
    title:"Đăng nhập thành công",
    type:"success",
    text:"<?php echo 'Chào mừng '.$student['name'].' đến với hệ thống Class Survey' ?>",
    showConfirmButton:false,
    timer:2500
  })
@endif
@if(session('submitSuccess'))

swal({
  title:"Thành công",
  type:"success",
  text:"<?php echo session('submitSuccess') ?>",
  showConfirmButton:false,
  timer:2500
})

@endif
</script>

<h1 class="title">
  Khảo sát của tôi
</h1>
<div class="row">

  @foreach($student->courses as $course)
    <table class="table col-md-4 table-bordered" style="margin:30px;">
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
          <td> <strong>Trạng thái</strong> </td>
          @if($course->done(Auth::user()->name,$course['id']))
          <td class="text-success">
             Đã hoàn thành
          </td>
          @else
            <td class="text-danger">
              Chưa hoàn thành
            </td>
          @endif
        </tr>
        <tr>
          <td>Hành động</td>
          <td>
            @if($course->done(Auth::user()->name,$course['id']))
              <a  href="{{asset('sinh-vien/khao-sat/'.$course['id'])}}">
              <button type="button" class="btn btn-warning">
               <i class="fa fa-pencil"></i>  Sửa khảo sát
              </button>
            @else
              <a  href="{{asset('sinh-vien/khao-sat/'.$course['id'])}}">
              <button type="button" class="btn btn-success">
               <i class="fa fa-pencil"></i>  Hoàn thành ngay
              </button>
            @endif
          </a>
          </td>
        </tr>
      </tbody>
    </table>
  @endforeach
</div>



@endsection
