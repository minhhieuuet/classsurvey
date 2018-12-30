@extends('index')

@section('content')
<div class="row">
  <div class="col-md-9">
    <h1 class="title">
      Danh sách giảng viên
      <button class="btn btn-success" data-toggle="modal" data-target="#insertModal" > <i class="fa fa-plus"></i> </button>
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

  {{-- Excel input --}}
  <div class="col-md-4 bounce" id="excel-input">
    <form method="POST" action="{{route('importTeachers')}}" enctype="multipart/form-data">
      @csrf
      <label for="excel-file">Nhập file định dạng excel:</label>
      <input id="excel-file" type="file" class="form-control" name="teachers" accept=".xlsx" style="width:70%;float:left;">
      <button type="submit" class="btn btn-success" style="float:left;"> <i class="fa fa-check"></i> </button>
    </form>
  </div>
</div>


<table class="table">
  <thead>

    <th>STT</th>
    <th>Tên đăng nhập</th>
    <th>Họ và tên</th>
    <th>VNU email</th>
    <th>Hành động</th>
  </thead>
  <tbody>
    @foreach($accounts as $key => $account)
    <tr>

      <td>{{$key+1}}</td>
      <td>{{$account['username']}}</td>
      <td>{{$account['full_name']}}</td>
      <td>{{$account['vnu_mail']}}</td>
      <td>
        <div class="btn-group" account_id={{$account['id']}} account_info="{{$account}}">
          {{-- Edit button --}}
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal" onclick="setValueEditForm(this)" >
               <i class="fa fa-edit"></i>
              </button>

            {{-- Show button --}}
            <button type="submit" class="btn btn-success" onclick = "showTeacherInfo(this);"> <i class="fa fa-eye"></i> </button>

            {{--  --}}

            {{-- Delete button --}}
            <form  method="post" action="{{ url('/admin/giang-vien/'.$account->id) }}" >
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
    <div class="col-md-2 col-md-offset-5" style="margin:0px auto;">{{$accounts->links()}}</div>
</div>
<!-- The Edit Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Sửa tài khoản giảng viên</h4>

      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="formEdit" class="form-group" action="{{url('admin/giang-vien')}}" method="post" >
          @csrf
            {!! method_field('put') !!}
          <div class="form-group">
            <label >Tên đăng nhập</label>
            <input type="text" class="form-control" name="username" placeholder="Nhập tài khoản" required value="">
          </div>
          <div class="form-group">
            <label for="">Mật khẩu (Để trống nếu không đổi mật khẩu)</label>
            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu"  value="">
          </div>
          <div class="form-group">
            <label for="">Nhập lại mật khẩu (Để trống nếu không đổi mật khẩu) </label>
            <input type="password" class="form-control"  name="re_password" id="passwordedit" placeholder="Nhập lại mật khẩu"  value="">
          </div>
          <div class="form-group">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control"  name="full_name" placeholder="Nhập họ và tên" required value="">
          </div>
          <div class="form-group">
            <label for="#username">VNU email</label>
            <input type="email" class="form-control" name="vnu_mail" placeholder="Nhập VNU email" required value="">
          </div>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Sửa</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
        </form>
      </div>

    </div>
  </div>
</div>


{{-- End modal  --}}

<!-- The Insert Modal -->
<div class="modal" id="insertModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Thêm tài khoản giảng viên</h4>

      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="formInsert" class="form-group" action="{{url('admin/giang-vien')}}" method="post" >
          @csrf

          <div class="form-group">
            <label >Tên đăng nhập</label>
            <input type="text" class="form-control" name="username" id="teacher_account" placeholder="Nhập tài khoản" required value="">
            <p style="color:red;display:none;" id="username-error" > <i class="fas fa-exclamation-triangle"></i> Tên đăng nhập đã tồn tại</p>
          </div>
          <div class="form-group">
            <label for="">Mật khẩu</label>
            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" id="password" required value="">
          </div>
          <div class="form-group">
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" class="form-control"  name="re_password" placeholder="Nhập lại mật khẩu" required value="">
          </div>
          <div class="form-group">
            <label for="">Họ và tên</label>
            <input type="text" class="form-control"  name="full_name" placeholder="Nhập họ và tên" required value="">
          </div>
          <div class="form-group">
            <label for="#username">VNU email</label>
            <input type="email" class="form-control" name="vnu_mail" placeholder="Nhập VNU email" required value="">
          </div>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Thêm</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
        </form>
      </div>

    </div>
  </div>
</div>


{{-- End modal  --}}

{{-- Script --}}

{{-- Validate form --}}
<script type="text/javascript">
  $(document).ready(function(){

    $('#formInsert').validate({
      rules:{
        username:{
          required:true,
          minlength:4,
          maxlength:30
        },
        password:{
          required:true,
          minlength:8
        },
        re_password:{
          required:true,
          minlength:8,
          equalTo:'#password'
        },
        full_name:{
          required:true,
        },
        vnu_mail:{
          required:true,
          email:true
        }
      },
      messages:{
        username:{
          required:"Bạn chưa nhập tài khoản",
          minlength:"Tài khoản quá ngắn",
          maxlength:"Tài khoản quá dài"
        },
        password:{
          required:"Bạn chưa nhập mật khẩu",
          minlength:"Mật khẩu phải có ít nhất 8 kí tự"
        },
        re_password:{
          required:"Bạn chưa nhập lại mật khẩu",
          equalTo:"Mật khẩu không khớp"
        },
        full_name:{
          required:"Bạn chưa nhập họ và tên",
        },
        vnu_mail:{
          required:"Bạn chưa nhập email",
          email:"Email chưa đúng định dạng"
        }
      }
    })

    $('#formEdit').validate({
      rules:{
        username:{
          required:true,
          minlength:4,
          maxlength:30
        },
        password:{
        },
        re_password:{
          equalTo:'#passwordedit'
        },
        full_name:{
          required:true,
        },
        vnu_mail:{
          required:true,
          email:true
        }
      },
      messages:{
        username:{
          required:"Bạn chưa nhập tài khoản",
          minlength:"Tài khoản quá ngắn",
          maxlength:"Tài khoản quá dài"
        },
        re_password:{

          equalTo:"Mật khẩu không khớp"
        },
        full_name:{
          required:"Bạn chưa nhập họ và tên",
        },
        vnu_mail:{
          required:"Bạn chưa nhập email",
          email:"Email chưa đúng định dạng"
        }
      }
    })


  });


</script>
<script type="text/javascript">
$(document).ready(function(){
  //Check existing teacher account
  $('#teacher_account').change(function(){
    $('#username-error').hide();
      $.get("/api/check/"+$('#teacher_account').val(),function(res){
        if(res == 'true'){
          $('#username-error').show();
          console.log("hihi");
        }else{
          $('#username-error').hide();
        }
      });
  });
})
// Set value edit form
function setValueEditForm(elem){
  let info = JSON.parse(elem.parentNode.getAttribute('account_info'));
  $('#formEdit').attr('action',window.location.origin + '/admin/giang-vien/'+info.id);
  $('#formEdit input[name = username]').val(info.username);
  $('#formEdit input[name = full_name]').val(info.full_name);
  $('#formEdit input[name = vnu_mail]').val(info.vnu_mail);
}
// Show teacher info
function showTeacherInfo(elem){
  let info = JSON.parse(elem.parentNode.getAttribute('account_info'));
  swal({
    title:"Thông tin giảng viên",
    confirmButtonText:'Thoát',
    html:
      `
        <table class="table" style="text-align:left;">
          <tr>
            <th>Tên đầy đủ  </th>
            <td>${info.full_name}</td>
          </tr>
          <tr>
            <th>Tên đăng nhập  </th>
            <td>${info.username}</td>
          </tr>
          <tr>
            <th>VNU mail  </th>
            <td>${info.vnu_mail}</td>
          </tr>


        </table>
      `
  })
}
</script>
{{-- Alert  session --}}
<script type="text/javascript">

@if (\Session::has('success'))
    swal({
      title:"Nhập dữ liệu thành công",
      type:"success",
      button:false,
      timer:1500
    });
@endif
// Error handle upload file
@if(session('error'))

    swal({
      title:"Đã có lỗi xảy ra",
      type:"error",
      text:"File không đúng định dạng"
    })

@endif

// Alert successful delete file
@if(session('del-success'))
  swal({
    title:"Xóa thành công",
    type:"success",
    button:false,
    timer:1000
  })
@endif

// Alert create success
@if(session('create-success'))
swal({
  title:"Thêm thành công",
  type:"success",
  button:false,
  timer:1000
})
@endif
// if error validate
@if($errors->any())
swal({
  title:"Lỗi",
  type:"error",
  html:`
    <ul>
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
    </ul>
  `,
  button:false,
  timer:2000
})
@endif
</script>

{{--  --}}

@endsection
