@extends('index')

@section('content')
<div class="row">
  <div class="col-md-9">
    <h1 class="title">
      Danh sách khảo sát
      <a href="{{asset('admin/khao-sat/create')}}" target="_blank"><button class="btn btn-success"  > <i class="fa fa-plus"></i></button></a>
    </h1>
  </div>

</div>

<div class="row">

<table class="table">
  <thead>

    <th>STT</th>
    <th>Tiêu đề</th>
    <th>Ngày tạo</th>
    <th>Sửa lần cuối</th>
    <th>Mậc định</th>
    <th>Hành động</th>
  </thead>
  <tbody>
    @foreach($surveys as $index => $survey)
    <tr>

      <td>{{$index+1}}</td>
      <td>{{$survey['name']}}</td>
      <td>{{$survey['created_at']}}</td>
      <td>{{$survey['updated_at']}}</td>
      <td>
        @if($survey['default'])
          <button class="btn btn-success" name="button"> <i class="fa fa-check"></i></button>
        @else
          <button class="btn btn-danger" name="button"> <i class="fa fa-times"></i> </button>
        @endif
      </td>
      <td>
        <div class="btn-group" >
          {{-- Edit button --}}
          <a href="{{asset('admin/khao-sat/'.$survey['id']."/edit")}}" target="_blank">
            <button type="button" class="btn btn-info"  >
               <i class="fa fa-edit"></i>
            </button>
          </a>


            {{-- Show button --}}
            <a href="{{asset('admin/khao-sat/'.$survey['id'])}}" target="_blank">
              <button type="submit" class="btn btn-success" >
                 <i class="fa fa-eye"></i>
              </button>
            </a>

            {{--  --}}

            {{-- Delete button --}}
            <form  method="post" action="{{ url('/admin/khao-sat/'.$survey['id']) }}" >
              @csrf
              {!! method_field('delete') !!}
              <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa mục này ?')" > <i class="fa fa-trash"></i> </button>
            </form>
            {{--  --}}

        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
<div class="row">
    <div class="col-md-2 col-md-offset-5" style="margin:0px auto;">{{$surveys->links()}}</div>
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
</script>


@endsection
