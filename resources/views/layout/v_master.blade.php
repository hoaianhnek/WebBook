
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <title>BOOK STORE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <!-- AOS     library -->
   <!--  <script type="text/javascript" src="../../  public/js/aos.js"></script> -->

     <!-- AOS library -->
    <!-- <link rel="stylesheet" href="../../public/css/aos.css"> -->
    <!-- link css-->
    <link rel="stylesheet" type="text/css" href="../../public/css/icon-font.min.css">
     
    <link rel="stylesheet" type="text/css" href="../../public/css/login.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_home.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/header_login.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_category.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_detailbook.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_search.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/body_shopping.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../../public/css/header_connect.css">
    <script src="https://kit.fontawesome.com/6e4540c13e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header color-header"> 
        <div class="banner">
            <img class="banner_top" src="../image/bg_banner_top.png" alt="" width="100%">
        </div> 
        <div class="d-flex">
                    <!--logo-->
            <a href="master-home" class="logobookstore"><img src="../image/logo.png" alt="BOOK STORE" data-toggle="tooltip" title="Book Store"></a>
                <!--search-->
           <form class="form-inline" action="/action_page.php">
                <input class="form-control mr-sm-2" id="search-book" type="text" placeholder="Tìm kiếm tên sách">
                <span class="input-group-btn">
                    <button class="btn icon-fallback-text">
                        <span class="fa fa-search">
                        </span>
                    </button>   
                </span>
            </form>
            <div class="cart-menu">
                <a href="showcart"><img src="../image/giohang.gif" alt="Giỏ hàng" class="cart"></a>
            </div>
            @if(Auth::check())
            <a class="d-flex myself text-decoration-none" href="logout">
                <i class="fas fa-users myself-icon"></i>
                <span>Logout</span>
            </a>
            @else
            <div class="d-flex login-logout">
                <a href="login" class="border-right text-decoration-none">Đăng Nhập</a>
                <a href="login" class="text-decoration-none" onclick="displaySingupBox()">Đăng Ký</a>
            </div>
            @endif
        </div>
        <div class="d-flex justify-content-between color-menu">
            <div class="menu-dropdown dropdown">
                <button class="btnmenu" type="button" data-toggle="dropdown">
                    <i class="fas fa-bars"></i>
                    <span class="menu-book">DANH MỤC SÁCH</span>
                </button>
                <div class="menu-dropdown-content dropdown-menu">
                    <div class="link-dropdown">
                        @foreach($arrType as $type)
                        <a class="d-flex justify-content-between" id="category" href="master-{{$type->id_Category}}">
                            <div>{{$type->name_Category}}</div>
                            <i class="fas fa-angle-right"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex text-hotline">
                <div class="d-flex icon-hotline">
                    <i class="fas fa-phone"></i>
                    <span class="hotline">Hotline: 0376206101</span>
                </div>
            </div>
        </div>
    </div>
    <div id="body">

    @yield('body_home')
    @yield('test')


    @yield('body_categorydiscount')
    @yield('body_categorynotdiscount')
    @yield('body_detailbook')
    @yield('body_detailbooknotdis_nottype')
    @yield('body_detailbooknotdis')
    @yield('body_shopping')
    @yield('body_login')
    @yield('body_search')
    @yield('body_checkout')
    @yield('alart_success')
    </div>
    @include('layout.v_footer')
</body>
<script type="text/javascript">
    $("#search-book").on('keyup',function(){
        $search = $(this).val();
        $.ajax({
            type:'get',
            url:"{{URL::to('bookstore/searchAjax')}}",
            data:{'search':$search},
            dataType:"text",//dữ liệu trả về
            success:function(data){
                    $('#body').html(data); 
                }
        });
    });
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
</html>