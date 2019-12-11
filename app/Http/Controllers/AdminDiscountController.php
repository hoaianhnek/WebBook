<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\discount;

class AdminDiscountController extends Controller
{
    //
    public function discountView(){
    	$arrDis = discount::all();
    	return view('admin.v_discount_show',compact('arrDis'));
    }

    public function discountAddView(){
    	return view('admin.v_discount_add');
    }

    public function discountAdd(Request $request){
    	$data['name_Discount'] = $request->name_Discount;
    	$data['date_start'] = $request->date_start;
    	$data['date_end'] = $request->date_end;
    	$data['number_Discount'] = $request->number_Discount;

    	discount::insert($data);

    	$message = "Thêm thành công";
    		echo "<script type='text/javascript'>alert('$message');</script>";

    	$arrDis = discount::all();
    	return view('admin.v_discount_show',compact('arrDis'));
    }

    public function discountViewEdit($disID){
    	return view('admin.v_discount_edit');
    }
    public function discountDelete($disID){
        discount::where('id_Discount',$disID)->delete();
        $message = "Xóa thành công";
            echo "<script type='text/javascript'>alert('$message');</script>";

        $arrDis = discount::all();
        return view('admin.v_discount_show',compact('arrDis'));
    }
}
