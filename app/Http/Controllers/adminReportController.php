<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\book;
use App\discount;
use DB;
use App\detailorder;

class adminReportController extends Controller
{
    public function reportmonth()
    {	
    	//Lấy ra tất cả các năm từ khi tạo hóa đơn
    	$year = order::select(DB::raw('Year(date_purchase) AS year'))->distinct()->get();
    	//lấy ra tg hiện tại
    	$daynow = new \DateTime();
    	$total = array();
    	for($i=1;$i<13;$i++){
    		//lấy ra mảng các chi tiết hóa đơn theo từng tháng
    		$arrOrde = order::whereMonth('date_purchase',$i)
    		->join('detailorder','detailorder.id_Order','=','order.id_Order')
    		->get();
    		//Gán mảng hóa đơn theo tháng bằng hóa đơn
    		$arrOrder[] = $arrOrde;
    		//print_r($arrOrde."<br>");
    	}	
    	//chạy mảng hóa đơn của mỗi tháng
    		foreach ($arrOrder as $order) {
    			if(sizeof($order)>0){
    				$sum=0;
    				
    				//chạy mảng chi tiết hóa đơn
    				foreach ($order as $o) {
    					//lấy ra chi tiết của hóa đơn đó
    					$arrdetail = order::join('detailorder','detailorder.id_Order','=','order.id_Order')->join('book','book.id_Book','=','detailorder.id_Book')
    					->where('order.id_Order',$o->id_Order)
    					->where('detailorder.id_Book',$o->id_Book)
    					->first();
    						if(isset($arrdetail->id_Discount)){
    							//Lây sách đang km
    							$arrdetaildis = order::join('detailorder','detailorder.id_Order','=','order.id_Order')->join('book','book.id_Book','=','detailorder.id_Book')
    							->join('discount','discount.id_Discount','=','book.id_Discount')
    							->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)
    							->where('order.id_Order',$arrdetail->id_Order)
		    					->where('detailorder.id_Book',$arrdetail->id_Book)
		    					->first();

		    					if(isset($arrdetaildis)){
		    						//tính tổng tiền sách giảm giá
	    							$arrOrder1 = order::join('detailorder','detailorder.id_Order','=','order.id_Order')->join('book','book.id_Book','=','detailorder.id_Book')
	    							->join('discount','book.id_Discount','=','discount.id_Discount')
	    							->select(DB::raw('SUM((price_Book - (price_Book*number_Discount)/100)*amount_Order) AS total'),DB::raw('Month(date_purchase) AS month'))
	    							->where('order.id_Order',$arrdetaildis->id_Order)->where('book.id_Book',$arrdetaildis->id_Book)
	    							->groupBy('month')
	    							->first();
	    							$sum += $arrOrder1->total;
			    				}else{
			    					//tính tổng tiền sách không kmai
	    							$arrOrder2 = order::join('detailorder','detailorder.id_Order','=','order.id_Order')
	    							->join('book','book.id_Book','=','detailorder.id_Book')
	    							->select(DB::raw('SUM(price_Book*amount_Order) AS total'),DB::raw('Month(date_purchase) AS month'))	
	    							->where('order.id_Order',$arrdetail->id_Order)->where('book.id_Book',$arrdetail->id_Book)
	    							->groupBy('month')->first();
	    							$sum += $arrOrder2->total;
			    				}
			    			}

    						else{
    							//tính tổng tiền sách không kmai
    							$arrOrder3 = order::join('detailorder','detailorder.id_Order','=','order.id_Order')
    							->join('book','book.id_Book','=','detailorder.id_Book')
    							->select(DB::raw('SUM(price_Book*amount_Order) AS total'),DB::raw('Month(date_purchase) AS month'))	
    							->where('order.id_Order',$arrdetail->id_Order)->where('book.id_Book',$arrdetail->id_Book)
    							->groupBy('month')->first();
    							$sum += $arrOrder3->total;
    						}

    				}
	    				$total[] = $sum;

				}
    			else {
    				$sum = 0;
    				$total[] = $sum;
    			}
    			
    		}

    	return view('admin.v_baocaodoanhthu',compact('total','year'));
    }

    public function reportyear(Request $request){
    	$daynow = new \DateTime();
    	if(isset($_POST['submit-filter']))
    	{
    		for($i=1;$i<13;$i++){
    		//lấy ra mảng các chi tiết hóa đơn theo từng tháng của năm
    		$arrOrde = order::whereMonth('date_purchase',$i)
    		->join('detailorder','detailorder.id_Order','=','order.id_Order')
    		->whereYear('date_purchase',$request->year)
    		->get();
    		//Gán mảng hóa đơn theo tháng bằng hóa đơn
    		$arrOrder[] = $arrOrde;
    		//print_r($arrOrde."<br>");
    	}	
    	//chạy mảng hóa đơn của mỗi tháng
    		foreach ($arrOrder as $order) {
    			if(sizeof($order)>0){
    				$sum=0;
    				
    				//chạy mảng chi tiết hóa đơn
    				foreach ($order as $o) {
    					//lấy ra chi tiết của hóa đơn đó
    					$arrdetail = order::join('detailorder','detailorder.id_Order','=','order.id_Order')->join('book','book.id_Book','=','detailorder.id_Book')
    					->where('order.id_Order',$o->id_Order)
    					->where('detailorder.id_Book',$o->id_Book)
    					->first();
    						if(isset($arrdetail->id_Discount)){
    							//Lây sách đang km
    							$arrdetaildis = order::join('detailorder','detailorder.id_Order','=','order.id_Order')->join('book','book.id_Book','=','detailorder.id_Book')
    							->join('discount','discount.id_Discount','=','book.id_Discount')
    							->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)
    							->where('order.id_Order',$arrdetail->id_Order)
		    					->where('detailorder.id_Book',$arrdetail->id_Book)
		    					->first();

		    					if(isset($arrdetaildis)){
		    						//tính tổng tiền sách giảm giá
	    							$arrOrder1 = order::join('detailorder','detailorder.id_Order','=','order.id_Order')->join('book','book.id_Book','=','detailorder.id_Book')
	    							->join('discount','book.id_Discount','=','discount.id_Discount')
	    							->select(DB::raw('SUM((price_Book - (price_Book*number_Discount)/100)*amount_Order) AS total'),DB::raw('Month(date_purchase) AS month'))
	    							->where('order.id_Order',$arrdetaildis->id_Order)->where('book.id_Book',$arrdetaildis->id_Book)
	    							->groupBy('month')
	    							->first();
	    							$sum += $arrOrder1->total;
			    				}else{
			    					//tính tổng tiền sách không kmai
	    							$arrOrder2 = order::join('detailorder','detailorder.id_Order','=','order.id_Order')
	    							->join('book','book.id_Book','=','detailorder.id_Book')
	    							->select(DB::raw('SUM(price_Book*amount_Order) AS total'),DB::raw('Month(date_purchase) AS month'))	
	    							->where('order.id_Order',$arrdetail->id_Order)->where('book.id_Book',$arrdetail->id_Book)
	    							->groupBy('month')->first();
	    							$sum += $arrOrder2->total;
			    				}
			    			}
    						else{
    							//tính tổng tiền sách không kmai
    							$arrOrder2 = order::join('detailorder','detailorder.id_Order','=','order.id_Order')
    							->join('book','book.id_Book','=','detailorder.id_Book')
    							->select(DB::raw('SUM(price_Book*amount_Order) AS total'),DB::raw('Month(date_purchase) AS month'))	
    							->where('order.id_Order',$arrdetail->id_Order)->where('book.id_Book',$arrdetail->id_Book)
    							->groupBy('month')->first();
    							$sum += $arrOrder2->total;
    						}

    				}
	    				$total[] = $sum;

				}
    			else {
    				$sum = 0;
    				$total[] = $sum;
    			}
    			
    		}
	    	
	    	$yearnow = 	$request->year;
	    	$notyearnow = order::select(DB::raw('Year(date_purchase) AS year'))->distinct()
	    	->whereYear('date_purchase','<>',$yearnow)->get();
	    	return view('admin.v_baocaodoanhthu',compact('total','yearnow','notyearnow'));
    	}
    	else{
    		return redirect('admin/report-month');
    	}
    	
    }
}
