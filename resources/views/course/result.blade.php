@extends('index')
@section('content')
<div class="conainer-fluid">
  <h5 class="text-center">KẾT QUẢ PHẢN HỒI CỦA NGƯỜI HỌC VỀ HỌC PHẦN</h5>
  <h6 class="text-center">Học kì : I năm 2018</h6>
  <br>
  Tên học phần:
  <br>
  Tên giảng viên: {{$course['teacher_name']}}
  <br>
  Số lượng SV đánh giá: {{$course->joiningCount($course['id'])}}
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>STT</th>
        <th>Tiêu chi</th>
        <th>M</th>
        <th>STD</th>
      </tr>
    </thead>
    <tbody>
    @foreach($survey_keys as $index => $key)
      <tr>
        <td>{{$index+1}}</td>
        <td>{{$key}}</td>
        <td>{{round($result1[$key],2)}}</td>
        <td>{{round($result2[$key],2)}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  <br>
  <b>Ghi chú:</b>
  <ol>
    <li> <b>M</b> :giá trị trung bình của các tiêu chí theo lớp học phần</li>
    <li> <b>STD</b> : độ lệch chuẩn các tiêu chí theo lớp học phần</li>
  </ol>
</div>
@endsection
