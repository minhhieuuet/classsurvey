@extends('index')

@section('content')
<div class="row">
  <div class="col-md-9">
    <h1 class="title">
      Danh sách cuộc khảo sát

    </h1>
  </div>
  <div class="col-md-3">
    <button type="button" class="btn btn-success" id="excel-import">
      <i class="far fa-file-excel" ></i>
      Nhập từ excel
    </button>

  </div>
</div>
<div class="row">
  <div class="col-md-8">

  </div>
  <div class="col-md-4 bounce" id="excel-input">
    <form method="POST" action="{{route('importCourse')}}" enctype="multipart/form-data" >
      @csrf
      <label for="excel-file">Nhập file định dạng excel:</label>
        <input id="excel-file" type="file" class="form-control" accept=".xlsx" name="file" style="width:70%;float:left;">
        <button type="submit" class="btn btn-success" style="float:left;" onclick="loading()"> <i class="fa fa-check"></i> </button>
    </form>
  </div>
</div>

<table class="table">
  <thead>

    <th>STT</th>
    <th>Mã lớp</th>
    <th>Tên lớp</th>
    <th>Giảng viên</th>
    <th>Số sinh viên</th>
    <th>Khảo sát</th>
    <th>Hành động</th>
  </thead>
  <tbody>
  @if(sizeof($courses)==0)

  @endif
  @foreach($courses as $index => $course)
    <tr>

      <td>{{$index+1}}</td>
      <td>{{$course['code']}}</td>
      <td>{{$course['name']}}</td>
      <td>
        <?php $teacher_name = \App\TeacherAccount::where('full_name','like','%'.$course['teacher_name'].'%')->first()['full_name']; ?>
        @if(!$teacher_name)
          {{$course['teacher_name']}}
        @else
          <a href="{{asset('admin/giang-vien/'.\App\TeacherAccount::where('full_name','like','%'.$course['teacher_name'].'%')->first()['id'])}}" target="_blank">
            {{-- {{$course->teacher['full_name']} --}}
            {{trim($teacher_name, "\xC2\xA0") }}
          </a>
        @endif

      </td>
      <td>{{$course->students()->count()}}</td>
      <td><a href="{{asset('admin/khao-sat/'.$course->survey['id'].'/edit')}}" target="_blank">{{$course->survey['name']}}</a></td>
      <td>
        <div class="btn-group" >
          <a href="{{url('admin/khao-sat/thong-ke/'.$course['id'])}}" title="Xem thống kê">
            <button class="btn btn-warning ">
              <i class="fa fa-bar-chart"></i>
            </button>

          </a>
          {{-- Edit button --}}
          <a href="{{asset('admin/khao-sat/'.$course->survey['id'].'/edit')}}" title="Sửa" target="_blank">
            <button type="button" class="btn btn-info"  >
               <i class="fa fa-edit"></i>
            </button>
          </a>
            {{-- Delete button --}}
            <form  method="post" action="{{url('admin/mon-hoc/'.$course['id'])}}" >
              @csrf
              {!! method_field('delete') !!}
              <button type="submit" class="btn btn-danger" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa mục này ?')" > <i class="fa fa-trash"></i> </button>
            </form>
            {{--  --}}

        </div>
      </td>

    </tr>
@endforeach
  </tbody>
</table>
<div class="row">
    <div class="col-md-2 col-md-offset-5" style="margin:0px auto;"></div>
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
