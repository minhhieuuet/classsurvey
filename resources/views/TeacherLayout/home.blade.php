@extends('TeacherLayout.master')
@section('content')


<script type="text/javascript">
// Session  login success
@if(session('login-success'))
  swal({
    title:"Đăng nhập thành công",
    type:"success",
    text:"<?php echo 'Chào mừng '.$teacher['full_name'].' đến với hệ thống Class Survey' ?>",
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
              <a href="{{asset('giang-vien/khao-sat/'.$course['id'])}}">
              <button type="button" class="btn btn-info" name="button">
                <i class="fas fa-info-circle"></i> Xem thống kê
              </button>
              </a>
              <a href="{{asset('giang-vien/khao-sat/danh-sach/'.$course['id'])}}">
              <button type="button" class="btn btn-success" name="button">
                <i class="fas fa-users"></i> Xem danh sách
              </button>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    @endforeach
</div>



@endsection
