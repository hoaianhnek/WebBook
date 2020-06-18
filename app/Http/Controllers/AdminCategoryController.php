<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminCategoryController extends Controller
{
    public function viewCategory(){
    	$arrType = category::where('status_Category','=','true')->get();
    	return view('admin.v_category_show',compact('arrType'));
    }

    public function addCategory(Request $request){
        $rules = [
            'name_Category' => 'required',
            'id_Category' => 'required'
        ];

        $messages = [
            'name_Category.required' => 'Tên thể loại không được rỗng',
            'id_Category' => 'ID thể loại không được rỗng'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
        // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
        return redirect('admin/category-view')->withErrors($validator)->withInput();
        }else{
        	$data['id_Category'] = $request->id_Category;
        	$data['name_Category'] = $request->name_Category;
            $data['status_Category'] = 'true';
        	DB::table('category')->insert($data);
        	$message = "Thêm thành công";
        		echo "<script type='text/javascript'>alert('$message');</script>";

        	$arrType = category::where('status_Category','=','true')->get();
        	return view('admin.v_category_show',compact('arrType'));
        }
    }

    public function deleteCategory($categoryid){
    	category::where('id_Category',$categoryid)->update([
            'status_Category' => 'false'
        ]);

    	$message = "Thể loại đã được xóa";

    	$arrType = category::where('status_Category','=','true')->get();
    	return view('admin.v_category_show',compact('arrType','message'));
    }
    public function viewAddCategory($categoryid){
    	$arrType = category::where('id_Category',$categoryid)->get();

    	return view('admin.v_category_edit',compact('arrType'));
    }
    public function updateCategory(Request $request,$categoryid){
    	category::where('id_Category',$categoryid)->update(
    		[
    			'id_Category' => $request->id_Category,
    			'name_Category' =>$request->name_Category
    		]
    	);
        $message = "Thể loại đã được sửa";

    	$arrType = category::all();
    	return view('admin.v_category_show',compact('arrType','message'));

    }
}
