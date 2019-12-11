<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\book;
use App\category;
use DB;
use Cart;
use App\shipping_charges;
use App\customer;
use App\users;
use App\order;
use App\detailorder;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class CartController extends Controller
{

	public function __construct(Request $request) {
    $this->request = $request;
	}

    public function savecart(Request $request){
    	$bookid = $request -> bookid_hidden;
    	// $quantity = $request -> quantity;
    	$price = $request -> pricediscount;

    	$bookdetail = book::where('id_Book',$bookid)->get();
        $id_Us = Auth::user()->id;
        $customer = customer::join('users','customer.id_Us','=','users.id')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->where('customer.id_Us',$id_Us)->get();
    	// Cart::add('293ad', 'Product 1', 1, 9.99);
    	// Cart::destroy(); hủy
        if(!$request -> quantity){
            foreach ($bookdetail as $book) {
            $data['id'] = $bookid;
            $data['qty'] = '1';
            $data['name'] = $book ->name_Book;
            $data['price'] = $price;
            $data['weight'] = '123';
            $data['options']['image'] = $book ->image_Book;
            $data['options']['author'] = $book ->author_Book;
            Cart::add($data);
        }
        }else{
    	foreach ($bookdetail as $book) {
	    	$data['id'] = $bookid;
	    	$data['qty'] = $request -> quantity;
	    	$data['name'] = $book ->name_Book;
	    	$data['price'] = $price;
	    	$data['weight'] = "123";
	    	$data['options']['image'] = $book ->image_Book;
	    	$data['options']['author'] = $book ->author_Book;
	    	Cart::add($data);
    	}
    	

    	$arrType = category::all();
		return view('layout.v_shoppingcart',compact('arrType','customer'));

    	// return Redirect::to('bookstore/show-cart');//chuyển sang trang hiển thị
    	
    }
}
    public function show_cart(){
        $arrType = category::all();
        if(Auth::check())
        {
        $id_Us = Auth::user()->id;
        $cus = customer::join('users','customer.id_Us','=','users.id')
        ->where('customer.id_Us',$id_Us)->first();
        if($cus->id_Ship != null){
            $customer = customer::join('users','customer.id_Us','=','users.id')
            ->join('shipping_charges','customer.id_Ship','=','shipping_charges.id_ship')
            ->where('customer.id_Us',$id_Us)
            ->get();
        }else{
            $customer = customer::join('users','customer.id_Us','=','users.id')
            ->where('customer.id_Us',$id_Us)->get();
        }
    	
		return view('layout.v_shoppingcart',compact('arrType','customer'));
        }else{
            $logincart = 'Hãy đăng nhập để xem giỏ hàng!';
            return redirect('bookstore/login')->with('logincart',$logincart);
        }
    }

    public function deletecart($rowId){
    	Cart::update($rowId,0);
        $id_Us = Auth::user()->id;
        $customer = customer::join('users','customer.id_Us','=','users.id')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->where('customer.id_Us',$id_Us)->get();
        
    	$arrType = category::all();
		return view('layout.v_shoppingcart',compact('arrType','customer'));
    }
    public function checkout(){
        $arrType = category::all();
        $id_Us = Auth::user()->id;
        $cus = customer::join('users','customer.id_Us','=','users.id')
        ->where('customer.id_Us',$id_Us)->first();
        if($cus->id_Ship != null){
            $customer = customer::join('users','customer.id_Us','=','users.id')
            ->join('shipping_charges','customer.id_Ship','=','shipping_charges.id_ship')
            ->where('customer.id_Us',$id_Us)
            ->get();
        }else{
            $customer = customer::join('users','customer.id_Us','=','users.id')
            ->where('customer.id_Us',$id_Us)->get();
        }
        $arrShip = shipping_charges::all();
        $arrCart = Cart::content();
        return view('layout.v_checkout',compact('arrType','arrCart','customer','arrShip'));
    }

    public function ship(Request $request){
        if($request->ajax()){
            $output ='';
            $ship = shipping_charges::where('id_ship',$request->ship)->get();
            foreach($ship as $s){
                $output.=$s->charges;
            }
        }
        return Response($output);
    }

    public function postCheckout(Request $request,$cusID){
            customer::where('id_Cus',$cusID)->update([
                'phone_Cus' => $request->customer_phone,
                'add_Cus' => $request->customer_address,
                'id_Ship' => $request->customer_province
            ]);
            users::join('customer','customer.id_Us','=','users.id')
            ->where('id_Cus',$cusID)->update([
                'email' => $request->customer_email
            ]);
            $cart = Cart::content();
            $daynow = new \DateTime();

            order::insert([
                'id_Cus' => $cusID,
                'date_purchase' => $daynow,
                'status' => 'Chưa giao'
            ]);

            $order = order::all()->last();

            foreach($cart as $c){
            detailorder::insert([
                'id_Order' => $order->id_Order,
                'id_Book' => $c->id,
                'amount_Order' => $c->qty
            ]);
            
        }
        Cart::destroy();
        $arrType = category::all();
            return view('layout.v_alert_success',compact('arrType'));
    }
}
