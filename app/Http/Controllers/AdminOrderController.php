<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\detailorder;
use App\customer;
use App\book;
use DB;
use PDF;
use App\shipping_charges;

class AdminOrderController extends Controller
{
    public function orderView(){
    	$arrOrder = order::join('customer','customer.id_Cus','=','order.id_Cus')
    	->join('users','users.id','=','customer.id_Us')
    	->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->orderBy('date_purchase','desc')->orderBy('id_Order','asc')
    	->get();


    	// $hii = order::whereYear('date_purchase','2019')->get();
    	$arrDetail = detailorder::join('book','book.id_Book','=','detailorder.id_Book')->get();
    	return view('admin.v_order_show',compact('arrOrder','arrDetail'));
    }
    public function invoice($orderID){
    	$arrOrder = order::join('customer','customer.id_Cus','=','order.id_Cus')
    	->join('users','users.id','=','customer.id_Us')
    	->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
    	->where('order.id_Order',$orderID)
    	->get();

        $arrDetail = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
        ->where('id_Order',$orderID)
        ->get();

        foreach ($arrDetail as $id) {
            $Book = Book::where('id_Book',$id->id_Book)->first();
            $amout = $Book->amount_Book - $id->amount_Order;
            book::where('id_Book',$id->id_Book)->update([
                'amount_Book' => $amout
            ]);
        }
        

        order::where('id_Order',$orderID)->update([
            'status' => 'Đã giao'
        ]);

        $ship = order::join('customer','customer.id_Cus','=','order.id_Cus')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->where('id_Order',$orderID)->first();

        $mpdf = new \Mpdf\Mpdf();
        foreach ($arrOrder as $order) {
            $mpdf->WriteHTML('
            <h2 align = "center">Book Store</h2>
            <div align = "center">Hóa Đơn Bán Hàng</div>
            <br>
            <span> Số hóa đơn: '.$order->id_Order.'</span>
            <div align = "right">Ngày tạo: '.$order->date_purchase.'</span>
            <hr>
            <div align = "center">Tên khách hàng: '.$order->name.'</div>
            <div align = "center">Địa chỉ: '.$order->country.'</div>
            <div align = "center"> Số điện thoại: '.$order->phone_Cus.'</div>
            <div align = "center">Email: '.$order->email.'</div>
            <hr>
            <table style="width:100%;"> 
                <tr>
                    <th style = "width:40%;">Tên sách</th>
                    <th style = "width:20%;">Số lượng</th>
                    <th style = "width:20%;">Giá</th>
                    <th style = "width:20%;">Thành tiền</th>
                </tr>
                </table>
            <hr>
            '
                     
            );
        }
        $sum = 0;
        foreach ($arrDetail as $detail ) {
            $sum += $detail->price_Book * $detail->amount_Order;
            $mpdf->WriteHTML('<table style="width:100%;">
                      <tr>
                        <td style = "width:40%;">'.$detail->name_Book.'</td>
                        <td style = "width:20%;" align="center">'.$detail->amount_Order.'</td>
                        <td style = "width:20%;" align="center">'.$detail->price_Book.'</td>
                        <td style = "width:20%;" align="center">'.$detail->price_Book * $detail->amount_Order.'</td>
                      </tr>
                     </table>

                ');
        }
        $sum += $ship->charges;
        $mpdf->WriteHTML('<hr>
            <div align = "right">Phí Ship: '.$ship->charges.'đ</div>
            <div align = "right">Tổng tiền: '.$sum.'đ</div>
            <br>
            <div align = "center"> Cảm ơn Quý khách và hẹn gặp lại<div> 
            ');

        $mpdf->output();
    }
    public function orderFilter(Request $request){
        $status = $request->status;
        $arrOrder = order::join('customer','customer.id_Cus','=','order.id_Cus')
        ->join('users','users.id','=','customer.id_Us')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->where('status',$status)
        ->orderBy('date_purchase','desc')
        
        ->get();

        $arrStatus = order::select('status')->distinct()->get();
        // $hii = order::whereYear('date_purchase','2019')->get();
        $arrDetail = detailorder::join('book','book.id_Book','=','detailorder.id_Book')->get();
        return view('admin.v_order_show',compact('arrOrder','arrDetail','arrStatus'));
    }
}
