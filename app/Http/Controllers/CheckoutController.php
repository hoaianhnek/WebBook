<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\category;
use App\Http\Requests;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;
use App\customer;
session_start();

class CheckoutController extends Controller
{

//kiểm tra nếu chưa đăng nhập sẽ tự động chuyển sang trang đăng nhập
    public function __construct() {
    $this->middleware('auth');
    }


    

    public function login_checkout(){
     //    $arrType = category::all();
     // return view('layout.v_login',compact('arrType'));
    }

    public function postLogin(Request $request){
    	$rules = [
    		'email' =>'required|email',
    		'password' => 'required|min:4',
    	];
    	$messages = [
    		'email.email' => 'email không đúng định dạng',
    		'email.required' => 'username là trường bắt buộc',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 4 ký tự',
    	];

    	$validator = Validator::make($request->all(), $rules, $messages);

    	if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator)->withInput();
    	} else {
    		$email = $request->input('email');
    		$password = $request->input('password');

    		if( Auth::attempt(['email' => $email, 'password' =>$password])) {
    			return redirect()->intended('/');
    		} else {
    			$errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
    			return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}
    }

    public function add_customer(Request $request){
        $data = array();
        $data['name_Cus'] = $request->name;
        $date['email'] = $request->email;
        $date['password'] = $request->password;


    }
}
