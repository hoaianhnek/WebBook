<?php

namespace App\Http\Controllers;

use Request;
use Cart;
use App\category;

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
		
		$arrType = category::all();
		return view('layout.v_shoppingcart',compact('arrType'));
   
    }
}
