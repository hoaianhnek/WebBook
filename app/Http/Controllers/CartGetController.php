<?php

namespace App\Http\Controllers;

use Request;
use Cart;
use App\category;
use App\customer;
use Illuminate\Support\Facades\Auth;

class CartGetController extends Controller
{
    public function getQtyCart(){
    	if (Request::get('id_Book') && (Request::get('increment')) == 1) {
		$id = Request::get('id_Book');
		$book = Cart::search(function ($key, $value) use($id) {
		   return $key->id == $id;
		})->first();
       	Cart::update($book->rowId, $book->qty+1);
    } 

    	if (Request::get('id_Book') && (Request::get('decrease')) == 1) {
        $id = Request::get('id_Book');
		$book = Cart::search(function ($key, $value) use($id) {
		   return $key->id == $id;
		})->first();
       	Cart::update($book->rowId, $book->qty-1);
       	}

       	$cart = Cart::content();
        $this->data['cart'] = $cart;
		
    $id_Us = Auth::user()->id;
        $customer = customer::join('users','customer.id_Us','=','users.id')
        ->join('shipping_charges','shipping_charges.id_ship','=','customer.id_Ship')
        ->where('customer.id_Us',$id_Us)->get();
		$arrType = category::where('status_Category','=','true')->get();
		return view('layout.v_shoppingcart',compact('arrType','customer'));
   
    }
}
