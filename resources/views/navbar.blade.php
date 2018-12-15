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

    <div style="margin-left:10px;cursor:pointer;">
      <a  onclick="confirmSignOut(this.getAttribute('link'))" link="{{asset('logout')}}" style="color:red;"> <i class="fas fa-power-off"></i> </a>
    </div>
  </div>
</nav>
