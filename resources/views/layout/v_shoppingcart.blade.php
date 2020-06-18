 @extends('layout.v_master')
 @section('body_shopping')

<div class="constraint-cart">
    <div class="mb-2">GIỎ HÀNG ({{Cart::count()}} sản phẩm) </div>
    <div class="container-cart-product">
    	<?php
    	$content = Cart::content();//lấy tất cả nội dung đã thêm vào giỏ hàng
    	?>
        <div class="d-flex container-cart-product-title flex-row-reverse">
            <span>Số tiền</span>
            <span>Số lượng</span>
            <span>Đơn giá</span>  
        </div>
        <hr>
        @foreach($content as $Book)
        <div class="d-flex justify-content-between container-cart-product-item">
            <div class="d-flex"> 
                <img src="../image/{{$Book->options->image}}" style="width: 120px;  alt="{{$Book->name}}">
                <div class="ml-4">
                    <a href="#" class="container-cart-product-item-name text-decoration-none"> {{$Book->name}} </a>
                    <p>- Tác giả: {{$Book->options->author}}</p>
                    <p>Trạng thái: Còn hàng</p>
                    <a href="deletecart-{{$Book->rowId}}" class="mt-2 container-cart-product-item-del">Xóa</a>
                </div>
            </div>
            <div class="d-flex">
                <div class="container-cart-product-item-price">
                    <span>{{$Book->price}}</span>
                </div>
                <div class="container-cart-product-item-price">	
					<div class="cart_quantity_button">
						<a class="cart_quantity_up text-decoration-none" href="qty-cart?id_Book={{$Book->id}}&increment=1">+</a>
                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$Book->qty}}" autocomplete="off" size="2" disabled>
                        <a class="cart_quantity_down text-decoration-none" href="qty-cart?id_Book={{$Book->id}}&decrease=1">-</a>
					</div>
                </div>
                <div class="text-danger" id="price">
                    <?php
                    $subtotal = $Book->price * $Book->qty;
                    echo $subtotal;
                    ?> đ
                </div>
            </div>         
        </div>
        @endforeach
        <hr>
        <div>
            <div class="d-flex justify-content-end pr-5">
                <span class="mr-5">Số tiền</span>
                <span class="ml-5">{{Cart::subtotal()}} đ</span>
            </div>
            <div class="d-flex justify-content-end pr-5">
                <span class="mr-5">Phí vận chuyển</span>
                <span class="ml-5">
                    <?php $tax = 0;?>
                    @if(isset($customer->id_Ship))   
                        <?php
                        $tax = $customer->charges;
                        echo $tax;
                        ?>
                    @else
                    {{$tax}}
                    @endif
                    đ
                </span>
            </div>
        </div>
        
        <hr>
        <div class="d-flex justify-content-end container-cart-product-pay pr-5">
            <span class="mr-4">THANH TOÁN</span>
            <span class="ml-4">{{Cart::total()+$tax}} đ</span>
        </div><!-- +$tax = $Book->price -->
        <div class="d-flex justify-content-end pt-3 pr-5">
            <a class="mr-4 text-decoration-none text-dark" id="next-purchase" href="master-home">Tiếp tục mua hàng
                <i class="fas fa-cart-plus pr-2"></i>
            </a>
            <a id="pay" href="checkout-view" class="text-decoration-none">Thanh toán
                <i class="fas fa-chevron-circle-right pr-2"></i>
            </a>
        </div>
    </div>
</div>

@stop