<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\category;
use App\User;
use App\customer;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'layout.v_body_home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function index(){
        if(Auth::check()){
            $id_Us = Auth::user()->id;
            $customer = customer::join('users','customer.id_Us','=','users.id')
            ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
            ->where('customer.id_Us',$id_Us)->get();
            $arrType = category::all();
            return view('layout.v_shoppingcart',compact('arrType','customer'));
        }else{
            $arrType = category::all();
            return view('layout.v_login',compact('arrType'));
        }
    }
    public function getLogin() {
        $arrType = category::all();
        return view('layout.v_login',compact('arrType'));
    }

    public function postLogin(Request $request){
        // Kiểm tra dữ liệu nhập vào

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
        return redirect('bookstore/login')->withErrors($validator)->withInput();
        }
        else {

        // Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl

        $adminInfo = array('email' => $request->email, 'password' => $request->password);
        if(Auth::attempt($adminInfo)) {
            // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
            return redirect('bookstore/master-home');
        } else {
            echo $email = $request->input('email');
            print_r($adminInfo);
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
            Session::flash('error', 'Email hoặc mật khẩu không đúng!');
            // return redirect('bookstore/login');
            }
        }
    }

    public function register(Request $request)
{
    $input=$request->all();
    $password=bcrypt($input['password']);
    $data['name'] = $request ->name;
    $data['email'] = $request ->email;
    $data['password'] = bcrypt($input['password']);
    $insert= User::create($data);
    customer::insert([
        'id_Us' => $insert->id
    ]);

    return redirect('bookstore/login');
}

    public function getLogout(){
        Auth::logout();
        $arrType = category::all();
        return view('layout.v_login',compact('arrType'));
    }

    
}
