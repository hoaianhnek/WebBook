 @extends('layout.v_master')
 @section('body_categorydiscount')

 <div class="container-category">
    <div>Sản phẩm theo thể loại</div>
    <hr>
    <div class="row p-4">
        @foreach($arrBookTypeDiscount as $Book)
        <div class="col-sm-3">
            <div class="text-center container-category-content">
                <div class="container-category-img p-4">
                    <a href="master-{{$Book->id_Book}}">
                        <img src="../image/{{$Book->image_Book}}" alt="{{$Book->name_Book}}" width="190px">
                        <div class="container-category-discount">-{{$Book->number_Discount}}%</div>
                    </a>
                </div>
                <div class="text-centers">
                    <a href="master-{{$Book->id_Book}}" class="text-body text-decoration-none">{{$Book->name_Book}}</a>
                    <div class="container-category-price-entry">{{$Book->price_Book}}đ</div>
                    <span class="container-category-price-present">{{$Book->price_Book - ($Book->price_Book * ($Book->number_Discount)/100)}}đ</span>
                </div>
            </div>
        </div>
        @endforeach
        @foreach($arrBookTypeNotDiscount as $book)
        <div class="col-3">
            <div class="text-center container-category-content">
                <div class="container-category-img p-4">
                    <a href="master-{{$book->id_Book}}">
                        <img src="../image/{{$book->image_Book}}" alt="{{$book->name_Book}}">
                    </a>
                </div>
                <div class="text-centers">
                    <a href="master-{{$book->id_Book}}" class="text-body text-decoration-none">{{$book->name_Book}}</a>
                    <div class="container-category-price-entry-notdiscount">{{$book->price_Book}}đ</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@stop