<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\book;
use App\category;
use DB;
use Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Redirector;

class CartController extends Controller
{

	public function __construct(Request $request) {
    $this->request = $request;
	}

    public function savecart(Request $request){
    	$bookid = $request -> bookid_hidden;
    	$quantity = $request -> quantity;
    	$price = $request -> pricediscount;

    	$bookdetail = book::where('id_Book',$bookid)->get();
    	// Cart::add('293ad', 'Product 1', 1, 9.99);
    	// Cart::destroy(); hủy
    	foreach ($bookdetail as $book) {
	    	$data['id'] = $bookid;
	    	$data['qty'] = $quantity;
	    	$data['name'] = $book ->name_Book;
	    	$data['price'] = $price;
	    	$data['weight'] = '123';
	    	$data['options']['image'] = $book ->image_Book;
	    	$data['options']['author'] = $book ->author_Book;
	    	Cart::add($data);
    	}
    	
    	$arrType = category::all();
		return view('layout.v_shoppingcart',compact('arrType'));

    	// return Redirect::to('bookstore/show-cart');//chuyển sang trang hiển thị
    	
    }
    public function show_cart(){
    	$arrType = category::all();
		return view('layout.v_shoppingcart',compact('arrType'));
    }

    public function deletecart($rowId){
    	Cart::update($rowId,0);

    	$arrType = category::all();
		return view('layout.v_shoppingcart',compact('arrType'));
    }


  //   	if (Request::get('id_Book') && (Request::get('increment')) == 1) {
		// $id = Request::get('id_Book');
		// $item = Cart::search(function ($key, $value) use($id) {
		//    return $key->id == $id;
		// })->first();
  //      	Cart::update($item->rowId, $item->qty+1);
  //   	}
}
