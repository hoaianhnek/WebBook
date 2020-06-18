<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;
use App\users;
use Illuminate\Support\Facades\Validator;


class AdminLoginController extends Controller
{
    public function viewLogin()
    {
    	return view('admin.v_login');
    }
    public function viewRegister()
    {
    	return view('admin.v_register');
    }


    public function loginAdmin(Request $request){
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:4'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 4 ký tự',
            
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
        // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
        return redirect('admin/login')->withErrors($validator)->withInput();
        }
        else {
            $adminInfo = array('email' => $request->email, 'password' => $request->password);
            if(Auth::attempt($adminInfo)){
                if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    return redirect('admin/dashboard')->with('thongbao','Đăng nhập thành công');
                else{
                    $loi = "Đăng nhập thất bại!";
                    return view('admin.v_login',compact('loi'));
                }
            }
            else{
                $loi = "Đăng nhập thất bại!";
                    return view('admin.v_login',compact('loi'));
            }
        }
    }

    public function logoutAdmin(){
        Auth::logout();
        return redirect('admin/login');
    }

}
