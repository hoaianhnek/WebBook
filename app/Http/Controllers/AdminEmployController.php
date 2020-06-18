<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\users;
use App\User;
use Illuminate\Support\Facades\Validator;

class AdminEmployController extends Controller
{
    public function viewEmploy(){
    	$arrUser = users::where('role',1)->orWhere('role',2)->get();
    	return view('admin.v_employ_show',compact('arrUser'));
    }
    public function viewEmployAdd(){
    	return view('admin.v_employ_add');
    }
    public function employedit($idUser){
    	$employ = users::where('id',$idUser)->first();
    	return view('admin.v_employ_edit',compact('employ'));
    }
    public function addEmploy(Request $request){
    	$rules = [
    		'name' => 'required',
    		'email' => 'required|email|unique:users',
    		'password' => 'required|min:3',
    		'role' => 'required'
    	];
    	$messages = [
    		'name.required' => 'Tên nhân viên không được để trống',
    		'email.required' => 'Email không được để trống',
    		'email.email' => 'Không đúng định dạng',
    		'password.required' => 'password không được để trống',
    		'password.min' => 'password tối thiếu 3 kí tự',
    		'role.required' => 'Chức vụ không được để trống',
            'email.unique' => 'Email đã tồn tại'
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);
    	if ($validator->fails()) {
            return redirect('admin/show-employ-add')->withErrors($validator)->withInput();
        }else{
        	$data['name'] = $request->name;
        	$data['email'] = $request->email;
        	$data['password'] = bcrypt($request->password);
        	$data['role'] = $request->role;
        	users::insert($data);
        	$message = "Nhân viên đã được thêm thành công";
        		echo "<script type='text/javascript'>alert('$message');</script>";
        	$arrUser = users::where('role',1)->orWhere('role',2)->get();
    		return view('admin.v_employ_show',compact('arrUser'));
    }
	}
	public function employDelete($id){
		users::where('id',$id)->delete();
		$message = "Nhân viên đã được xóa thành công";
        		echo "<script type='text/javascript'>alert('$message');</script>";
		$arrUser = users::where('role',1)->orWhere('role',2)->get();
    	return view('admin.v_employ_show',compact('arrUser'));
	}
    public function employupdate(Request $request,$id){
    	if(isset($_POST['submit-cancel'])){
    		$arrUser = users::where('role',1)->orWhere('role',2)->get();
	    	return view('admin.v_employ_show',compact('arrUser'));
    	}
    		else{
	    	users::where('id',$id)->update([
	    		'name' => $request->name,
	    		'email' => $request->email,
	    		'password' => bcrypt($request->password),
	    		'role' => $request->role
	    	]);
	    	$error = "Cập nhật thành công!";
	    	$arrUser = users::where('role',1)->orWhere('role',2)->get();
	    	return view('admin.v_employ_show',compact('arrUser','error'));
    	}
    }
}
