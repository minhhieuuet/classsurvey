@extends('index')

@section('content')
<div class="row">
  <div class="col-md-9">
    <h1 class="title">
      Danh sách sinh viên

    </h1>
  </div>
  <div class="col-md-3">


  </div>
</div>


<table class="table">
  <thead>

    <th>STT</th>
    <th>MSSV</th>
    <th>Họ và tên</th>
    <th>Niên khóa</th>
  </thead>
  <tbody>
    @foreach($students as $index => $student)
      <tr>
        <td>{{$index+1}}</td>
        <td>{{$student['student_code']}}</td>
        <td>{{$student['name']}}</td>
        <td>{{$student['school_year']}}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="row">
    <div class="col-md-2 col-md-offset-5" style="margin:0px auto;">

    </div>
</div>


@endsection
