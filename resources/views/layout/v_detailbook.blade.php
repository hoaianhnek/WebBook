@extends('layout.v_master')
@section('body_detailbook')

<div class="container-fluid">
    @foreach($arrBooks as $Book)
    <div class="container-product d-flex">
        <div class="row">
            <div class="col-6">
                <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}">
            </div>
            <div class="col-6">
                <div class="container-product-content">
                    <h4>{{$Book->name_Book}}</h4>
                    <br>
                    <form action = "{{URL::to('bookstore/showcart')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="d-flex">
                            <span class="container-product-content-price-entry">{{$Book->price_Book}}đ</span>
                            <input class="text-danger pricediscount" name ="pricediscount" type="text" value="{{($Book->price_Book - ($Book->price_Book * ($Book->number_Discount)/100))}}"><label class="text-danger dpricediscount">đ</label>
                            <span class="ml-3 container-product-content-discount">-{{$Book->number_Discount}}%</span>
                        </div>
                        <hr>
                   
                        <div">
                            <span class="pr-4">Số Lượng</span>
                            <input type="number" name="quantity" min="1" max="100" value="1" class="ml-3">
                        </div>
                        <div class="mt-4">
                            <span class="pr-4">Vận chuyển</span>
                            <span>Theo phương châm <strong>siêu nhanh, siêu rẻ</strong></span>
                        </div>
                        <input type="submit" value="Mua Ngay" class="container-product-content-cart mr-4">
                        <input type="hidden" name = "bookid_hidden" value="{{$Book->id_Book}}">
                    </form>
                    <input type="submit" name = "addcart" value="Thêm Vào Giỏ Hàng" class="container-product-content-add-cart">
                    
                    <div class="container-product-content-warning">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Bạn hãy chọn địa chỉ nhận hàng để được dự báo 
                              thời gian giao hàng một cách chính xác nhất.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-detail">
        <span class="font-weight-bold">CHI TIẾT SẢN PHẨM</span>
        <table class="mt-4 mb-5 ml-1">
            <tr>
                <th>Mã sách</th>
                <td>{{$Book->id_Book}}</th>
            </tr>
            <tr>
                <th>Tên sách</th>
                <td>{{$Book->name_Book}}</th>
            </tr>
            <tr>
                <th>Tên nhà cung cấp</th>
                <td>{{$Book->supplier_Book}}</th>
            </tr>
            <tr>
                <th>Tác giả</th>
                <td>{{$Book->author_Book}}</th>
            </tr>
            <tr>
                <th>NXB</th>
                <td>{{$Book->publishing_Book}}</th>
            </tr>
        </table>
    </div>
    <div class="container-detail-content">
        <span class="font-weight-bold">NỘI DUNG SẢN PHẨM</span>
        <hr>
        <p class="text-justify pt-2 pl-1">
             {{$Book->describe_Book}}
        </p>
    </div>
    @endforeach
    <div class="container-kind-same">
        <div class="d-flex justify-content-between">
            <span class="font-weight-bold">SÁCH PHẨM CÙNG THỂ LOẠI</span>
        </div>
        <hr>
        <div class="row p-4">
            @foreach($arrBookTypeDis as $Book)
            <div class="col-3">
                <div class="text-center container-kind-same-content">
                    <div class="container-kind-same-img p-4">
                        <a href="master-{{$Book->id_Book}}" class="container-kind-same-top">
                            <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}">
                            <div class="container-kind-same-discount">-{{$Book->number_Discount}}%</div>
                        </a>
                    </div>
                    <div class="text-centers">
                        <a href="#" class="text-body text-decoration-none">{{$Book->name_Book}}</a>
                        <div class="container-kind-same-price-entry">{{$Book->price_Book}}</div>
                        <span class="container-kind-same-price-present">{{$Book->price_Book - ($Book->price_Book * ($Book->number_Discount)/100)}}đ</span>
                    </div>
                </div>
            </div>
            @endforeach
    	</div> 
        {{ $arrBookTypeDis->links()}}    
    </div>
</div>
@stop