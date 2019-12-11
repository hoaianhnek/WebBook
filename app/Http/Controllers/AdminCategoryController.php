<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use DB;

class AdminCategoryController extends Controller
{
    public function viewCategory(){
    	$arrType = category::all();
    	return view('admin.v_category_show',compact('arrType'));
    }

    public function addCategory(Request $request){
    	$data['id_Category'] = $request->id_Category;
    	$data['name_Category'] = $request->name_Category;
    	DB::table('category')->insert($data);

    	$message = "Thêm thành công";
    		echo "<script type='text/javascript'>alert('$message');</script>";

    	$arrType = category::all();
    	return view('admin.v_category_show',compact('arrType'));
    }

    public function deleteCategory($categoryid){
    	category::where('id_Category',$categoryid)->delete();

    	$message = "Thể loại đã được xóa";
    		echo "<script type='text/javascript'>alert('$message');</script>";

    	$arrType = category::all();
    	return view('admin.v_category_show',compact('arrType'));
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
    	$arrType = category::all();
    	return view('admin.v_category_show',compact('arrType'));

    }
}
