<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\detailorder;
use App\customer;
use App\book;
use App\discount;
use DB;
use PDF;
use Illuminate\Database\Eloquent\Collection;
use App\shipping_charges;

class AdminOrderController extends Controller
{
    public function orderView(){
        $daynow = new \DateTime();
        $arrOrder = order::join('customer','customer.id_Cus','=','order.id_Cus')
        ->join('users','users.id','=','customer.id_Us')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->orderBy('date_purchase','desc')->orderBy('id_Order','desc')
        ->paginate(10);

        $arrDetail = detailorder::join('book','book.id_Book','=','detailorder.id_Book')->get();
        foreach ($arrDetail as $detail) {
            if(isset($detail->id_Discount)){
                //lấy cuốn sách ĐANG khuyến mãi
                $detailDis = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                 ->join('discount','discount.id_Discount','=','book.id_Discount')
                 ->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)
                 ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
                if(isset($detailDis->id_Book)){
                    $arrBookDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->join('discount','discount.id_Discount','=','book.id_Discount')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }else{
                    $arrBookNotDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }
                
            } else{
                $arrBook[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
            }
        }


    	return view('admin.v_order_show',compact('arrOrder','arrBookDis','arrBook'));
    }
    public function invoice($orderID){
        $daynow = new \DateTime();
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
            if(isset($detail->id_Discount)){
                //lấy cuốn sách ĐANG khuyến mãi
                $detailDis = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                 ->join('discount','discount.id_Discount','=','book.id_Discount')
                 ->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)
                 ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
                if(isset($detailDis->id_Book)){
                    $arrBookDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->join('discount','discount.id_Discount','=','book.id_Discount')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }else{
                    $arrBookNotDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }
                
            }
            else{
                $arrBook[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
            }
        }
                if(isset($arrBookDis)){
                    foreach ($arrBookDis as $d) {        
                        $total = ($d->price_Book - $d->price_Book*$d->number_Discount/100)*$d->amount_Order;
                        $sum += $total;

                        $price = $d->price_Book - $d->price_Book*$d->number_Discount/100;

                        $mpdf->WriteHTML('<table style="width:100%;">
                            <tr>
                                <td style = "width:40%;">'.$d->name_Book.'</td>
                                <td style = "width:20%;" align="center">'.$d->amount_Order.'</td>
                                <td style = "width:20%;" align="center">'.$price.'đ</td>
                                <td style = "width:20%;" align="center">'.$total.'đ</td>
                            </tr>
                            </table>
                            ');
                        }  
                    }

                    if(isset($arrBookNotDis)){
                    foreach ($arrBookNotDis as $a) {
                        $total = $a->price_Book*$a->amount_Order;
                        $sum += $total;

                        $mpdf->WriteHTML('<table style="width:100%;">
                        <tr>
                            <td style = "width:40%;">'.$a->name_Book.'</td>
                            <td style = "width:20%;" align="center">'.$a->amount_Order.'</td>
                            <td style = "width:20%;" align="center">'.$a->price_Book.'đ</td>
                            <td style = "width:20%;" align="center">'.$total.'đ</td>
                        </tr>
                        </table>
                        ');
                    }
                }

                if(isset($arrBook)){
                    foreach ($arrBook as $a) {
                        $total = $a->price_Book*$a->amount_Order;
                        $sum += $total;

                        $mpdf->WriteHTML('<table style="width:100%;">
                        <tr>
                            <td style = "width:40%;">'.$a->name_Book.'</td>
                            <td style = "width:20%;" align="center">'.$a->amount_Order.'</td>
                            <td style = "width:20%;" align="center">'.$a->price_Book.'đ</td>
                            <td style = "width:20%;" align="center">'.$total.'đ</td>
                        </tr>
                        </table>
                        ');
                    }
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
        $daynow = new \DateTime();
        if(isset($_POST['submit'])){
            
        $arrOrder = order::join('customer','customer.id_Cus','=','order.id_Cus')
        ->join('users','users.id','=','customer.id_Us')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->orderBy('date_purchase','desc')->orderBy('id_Order','desc')
        ->paginate(10);

        $arrDetail = detailorder::join('book','book.id_Book','=','detailorder.id_Book')->get();
        foreach ($arrDetail as $detail) {
            if(isset($detail->id_Discount)){
                //lấy cuốn sách ĐANG khuyến mãi
                $detailDis = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                 ->join('discount','discount.id_Discount','=','book.id_Discount')
                 ->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)
                 ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
                if(isset($detailDis->id_Book)){
                    $arrBookDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->join('discount','discount.id_Discount','=','book.id_Discount')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }else{
                    $arrBookNotDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }
                
            } else{
                $arrBook[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
            }
        }


        return view('admin.v_order_show',compact('arrOrder','arrBookDis','arrBook','arrBookNotDis'));
        }else{
        $status = $request->status;
        $arrOrder = order::join('customer','customer.id_Cus','=','order.id_Cus')
        ->join('users','users.id','=','customer.id_Us')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->where('status',$status)
        ->orderBy('date_purchase','desc')
        
        ->paginate(10);
        // $hii = order::whereYear('date_purchase','2019')->get();
        $arrDetail = detailorder::join('book','book.id_Book','=','detailorder.id_Book')->get();
        foreach ($arrDetail as $detail) {
            if(isset($detail->id_Discount)){
                //lấy cuốn sách ĐANG khuyến mãi
                $detailDis = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                 ->join('discount','discount.id_Discount','=','book.id_Discount')
                 ->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)
                 ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
                if(isset($detailDis->id_Book)){
                    $arrBookDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->join('discount','discount.id_Discount','=','book.id_Discount')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }else{
                    $arrBookNotDis[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                    ->where('book.id_Book',$detail->id_Book)
                    ->where('detailorder.id_Order',$detail->id_Order)
                    ->first();
                }
                
            } else{
                $arrBook[] = detailorder::join('book','book.id_Book','=','detailorder.id_Book')
                ->where('book.id_Book',$detail->id_Book)
                ->where('detailorder.id_Order',$detail->id_Order)
                ->first();
            }
        }
        if(isset($arrBookNotDis))
            return view('admin.v_order_show',compact('arrOrder','arrBookDis','arrBook','arrBookNotDis'));
        else return view('admin.v_order_show',compact('arrOrder','arrBookDis','arrBook'));
    }
    }
}
