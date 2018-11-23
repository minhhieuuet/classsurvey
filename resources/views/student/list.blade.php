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
    <th>Khảo sát</th>

  </thead>
  <tbody>
  @foreach($students as $index =>  $student )
    <tr>
    @if(isset($_GET['page']))
      <td>{{($_GET['page']-1)*20+$index+1}}</td>
    @else
      <td>{{$index+1}}</td>
    @endif
      <td>{{$student['student_code']}}</td>
      <td>{{$student['name']}}</td>
      <td>{{$student['school_year']}}</td>
      <td>
      <ul>
      @foreach( $student->courses as $course )
        <li>{{$course['name']}}</li>
      @endforeach
    </ul>
      </td>
      {{-- <td>
      @if($student->account)
        {{$student->account['username']}}
      @else
        <button class="btn btn-success" type="button" >Tạo tài khoản</button>
      @endif
      </td>
      <td></td> --}}
    </tr>
  @endforeach
  </tbody>
</table>

<div class="row">
    <div class="col-md-2 col-md-offset-5" style="margin:0px auto;">{{$students->links()}}</div>
</div>

<script type="text/javascript">
// Alert successful delete
@if(session('del-success'))
  swal({
    title:"Xóa thành công",
    type:"success",
    button:false,
    timer:1000
  })
@endif

function loading(){
  swal({
    title:"Vui lòng đợi",
    imageUrl: 'https://mbtskoudsalg.com/images/loading-gif-png-5.gif',
    imageWidth: 150,
    imageHeight: 150,
    text:"Dữ liệu đang được xử lý",
    showConfirmButton:false
  })
}
</script>


@endsection
