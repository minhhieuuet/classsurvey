@extends('StudentLayout.master')
@section('content')
  <style media="screen">
    form{
      width:50%;
      margin:0px auto;
    }
    .title{
      text-align: center;
    }
    .btn-success{
      width:100%;
    }
    ul.alert{
        width:50%;
        list-style-type:none;
        margin:0px auto;
    }
  </style>

  <h2 class="title"> Đổi mật khẩu </h2>
  <form id="form"  action="{{route('changePass')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="">Mật khẩu hiện tại</label>
      <input type="password" class="form-control" name="oldPass" placeholder="Nhập mật khẩu hiện tại của bạn" value="">
    </div>
    <div class="form-group">
      <label for="">Mật khẩu mới</label>
      <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới" name="newPass" value="">
    </div>
    <div class="form-group">
      <label for="">Nhập lại mật khẩu</label>
      <input type="password" class="form-control" name="confirmNewPass" placeholder="Nhập lại mật khẩu" value="">
    </div>
    <input type="submit" class="btn btn-success" name="" value="Đổi mật khẩu">
  </form>
  @if($errors->any())
  <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
      <li >{{$error}}</li>
    @endforeach
  </ul>
  @endif
  @if(session('error'))
    <script type="text/javascript">
      swal({
        title:"Lỗi",
        type:"error",
        text:"Mật khẩu hiện tại không đúng",
        timer:"1500"
      })
    </script>
  @endif
  @if(session('success'))
    <script type="text/javascript">
      swal({
        title:"Thành công",
        type:"success",
        text:"Mật khẩu đã được thay đổi",
        timer:"1500"
      })
    </script>
  @endif
  <script type="text/javascript">
  $(document).ready(function(){
    $('#form').validate({
      rules:{
        oldPass:{
          required:true
        },
        newPass:{
          required:true,
          minlength:8
        },
        confirmNewPass:{
          required:true,
          equalTo:'#password'
        }
      },
      messages:{
        oldPass:{
          required:"Bạn cần nhập mật khẩu hiện tại"
        },
        newPass:{
          required:"Bạn cần nhập mật khẩu mới",
          minlength:"Mật khẩu mới phải có ít nhất 8 kí tự"
        },
        confirmNewPass:{
          required:"Bạn cần nhập lại mật khẩu",
          equalTo:"Mật khẩu không khớp"
        }
      }
    });
  });
  </script>
@endsection
