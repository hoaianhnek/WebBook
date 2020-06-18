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
        $discount = discount::where('id_Discount',$disID)->first();
    	return view('admin.v_discount_edit',compact('discount'));
    }
    public function discountEdit(Request $request,$disID){
        discount::where('id_Discount',$disID)->update([
            'name_Discount' => $request->name_Discount,
            'date_end' => $request->date_end,
            'date_start' => $request->date_start,
            'number_Discount' => $request->number_Discount
        ]);
        $arrDis = discount::all();
        return view('admin.v_discount_show',compact('arrDis'));
    }
    public function discountDelete($disID){
        discount::where('id_Discount',$disID)->delete();
        $message = "Xóa thành công";
            echo "<script type='text/javascript'>alert('$message');</script>";

        $arrDis = discount::all();
        return view('admin.v_discount_show',compact('arrDis'));
    }

    public function loadDiscount(Request $request){

        if($request->ajax()){
            $output = '';
            $discount = discount::where('name_Discount','LIKE','%'.$request->search.'%')->get(); 
            if($discount){
                foreach ($discount as $d) {
                    $output .= '
                    <tr>
                        <td><div id="id_Discount">'.$d->id_Discount.'</div></td>
                        <td>
                            <span class="text-ellipsis">'.$d->name_Discount.'</span>
                        </td>
                        <td>
                            <span class="text-ellipsis">'.$d->date_start.'</span>
                        </td>
                        <td>
                            <span class="text-ellipsis">'.$d->date_end.'</span>
                        </td>
                        <td>
                            <span class="text-ellipsis">'.$d->number_Discount.'</span>
                        </td>
                        <td>
                            <a href="discount-edit-view-'.$d->id_Discount.'" class="active" ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a href="discount-delete-'.$d->id_Discount.'" class="active" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    ';
                }
            }
        }
        return Response($output);
    }
}
