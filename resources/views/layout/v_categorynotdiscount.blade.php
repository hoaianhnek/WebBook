@extends('layout.v_master')
@section('body_categorynotdiscount')

    <div class="container-category">
        <div>Sản phẩm theo thể loại</div>
        <hr>
        <div class="row p-4">
            @foreach($arrBookType as $Book)
            <div class="col-3">
                <div class="text-center container-category-content">
                    <div class="container-category-img p-4">
                        <a href="master-{{$Book->id_Book}}">
                            <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}">
                        </a>
                    </div>
                    <div class="text-centers">
                        <a href="master-{{$Book->id_Book}}" class="text-body text-decoration-none">{{$Book->name_Book}}</a>
                        <div class="container-category-price-entry-notdiscount">{{$Book->price_Book}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@stop