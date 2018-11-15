<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <link rel="icon" href="{{asset('icon.png')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.5/sweetalert2.all.min.js"></script>
  </head>
  <body>

{{-- Session error --}}
@if(session('error'))
<script type="text/javascript">
  swal({
    title:"Đăng nhập thất bại",
    type:"error",
    text:"Tài khoản hoặc mật khẩu không đúng",
    timer:"1500",
    showCancelButton: false,
    showConfirmButton: false

  })
</script>
@endif
{{-- End session --}}
    <body id="LoginForm">
<div class="container">

<h1 class="form-heading">Hệ thống Class Survey</h1>
<div class="login-form">
<div class="main-div">
  <div class="panel">
 <h1>Đăng nhập   <img src="{{asset('icon.png')}}" width="40px" height="50px"></h1>

 <p>Vui lòng nhập tài khoản và mật khẩu</p>
 <br>
 </div>
  <form method="POST" action="{{route('login')}}" id="Login">
      @csrf
      <div class="form-group">


          <input type="text" class="form-control" name="username" value="admin" id="inputEmail" required placeholder="Nhập tài khoản">

      </div>

      <div class="form-group">

          <input type="password" class="form-control" name="password" value="123456" id="inputPassword" required placeholder="Nhập mật khẩu">

      </div>
      <div class="forgot">

</div>
      <button type="submit" class="btn btn-primary">Đăng nhập</button>

  </form>
  </div>

</div></div></div>


</body>
  </body>
</html>
