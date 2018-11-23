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
                  <a href="{{asset('giang-vien')}}">
                  <i class="fa fa-dashboard fa-lg"></i> Trang chủ
                  </a>
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
