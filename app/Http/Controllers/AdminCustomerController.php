<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\shipping_charges;
use App\User;
use DB;
use App\users;
use Illuminate\Support\Facades\Validator;

class AdminCustomerController extends Controller
{
    public function viewCustomer(){
        $arrCuss= customer::where('status_Customer','true')
        ->get();
        foreach ($arrCuss as $cus) {
            if(isset($cus->id_Ship)){
                $arrCusAddr[] = customer::join('users','users.id','=','customer.id_Us')
                ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
                ->where('id_Cus',$cus->id_Cus)->where('role',3)
                ->first();
            }else{
                $arrCus[] = customer::join('users','users.id','=','customer.id_Us')
                ->where('id_Cus',$cus->id_Cus)->where('role',3)
                ->first();
            }

        }
    	
    	return view('admin.v_customer_show',compact('arrCus','arrCusAddr'));

    }

    public function viewAddCustomer(){
    	$arrShip = shipping_charges::all();
    	return view('admin.v_customer_add',compact('arrShip'));
    }

    public function addCustomer(Request $request){

        $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'country' => 'required',
                'phone'=>'required|numeric',
                'addr' => 'required'
            ];

        $messages = [
                'name.required' => 'Tên khách hàng không được để trống',
                'email.required' => 'Email không được để trống',
                'country.required' => 'Vui lòng chọn thành phố/ tỉnh',
                'phone.required' => 'Số điện thoại không được để trống',
                'addr.required' => 'Địa chỉ không được để trống',
                'phone.numeric' => 'Số điện thoại là trường nhập số',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại'
            ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('admin/customer-view-add')->withErrors($validator)->withInput();
        }else{
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
            $data_cus['add_Cus'] = $request->addr;
            $data_cus['status_Customer'] = 'true';
        	customer::insert($data_cus);

        	$message = "Khách hàng đã được thêm thành công";
        		echo "<script type='text/javascript'>alert('$message');</script>";

            $arrCuss= customer::where('status_Customer','true')
            ->get();

            foreach ($arrCuss as $cus) {
                if(isset($cus->id_Ship)){
                    $arrCusAddr[] = customer::join('users','users.id','=','customer.id_Us')
                    ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
                    ->where('id_Cus',$cus->id_Cus)
                    ->first();
                }else{
                    $arrCus[] = customer::join('users','users.id','=','customer.id_Us')
                    ->where('id_Cus',$cus->id_Cus)
                    ->first();
                }

            }

        	return view('admin.v_customer_show',compact('arrCus','arrCusAddr'));
        }

    }

    public function customerEditView($cusID){
        $cuss = customer::where('id_Cus',$cusID)->first();
        if(isset($cuss->id_Ship)){
            $Cus = customer::where('id_Cus',$cusID)->join('users','users.id','=','customer.id_Us')
            ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
            ->get();
        }else{
            $Cus = customer::where('id_Cus',$cusID)->join('users','users.id','=','customer.id_Us')
            ->get();
        }

    	

    	$id_Ship = customer::where('id_Cus',$cusID)->select('id_Ship')->get();
    	$arrShip = shipping_charges::whereNotIn('id_Ship',$id_Ship)->get();

        $arrship = shipping_charges::all();

    	return view('admin.v_customer_edit',compact('Cus','arrShip','arrship'));
	    }

	public function customerEdit(Request $request,$cusID){
		customer::where('id_Cus',$cusID)->update(
			[
				'id_Ship' => $request->country,
				'phone_Cus' => $request->phone,
                'add_Cus' => $request->addr
			]);
		$id_US = customer::where('id_Cus',$cusID)->select('id_Us')->get();

		User::where('id',$id_US)->update([
			'email' => $request->email,
			'name' => $request->name
		]);

		$arrCuss= customer::where('status_Customer','true')
        ->get();
        foreach ($arrCuss as $cus) {
            if(isset($cus->id_Ship)){
                $arrCusAddr[] = customer::join('users','users.id','=','customer.id_Us')
                ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
                ->where('id_Cus',$cus->id_Cus)->where('role',3)
                ->first();
            }else{
                $arrCus[] = customer::join('users','users.id','=','customer.id_Us')
                ->where('id_Cus',$cus->id_Cus)->where('role',3)
                ->first();
            }

        }
    	return view('admin.v_customer_show',compact('arrCus','arrCusAddr'));
	}

	public function customerDelete($cusID){

		customer::where('id_Cus',$cusID)->update([
            'status_Customer' => 'false'
        ]);

        $arrCuss= customer::where('status_Customer','true')
        ->get();

        foreach ($arrCuss as $cus) {
            if(isset($cus->id_Ship)){
                $arrCusAddr[] = customer::join('users','users.id','=','customer.id_Us')
                ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
                ->where('id_Cus',$cus->id_Cus)->where('role',3)
                ->first();
            }else{
                $arrCus[] = customer::join('users','users.id','=','customer.id_Us')
                ->where('id_Cus',$cus->id_Cus)->where('role',3)
                ->first();
            }

        }
    	return view('admin.v_customer_show',compact('arrCus','arrCusAddr'));
	}

    public function customerloadAjax(Request $request){
        
        if($request->ajax()){
            $output = '';
            $customer = customer::join('users','users.id','=','customer.id_Us')
            ->where('name','LIKE','%'.$request->search.'%')->where('role',3)
            ->get();
            if($customer){
                foreach ($customer as $c) {
                    if(isset($c->id_Ship)){
                        $arrCusAddr[] = customer::join('shipping_charges','shipping_charges.id_Ship','=','customer.id_Ship')
                        ->join('users','users.id','=','customer.id_Us')
                        ->where('id_Cus',$c->id_Cus)->first();
                    }else{
                        $arrCus[] =  customer::join('users','users.id','=','customer.id_Us')
                        ->where('id_Cus',$c->id_Cus)->first();
                    }
                }
            }
        }
        if(isset($arrCus)){
            foreach ($arrCus as $cus) {
                $output .= '
                <tr>
                    <td>'.$cus->id_Cus.'</td>
                    <td>
                        <span class="text-ellipsis">'.$cus->name.'</span>
                    </td>
                    <td>
                        <span class="text-ellipsis">'.$cus->email.'</span>
                    </td>
                    <td>
                        <span class="text-ellipsis">'.$cus->phone_Cus.'</span>
                    </td>
                    <td>
                    <span class="text-ellipsis">'.$cus->add_Cus.'</span>
                    </td>
                    <td>
                            
                    </td>
                    <td>
                        <a href="customer-edit-view-'.$cus->id_Cus.'" class="active" ui-toggle-class="">
                            <i class="fa fa-edit text-success text-active"></i>
                        </a>
                        <a href="customer-delete-'.$cus->id_Cus.'" class="active" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                        </a>
                    </td>
                </tr>
                ';
            }
        }
        if(isset($arrCusAddr)){
            foreach ($arrCusAddr as $Cus) {
                $output .= '
                <tr>
                    <td>'.$Cus->id_Cus.'</td>
                    <td>
                    <span class="text-ellipsis">'.$Cus->name.'</span>
                    </td>
                    <td>
                    <span class="text-ellipsis">'.$Cus->email.'</span>
                    </td>
                    <td>
                    <span class="text-ellipsis">'.$Cus->phone_Cus.'</span>
                    </td>
                    <td>
                    <span class="text-ellipsis">'.$Cus->add_Cus.'</span>
                    </td>
                    <td>
                        <span class="text-ellipsis">'.$Cus->country.'</span>
                    </td>
                    <td>
                        <a href="customer-edit-view-'.$Cus->id_Cus.'" class="active" ui-toggle-class="">
                          <i class="fa fa-edit text-success text-active"></i>
                        </a>
                        <a href="customer-delete-'.$Cus->id_Cus.'" class="active" ui-toggle-class="">
                          <i class="fa fa-times text-danger text"></i>
                        </a>
                    </td>
                  </tr>';
            }
        }
        return Response($output);
    }
}
