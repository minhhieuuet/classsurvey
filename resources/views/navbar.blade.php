<nav class="navbar navbar-expand-lg navbar-light bg-light">
  {{-- <a class="navbar-brand" href="#">Class Serveys</a> --}}
  <h3> <a href="{{url('admin')}}"><img src="{{asset('icon.png')}}" width="50px" alt=""> </a> Class Survey</h3>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('admin')}}"> Trang chủ <span class="sr-only">(current)</span></a>
      </li>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
    </form>
    <div style="margin-left:10px;">
      <a href="{{asset('logout')}}" style="color:red;"> <i class="fas fa-power-off"></i> </a>
    </div>
  </div>
</nav>
