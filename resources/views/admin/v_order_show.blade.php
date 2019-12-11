@extends('admin.v_admin_dashboard')
@section('order_show')

<section id="main-content">
  <section class="wrapper">
    <div class="table-agile-info">
      <div class="panel panel-default">
        <div class="panel-heading">
      QUẢN LÝ HÓA ĐƠN
        </div>
        <div class="row w3-res-tb"> 
            <div class="col-sm-5 m-b-xs">          
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th data-breakpoints="xs" scope="col">ID</th>
                    <th>Tên khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Địa chỉ</th>
                    <th>Chi tiết</th>
                    <th>Phí Ship</th>
                    <th>Tổng giá</th>
                    <th>Trạng thái</th>
                    <th scope="col">Xử lý</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arrOrder as $order)
            	<tr>
                    <?php $sum = 0;?>
                    <td >{{$order->id_Order}}</td>
                    <td>
                		<span class="text-ellipsis" name="name">{{$order->name}}</span>
                    </td>
                  	<td>
                		<span class="text-ellipsis">{{$order->date_purchase}}</span>
                  	</td>
                  	<td>
                    	<span class="text-ellipsis">{{$order->country}}</span>
                  	</td>
                  	<td>
                		<table width="auto" border="0">
                            <tbody>
                                <tr>
                                    <td>Tên</td>
                                    <td>Số lượng</td>
                                    <td>Giá</td>
                                </tr>
                                @foreach($arrDetail as $detail)
                                @if($detail->id_Order == $order->id_Order)
                                <tr>
                                
                                    <td>{{$detail->name_Book}}</td>
                                    <td>{{$detail->amount_Order}}</td>
                                    <td>{{$detail->price_Book}}đ</td>
                                    <?php 
                                        $charges = $order->charges;
                                        $sum += $detail->amount_Order * $detail->price_Book + $charges;
                                    ?>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                  	</td>
                    <td>{{$charges}}đ</td>
                  	<td>
                		<span>{{$sum}}đ</span>
                  	</td>
                    <td>
                      	<span>{{$order->status}}</span>
                    </td>
                    <td>
                        @if($order->status == 'Đã giao')
                        <button name="submit-delivering" class="btn float-right" disabled="true">Xuất hóa đơn</button>
                        @else
                        <form method="post" action="order-invoice-{{$order->id_Order}}">
                            {{ csrf_field() }}
                            <button type="submit" name="submit-delivering" class="btn float-right">Xuất hóa đơn</button>
                        </form>
                        @endif
                    </td>
            	</tr>
            	@endforeach
            </tbody>
          </table>
        </div>
        </div>
      </div>
  </section>

@stop