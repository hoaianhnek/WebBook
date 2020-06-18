<!DOCTYPE html>
<head>
<title>Admin bookstore</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- bootstrap-css -->
<link rel="stylesheet" href="../../public/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="../../public/css/style.css" rel='stylesheet' type='text/css' />
<link href="../../public/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<!-- //font-awesome icons -->
<script src="../../public/js/jquery2.0.3.min.js"></script>
<script src="../../public/js/raphael-min.js"></script>
<script src="../../public/js/morris.js"></script>
</head>
<body>	

<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="dashboard" class="logo">
            Admin
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <!-- <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li> -->
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="../../public/image/2.png">
                    <span class="username">Ánh</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a href="logout"><i class="fa fa-key"></i> Đăng xuất </a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
    </header>
    <!--header end-->
<!--sidebar start-->
<aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="dashboard">
                            <i class="fa fa-dashboard"></i>
                            <span>Tổng quan</span>
                        </a>
                    </li>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li>
                        <a href="{{URL::to('admin/category-view')}}">
                            <i class="fa fa-bookmark"></i>
                            <span>Danh sách thể loại</span>
                        </a>                            
                    </li>
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Sách</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('admin/book-view')}}">Danh sách sách</a></li>
                            <li><a href="{{URL::to('admin/add-book')}}">Thêm sách</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-user"></i>
                            <span>Khách Hàng</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('admin/customer-view')}}">Danh sách khách hàng</a></li>
                            <li><a href="{{URL::to('admin/customer-view-add')}}">Thêm khách hàng</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li>
                        <a href="ship-view">  
                            <i class="fa fa-ship"></i>
                            <span>Phí Ship </span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-eye"></i>
                            <span>Khuyến mãi</span>
                        </a>
                        <ul class="sub">
                            <li><a href="discount-view">Danh sách khuyến mãi</a></li>
                            <li><a href="discount-add-view">Thêm khuyến mãi</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->role == 1)
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class=" fa fa-user"></i>
                            <span>Quản lý nhân viên</span>
                        </a>
                        <ul class="sub">
                            <li><a href="employ-show">Danh sách nhân viên</a></li>
                            <li><a href="show-employ-add">Thêm nhân viên</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <li class="sub-menu">
                        <a href="order-view">
                            <i class=" fa fa-first-order"></i>
                            <span>Quản lý hóa đơn</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 1)
                    <li class="sub-menu">
                        <a href="report-month">
                            <i class="fa fa-glass"></i>
                            <span>Báo cáo doanh thu</span>
                        </a>
                    </li>
                    @endif
                </ul>            </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
<!--main content start-->

@yield('book_show')
@yield('book_add')
@yield('book_edit')
@yield('category_show')
@yield('category_edit')
@yield('customer_show')
@yield('customer_add')
@yield('customer_edit')
@yield('ship_show')
@yield('shipping_edit')
@yield('discount_show')
@yield('discount_add')
@yield('discount_edit')
@yield('order_show')
@yield('order')
@yield('body_report')
@yield('employ_show')
@yield('employ_add')
@yield('employ_edit')
    <!-- footer -->
  	<div class="footer">
    	<div class="wthree-copyright">
      		<p>© Vesion New</p>
    	</div>
  	</div>
    <!-- / footer -->
                          
<!--main content end-->
<script src="../../public/js/bootstrap.js"></script>
<script src="../../public/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../../public/js/scripts.js"></script>
<script src="../../public/js/jquery.slimscroll.js"></script>
<script src="../../public/js/jquery.nicescroll.js"></script>
<script src="../../public/js/jquery.scrollTo.js"></script>
              
</body>
</html>