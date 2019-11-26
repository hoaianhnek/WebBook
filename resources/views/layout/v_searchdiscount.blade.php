@extends('layout.v_master')
@section('body_search')

<div class="container-search">
    <div>Kết quả tìm kiếm</div>
    <hr>
    <div class="row p-4">
    @if($books)
    	@foreach($books as $book)
        <div class="col-3" id="datasearch">
	        <div class="text-center container-search-content">
	            <div class="container-search-img p-4">
	                <a href="#">
	                    <img src="../image/{{$book->image_Book}}" alt="{{$book->name_Book}}">
				        <div class="container-search-discount">-{{$book->number_Discount}}%</div>
	                </a>
	            </div>
	            <div class="text-centers">
	                <a href="#" class="text-body text-decoration-none">{{$book->name_Book}}</a>
	                <div class="container-search-price-entry">{{$book->price_Book}}đ</div>
	                <span class="container-search-price-present">{{$Book->price_Book - ($Book->price_Book * ($Book->number_Discount)/100)}}đ</span>
	            </div>
	        </div>
       	</div>
       	
    </div>
</div>
@stop