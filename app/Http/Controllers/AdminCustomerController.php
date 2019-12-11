<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\shipping_charges;
use App\User;
use DB;
use users;

class AdminCustomerController extends Controller
{
    public function viewCustomer(){
        $arrCuss= customer::all();
        foreach ($arrCuss as $cus) {
            if(isset($cus->id_Ship)){
                $arrCus = customer::join('users','users.id','=','customer.id_Us')
                ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
                ->get();
            }else{
                $arrCus = customer::join('users','users.id','=','customer.id_Us')->get();
            }
        }
    	
    	return view('admin.v_customer_show',compact('arrCus'));

    }

    public function viewAddCustomer(){
    	$arrShip = shipping_charges::all();
    	return view('admin.v_customer_add',compact('arrShip'));
    }

    public function addCustomer(Request $request){
    	$data = array();
    	$data['email'] = $request ->email;
    	$data['name'] = $request->name;
    	$data['password'] = '0000';
    	$user = User::create($data);
    	// $id_US = users::where('email',$request ->email)->get();
    	$data_cus = array();
    	$data_cus['phone_Cus'] = $request->phone;
    	$data_cus['id_Us'] =  $user->id;
    	$data_cus['id_Ship'] = $request->country;
    	customer::insert($data_cus);

    	$message = "Khách hàng đã được thêm thành công";
    		echo "<script type='text/javascript'>alert('$message');</script>";

    	$arrCus = customer::join('users','users.id','=','customer.id_Us')
    	->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
    	->get();
    	return view('admin.v_customer_show',compact('arrCus'));

    }

    public function customerEditView($cusID){
    	$Cus = customer::where('id_Cus',$cusID)->join('users','users.id','=','customer.id_Us')
    	->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
    	->get();

    	$id_Ship = customer::where('id_Cus',$cusID)->select('id_Ship')->get();
    	$arrShip = shipping_charges::whereNotIn('id_Ship',$id_Ship)->get();

    	return view('admin.v_customer_edit',compact('Cus','arrShip'));
	    }

	public function customerEdit(Request $request,$cusID){
		customer::where('id_Cus',$cusID)->update(
			[
				'id_Ship' => $request->country,
				'phone_Cus' => $request->phone
			]);
		$id_US = customer::where('id_Cus',$cusID)->select('id_Us')->get();

		User::where('id',$id_US)->update([
			'email' => $request->email,
			'name' => $request->name
		]);

		$arrCus = customer::join('users','users.id','=','customer.id_Us')
    	->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
    	->get();
    	return view('admin.v_customer_show',compact('arrCus'));
	}

	public function customerDelete($cusID){
		$id_US = customer::where('id_Cus',$cusID)->select('id_Us')->get();
		customer::where('id_Cus',$cusID)->delete();

		User::where('id',$id_US)->delete();

		$arrCus = customer::join('users','users.id','=','customer.id_Us')
    	->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
    	->get();
    	return view('admin.v_customer_show',compact('arrCus'));
	}
}
