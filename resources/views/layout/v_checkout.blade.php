 @extends('layout.v_master')
 @section('body_checkout')
<head>
	<meta name="_token" content="{{ csrf_token() }}">
</head>
<div style="margin-bottom: 10px;margin-top:20px;margin-left: 5rem;">
	<div class="row justify-content-center">
		<div class="col-sm-6">
			<h4>Thông tin sản phẩm</h4>
			<div class="row">
				<div class="col-sm-12">
					<table class="table">
						<thead>
							<tr>
								<th style="border-left-style: none; border-top-style: none;border-right-style: none;">Sản phẩm</th>
								<th style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-center">Số lượng</th>
								<th style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-center">Đơn giá</th>
								<th  style="border-left-style: none; border-top-style: none;border-right-style: none;"class="text-center">Thành tiền</th>
							</tr>
						</thead>
						<tbody>
							@foreach($arrCart as $cart)
							<tr>
								<td style="border-left-style: none; border-top-style: none;border-right-style: none;" class="col-sm-5">
									<div class="media">
										<a class="thumbnail pull-left" href="#"> 
											<img class="media-object" src="../../public/image/{{$cart->options->image}}" style="width: 70px;"> </a>
										<div class="media-body">
											<h6 class="media-heading ml-3">
												<a href="master-{{$cart->id}}">
													{{$cart->name}}
												</a>
											</h6>
										</div>
									</div>
								</td>
								<td style="border-left-style: none; border-top-style: none;border-right-style: none; "class="col-sm-2" style="text-align: center">
									<div class="cart_quantity_button">{{$cart->qty}}</div>
								</td>
								<td style="border-left-style: none; border-top-style: none;border-right-style: none;" class="col-sm-3 text-center">
									{{$cart->price}}đ
								</td>
								<td style="border-left-style: none; border-top-style: none;border-right-style: none;" class="col-sm-2 text-center">
									{{$cart->qty*$cart->price}}đ
								</td>
							</tr>
							@endforeach
							<tr>
								<td colspan="3"style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-right">
									<h5>Số tiền</h5>
								</td>
								<td style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-right">
									<h5>{{Cart::subtotal()}} đ</h5>
								</td>
							</tr>
							<tr>
								<td colspan="3" style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-right">
									<h5>Phí ship</h5>
								</td>

								<td style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-right">
									<h5 id="charges">
											<?php $tax = 0;?>
						                    @if($customer->id_Ship != null)
						                        <?php
						                        $tax = $customer->charges;
						                        echo $tax;
						                        ?>
						                    @else
						                    {{$tax}}
						                    @endif
						                    đ
			                    	</h5>
								</td>

							</tr>
							<tr>
								<td colspan="3" style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-right" >
									<h5>Thanh toán</h5>
								</td>
								<td style="border-left-style: none; border-top-style: none;border-right-style: none;" class="text-right" >
									<h5><input type="text" id="thanhtoan" value="{{Cart::total()+$tax}} đ" class="border-0 text-right text-body font-weight-bold" style="width: 100px;background-color: white" disabled="true" ></h5>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<h4>Thông tin khách hàng</h4>

			<form method="POST" action="checkout-{{$customer->id_Cus}}">
				{{ csrf_field() }}

				<div class="modal-body">
					<div class="form-group">
						<label>Họ tên</label>
						<input type="text" class="form-control" name="customer_name" value="{{$customer->name}}">
						@if($errors->has('customer_name'))
							<p style="color:red">{{$errors->first('customer_name')}}</p>
						@endif
					</div>
					<div class="form-group">
						<label>Số điện thoại</label>
						<input type="text" class="form-control" name="customer_phone" value="{{$customer->phone_Cus}}">
						@if($errors->has('customer_phone'))
							<p style="color:red">{{$errors->first('customer_phone')}}</p>
						@endif
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="customer_email" value="{{$customer->email}}">
					</div>
					<div class="form-row">
						<div class="form-group col-md-7">
							<label >Địa chỉ</label>
							<input type="text" class="form-control" name="customer_address" placeholder="Địa chỉ nhận hàng" value="{{$customer->add_Cus}}">
							@if($errors->has('customer_address'))
								<p style="color:red">{{$errors->first('customer_address')}}</p>
							@endif
						</div>
						<div class="form-group col-md-5">
							<label >Tỉnh</label>
							<div>
								 <select name= "customer_province" id = "province"class="input-sm form-control w-sm inline v-middle">
								 	@if($customer->country != null)
									<option value="{{$customer->id_Ship}}">{{$customer->country}}</option>
									@foreach($ship as $s)
									<option value="{{$s->id_ship}}">{{$s->country}}</option>
									@endforeach
									@else
									<option value="">--Chọn tỉnh/ thành phố--</option>
									@foreach($arrShip as $ship)
									<option value="{{$ship->id_ship}}">{{$ship->country}}</option>
									@endforeach
									@endif
								</select>
								@if($errors->has('customer_province'))
									<p style="color:red">{{$errors->first('customer_province')}}</p>
								@endif
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="submit-cancel" class="btn btn-danger">Hủy</button>
						<button type="submit" name="submit-confirm" class="btn btn-success">Đặt hàng</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var cart = parseFloat($("#thanhtoan").val());
	$(document).ready(function(){
		$("#province").change(function(event){
			event.preventDefault();
			var ship =  $(this).val();
			$.ajax({
				type:'get',
				url:"{{URL::to('bookstore/loadShip')}}",
				data:{'ship':ship},
				dataType:"text",//dữ liệu trả về
				success:function(data){
					$("#charges").html(data+' đ');
					var da = parseFloat(data);
					$("#thanhtoan").val(da+cart + ' đ');
					
				}
			});
		});

	});
</script>
 @stop