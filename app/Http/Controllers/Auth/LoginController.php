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
use App\book;
use App\discount;
use App\users;
use Cart;
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
    
    public function index($idBook){
        if(Auth::check()){
            $book = book::where('id_Book',$idBook)->first();
            if($book->id_Discount != NULL)
            {   
                $BookDis = book::where('id_Book',$idBook)
                ->join('discount','discount.id_Discount','=','book.id_Discount')
                ->first();
                $arrType = category::all();
                $data['id'] = $idBook;
                $data['qty'] = '1';
                $data['name'] = $BookDis->name_Book;
                $data['price'] = $BookDis->price_Book - $BookDis->price_Book*$BookDis->number_Discount/100;
                $data['weight'] = '123';
                $data['options']['image'] = $BookDis ->image_Book;
                $data['options']['author'] = $BookDis ->author_Book;
                Cart::add($data);
                $arrType = category::all();
                $addCart = 'Sách đã được thêm vào giỏ hàng';
                return redirect('bookstore/master-home')->with('addCart',$addCart);
            }else{
                $BookDis = book::where('id_Book',$idBook)
                ->first();
                $arrType = category::all();
                $data['id'] = $idBook;
                $data['qty'] = '1';
                $data['name'] = $BookDis->name_Book;
                $data['price'] = $BookDis->price_Book;
                $data['weight'] = '123';
                $data['options']['image'] = $BookDis ->image_Book;
                $data['options']['author'] = $BookDis ->author_Book;
                Cart::add($data);
                $arrType = category::all();
                $addCart = 'Sách đã được thêm vào giỏ hàng';
                return redirect('bookstore/master-home')->with('addCart',$addCart);
            }

        }else{
            $arrType = category::all();
            $cartlogin = 'Đăng nhập để mua sách!';
            return view('layout.v_login',compact('arrType','cartlogin'));
        }
    }
    public function getLogin() {
        $arrType = category::all();
        return view('layout.v_login',compact('arrType'));
    }

    public function postLogin(Request $request){
        // Kiểm tra dữ liệu nhập vào

        $rules = [
            'email1' =>'required|email',
            'password' => 'required|min:4'
        ];
        $messages = [
            'email1.required' => 'Email là trường bắt buộc',
            'email1.email' => 'Email không đúng định dạng',
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

        $adminInfo = array('email' => $request->email1, 'password' => $request->password);
        if(Auth::attempt($adminInfo)) {
            // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
            return redirect('bookstore/master-home');
        } else {
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
            $loi = 'Email hoặc mật khẩu không đúng!';
            $arrType = category::where('status_Category','=','true')->get();
            return view('layout.v_login',compact('arrType','loi'));
            }
        }
    }

    public function register(Request $request)
{
    $rules = [
            'name1' =>'required',
            'email' => 'required|email|unique:users',
            'password1' => 'required|min:4'
        ];
        $messages = [
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password1.required' => 'Mật khẩu là trường bắt buộc',
            'password1.min' => 'Mật khẩu phải chứa ít nhất 4 ký tự',
            'name1.required' => 'Họ tên không được để trống',
            'email.unique' => 'Email đã tồn tại',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
        // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
        return redirect('bookstore/login')->withErrors($validator)->withInput();
        }else {

        $input=$request->all();
        $password=bcrypt($input['password1']);
        $data['name'] = $request ->name1;
        $data['email'] = $request ->email;
        $data['password'] = bcrypt($input['password1']);
        $insert= User::create($data);
        customer::insert([
            'id_Us' => $insert->id,
            'status_Customer' => 'true'
        ]);
        users::where('id',$insert->id)->update([
            'role' => 3
        ]);
        $arrType = category::where('status_Category','=','true')->get();
        $thongbao = 'Bạn đã đăng ký thành công!';
        return view('layout.v_login',compact('arrType','thongbao'));
        
        }
    
}

    public function getLogout(){
        Auth::logout();
        $arrType = category::all();
        return view('layout.v_login',compact('arrType'));
    }

    
}
