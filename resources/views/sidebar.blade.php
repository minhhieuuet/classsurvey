<!--nav sidebar -->
<aside id="sidebar" >
  <nav class="navbar navbar-inverse sidebar navbar-fixed-top" role="navigation">
      <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="nav-side-menu">
    <div class="brand">
      <h2>Class Survey</h2>
      <button type="button" class="btn btn-danger times" > <i class="fa fa-times"></i> </button>
    </div>

    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="{{asset('admin')}}">
                  <i class="fa fa-dashboard fa-lg"></i> Trang chủ
                  </a>
                </li>



                <li data-toggle="collapse" data-target="#student" class="collapsed">
                  <a href="#"><i class="far fa-address-card"></i>Tài khoản sinh viên <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="student">

                  <li><a href="{{asset('admin/sinh-vien')}}">Danh sách tài khoản</a></li>
                  <li><a href="{{asset('admin/sinh-vien/danh-sach')}}">Danh sách sinh viên</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#teacher" class="collapsed">
                  <a href="#"><i class="fas fa-chalkboard-teacher"></i> Tài khoản giảng viên <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="teacher">

                  <li><a href="{{asset('admin/giang-vien')}}">Danh sách tài khoản</a></li>


                </ul>

                <li data-toggle="collapse" data-target="#survey" class="collapsed">
                  <a href="#"><i class="fas fa-clipboard-list"></i> Phiếu khảo sát <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="survey">

                  <li> <a href="{{asset('admin/khao-sat')}}"> Danh sách phiếu khảo sát </a></li>

                </ul>

                <li data-toggle="collapse" data-target="#class" class="collapsed">
                  <a href="#"><i class="fas fa-calendar-alt"></i> Cuộc khảo sát <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="class">

                  <li> <a href="{{asset('admin/mon-hoc')}}"> Danh sách cuộc khảo sát</a></li>
                  <li> <a href="{{asset('admin/khao-sat/thong-ke')}}"> Kết quả khảo sát</a></li>
                </ul>


                <li>
                  <a href="#"><i class="fab fa-slack"></i> Nhật kí </a>
                </li>

            </ul>
     </div>
</div>
  </nav>

</aside>
<script type="text/javascript">
    $('document').ready(function(){
        $(".nav-side-menu").animate({width:'toggle'},0);
    })
    $('.times').click(function(){
        $(".nav-side-menu").animate({width:'toggle'},150);
        $('#bars').show();
    });

    $('#bars').click(function(){
      $(".nav-side-menu").animate({width:'toggle'},150);
      $('#bars').hide();
    });

</script>
