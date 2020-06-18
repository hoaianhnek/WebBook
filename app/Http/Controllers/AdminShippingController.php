<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shipping_charges;

class AdminShippingController extends Controller
{
    
    public function shipView(){
    	$arrShip = shipping_charges::all();
    	return view('admin.v_shipping_show',compact('arrShip'));
    }

    public function shipAdd(Request $request){
    	$data['charges'] = $request->charges;
    	$data['country'] = $request->country;

        $Ship = shipping_charges::where('country',$request->country)->first();
        
            if($Ship != null){
                $message = "Tỉnh/ Thành phố đã tồn tại";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }else{
                shipping_charges::insert($data);
                $message = "Thêm thành công";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
       
    	$arrShip = shipping_charges::all();
    	return view('admin.v_shipping_show',compact('arrShip'));
    }

    public function shipDelete($shipID){
    	shipping_charges::where('id_ship',$shipID)->delete();

    	$message = "Xóa thành công";
    		echo "<script type='text/javascript'>alert('$message');</script>";

    	$arrShip = shipping_charges::all();
    	return view('admin.v_shipping_show',compact('arrShip'));
    }

    public function shipEditView($shipID){
    	$arrShip = shipping_charges::where('id_ship',$shipID)->get();

    	return view('admin.v_shipping_edit',compact('arrShip'));
    }

    public function shipEdit(Request $request,$shipID){
    	shipping_charges::where('id_ship',$shipID)->update(
    		[
    			'country' => $request->country,
    			'charges' =>$request->charges
    		]);

    	$message = "Sửa thành công";
    		echo "<script type='text/javascript'>alert('$message');</script>";

    	$arrShip = shipping_charges::all();
    	return view('admin.v_shipping_show',compact('arrShip'));
    }
}
