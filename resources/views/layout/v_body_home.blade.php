@extends('layout.v_master')
@section('body_home')

<!-- Slide tren-->
<div class="body container-fluid">
    <div id="img" class="carousel slide" data-ride="carousel">
        <!--thứ tự hình-->
        <ul class="carousel-indicators" id="carousel">
            <li data-target="#img" data-slide-to="0" class="active"></li>
            <li data-target="#img" data-slide-to="1"></li>
            <li data-target="#img" data-slide-to="2"></li>
            <li data-target="#img" data-slide-to="3"></li>
        </ul>
        <!--slide-->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../image/wallpaper1.jpg" alt="wallpaper" >
            </div> 
            <div class="carousel-item ">
                <img src="../image/wallpaper2.jpg" alt="wallpaper" >
            </div>
            <div class="carousel-item">
                <img src="../image/wallpaper4.jpg" alt="wallpaper" >
            </div>
            <div class="carousel-item">
                <img src="../image/walpaper4.jpg" alt="wallpaper" >
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

     <div class="book-sell">
        <div class="d-flex justify-content-between">SÁCH KHUYẾN MÃI HOT</div>
        <hr>
        <div class="row">
            <div class="book-content">
            @foreach($arrBookDiscount as $Book)
                <div class="col-3">
                    <div class="background-book-sell" data-toggle="collapse">
                        <div class="overlay">
                            <div class="text"><a href=""><i class="fas fa-shopping-cart"></i></a></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="book-sell-img">
                                <a href="master-{{$Book->id_Book}}" class="book-sell-top">
                                    <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}">
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
                            <div class="price-entry">{{$Book->price_Book}}</div>
                            <div class="price-present">56.000đ</div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        {{$arrBookDiscount->links()}}
    </div>
</div>
        <!-- sách bán chạy -->
<div class="book-new">
    <div class="d-flex justify-content-between">SÁCH BÁN CHẠY</div>
    <hr>
    <div class="row">
        <div class="book-content">
        @foreach($arrBookBetseller as $Book)
        <div class="col-3">
            <div class="background-book-sell" data-toggle="collapse">
                <div class="overlay">
                    <div class="text"><a href=""><i class="fas fa-shopping-cart"></i></a></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="book-sell-img">
                        <a href="master-{{$Book->id_Book}}" class="book-sell-top">
                            <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}">
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
                    <div class="price-entry">{{$Book->price_Book}}</div>
                    <div class="price-present">56.000đ</div>
                </div>
            </div>
        </div>  
        @endforeach
        </div> 
    </div>
    {{$arrBookBetseller->links()}}
</div>
@stop