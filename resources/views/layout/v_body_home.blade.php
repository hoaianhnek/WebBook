@extends('layout.v_master')
@section('body_home')
@if(session('notcart'))
    <section class="alert alert-warning text-center">{{session('notcart')}}</section>
@endif
@if(session('addCart'))
    <section class="alert alert-success text-center">{{session('addCart')}}</section>
@endif
<!-- Slide tren-->
<section class="section-1 container-fluid">
    <div class="col-md-12">
        <div id="img" class="carousel slide" data-ride="carousel">
            <!--thứ tự hình-->
            <ul class="carousel-indicators" id="carousel">
                <li data-target="#img" data-slide-to="0" class="active"></li>
                <li data-target="#img" data-slide-to="1"></li>
                <li data-target="#img" data-slide-to="2"></li>
            </ul>
            <!--slide-->
            <div class="carousel-inner">
                <div class="carousel-item active w-100" >
                    <img src="../image/slider_1.jpg" alt="wallpaper" >
                </div>
                <div class="carousel-item ">
                    <img src="../image/slider_2.jpg" alt="wallpaper" >
                </div>
                <div class="carousel-item">
                    <img src="../image/wallpaper4.jpg" alt="wallpaper" >
                </div>
            </div>
            <!--left and right controls-->
            <a class="carousel-control-prev" href="#img" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#img" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div><!-- het slidetren -->
    </div>
</section>
<!-- <section class="section-2 container-fluid p-0">
    <div class="cover">
        <div class="content text-center">
            <h1>FLASH SALE</h1>
        </div>
    </div>
</section> -->

<section class="sachvanhoc mb-5 mb-3 mt-5">
    <div class="section_book section_base sachgiamgia">
        <div class="container">
            <div class="row row-noGutter-2 mb-5">
                <div class="col-lg-12 title_top_menu_index">
                    <div class="heading1">
                        <h2 class="title_head">
                            <a href="#">SÁCH KHUYẾN MÃI HOT</a>
                            <span class="sach"></span>
                        </h2>
                    </div>
                    <hr class="stars">
                </div>
            </div>
            <div class="row">
                <div class="book-content">
                @if($arrBookDiscount != null)
                    @foreach($arrBookDiscount as $Book)
                    <div class="col-md-3">
                        <div class="background-book-sell ml-2" data-toggle="collapse">
                            <div class="overlay">
                                <div class="text"><a href="cart-add-{{$Book->id_Book}}"><i class="fas fa-shopping-cart"></i></a></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="book-sell-img">
                                    <a href="master-{{$Book->id_Book}}" class="book-sell-top">
                                        <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}" height="170px">
                                        <div class="discount">-{{$Book->number_Discount}}%</div>
                                    </a>
                                </div>
                                <div class="book-sell-content">
                                    <a href="#" class="text-decoration-none">{{$Book->name_Book}}</a>
                                    <p>{{$Book->author_Book}}</p>
                                </div>
                            </div>
                            <div class="chitiet">{{$Book->describe_Book}}</div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <div class="price-entry">{{$Book->price_Book}}đ</div>
                                <div class="price-present">{{$Book->price_Book-$Book->price_Book*$Book->number_Discount/100}}đ</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
<section class="sachvanhoc mb-5 mb-3 mt-5">
    <div class="section_book section_base">
        <div class="container">
            <div class="row row-noGutter-2 mb-5">
                <div class="col-lg-12 title_top_menu_index">
                    <div class="heading1">
                        <h2 class="title_head">
                            <a href="master-VH">SÁCH VĂN HỌC</a>
                            <span class="sach"></span>
                        </h2>
                    </div>
                    <hr class="stars">
                    <div class="hidden-xs">
                        <a class="xemthem_tab btn_xemthem" href="master-VH">Xem Thêm</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="book-content">
                    @foreach($arrLiterary as $Book)
                    <div class="col-md-3">
                        <div class="background-book-sell ml-2" data-toggle="collapse">
                            <div class="overlay">
                                <div class="text"><a href="login"><i class="fas fa-shopping-cart"></i></a></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="book-sell-img">
                                    <a href="master-{{$Book->id_Book}}" class="book-sell-top">
                                        <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}" height="170px">
                                        <div class="discount">-{{$Book->number_Discount}}%</div>
                                    </a>
                                </div>
                                <div class="book-sell-content">
                                    <a href="#" class="text-decoration-none">{{$Book->name_Book}}</a>
                                    <p>{{$Book->author_Book}}</p>
                                </div>
                            </div>
                            <div class="chitiet">{{$Book->describe_Book}}</div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <div class="price-entry">{{$Book->price_Book}}đ</div>
                                <div class="price-present">{{$Book->price_Book-$Book->price_Book*$Book->number_Discount/100}}đ</div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<section class="sachvanhoc mb-5 mb-3 mt-5">
    <div class="section_book section_base">
        <div class="container">
            <div class="row row-noGutter-2 mb-5">
                <div class="col-lg-12 title_top_menu_index">
                    <div class="heading1">
                        <h2 class="title_head">
                            <a href="master-TT">SÁCH TIỂU THUYẾT</a>
                            <span class="sach"></span>
                        </h2>
                    </div>
                    <hr class="stars">
                    <div class="hidden-xs">
                        <a class="xemthem_tab btn_xemthem" href="master-TT">Xem Thêm</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="book-content">
                    @foreach($arrNovel as $Book)
                    <div class="col-md-3">
                        <div class="background-book-sell ml-2" data-toggle="collapse">
                            <div class="overlay">
                                <div class="text"><a href="login"><i class="fas fa-shopping-cart"></i></a></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="book-sell-img">
                                    <a href="master-{{$Book->id_Book}}" class="book-sell-top">
                                        <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}" height="170px">
                                        <div class="discount">-{{$Book->number_Discount}}%</div>
                                    </a>
                                </div>
                                <div class="book-sell-content">
                                    <a href="#" class="text-decoration-none">{{$Book->name_Book}}</a>
                                    <p>{{$Book->author_Book}}</p>
                                </div>
                            </div>
                            <div class="chitiet">{{$Book->describe_Book}}</div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <div class="price-entry">{{$Book->price_Book}}đ</div>
                                <div class="price-present">{{$Book->price_Book-$Book->price_Book*$Book->number_Discount/100}}đ</div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

@stop
