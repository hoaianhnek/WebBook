<?php

namespace App\Http\Controllers;

use App\book;
use DB;
use App\category;
use App\discount;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function viewBook(){
        $arrBoook = book::all();
        foreach ($arrBoook as $book) {
            if(isset($book->id_Discount)){
                $arrBook = book::join('category','category.id_Category','=','book.id_Category')->
                join('discount','discount.id_Discount','=','book.id_Discount')->paginate(10);
            }
            else{
                $arrBook = book::join('category','category.id_Category','=','book.id_Category')
                ->paginate(10);
            }
        }
    	
    	$arrType = category::all();
    	// $arrBook = book::all();
    	return view('admin.v_book_show',compact('arrBook','arrType'));
    }

    public function filterbook(Request $request){
    	$id = $request->type;
    	$arrBook = book::join('category','category.id_Category','=','book.id_Category')->
    	join('discount','discount.id_Discount','=','book.id_Discount')
    	->where('category.id_Category',$id)
    	->paginate(10);
    	$arrType = category::all();

    	return view('admin.v_book_show',compact('arrBook','arrType'));
    }

    public function viewaddBook(){
    	$arrType = category::all();
    	$arrDis = discount::all();
    	return view('admin.v_book_add',compact('arrType','arrDis'));
    }
    public function addBook(Request $request){
    	
    		$data = array();
	    	$data['name_Book'] = $request->name_Book;
	    	$data['image_Book'] = $request->image;
	    	$data['describe_Book'] = $request->describe;
	    	$data['author_Book'] = $request->author;
	    	$data['id_Category'] = $request->category;
	    	$data['price_Book'] = $request->price;
	    	$data['amount_Book'] = $request->amount;
	    	$data['id_Discount'] = $request->discount;
	    	$data['publishing_Book'] = $request->nsx;
	    	DB::table('book')->insert($data);
			$arrBook = book::join('category','category.id_Category','=','book.id_Category')->
    		join('discount','discount.id_Discount','=','book.id_Discount')->paginate(10);
	    	$arrType = category::all();
	    	return view('admin.v_book_show',compact('arrBook','arrType'));
	
    }
    public function deleteBook($bookid){

    		book::where('id_Book',$bookid)->delete();
    		$message = "Success deleted";
    		echo "<script type='text/javascript'>alert('$message');</script>";

    		$arrBook = book::join('category','category.id_Category','=','book.id_Category')->
    			join('discount','discount.id_Discount','=','book.id_Discount')->paginate(10);

	    	$arrType = category::all();
	    	return view('admin.v_book_show',compact('arrBook','arrType'));
    }

    public function showupdateBook($bookid){
            $bookk = book::join('category','category.id_Category','=','book.id_Category')
            ->where('book.id_Book',$bookid)->first();
            if(isset($book->id_Discount)){
                $book = book::join('category','category.id_Category','=','book.id_Category')->
            join('discount','discount.id_Discount','=','book.id_Discount')
            ->where('book.id_Book',$bookid)
            ->get();
            $bookdis = book::where('book.id_Book',$bookid)->select('id_Discount')
            ->get();
            $arrDis = discount::whereNotIn('id_Discount',$bookdis)->get();
        }else{
            $book = book::join('category','category.id_Category','=','book.id_Category')
            ->where('book.id_Book',$bookid)->get();
            $arrDis = discount::all();
        }
    		

    		$booktype = book::where('book.id_Book',$bookid)->select('id_Category')
    		->get();

    		$arrType = category::whereNotIn('id_Category',$booktype)->get();
    		
	    	
	    	return view('admin.v_book_edit',compact('book','arrType','arrDis'));

    }
    public function updateBook(Request $request,$idBook){
    	if($request->image != null){
    		book::where('id_Book',$idBook)->update(
    			[
    				'name_Book' => $request->name_Book,
    				'image_Book' => $request->image,
    				'author_Book' => $request->author,
    				'id_Category' => $request->category,
    				'id_Discount' => $request->discount,
    				'price_Book' => $request->price,
    				'amount_Book' => $request->amount,
    				'describe_Book' => $request->describe,
    				'publishing_Book' => $request->nsx
    			]);
    	}else{
            book::where('id_Book',$idBook)->update(
                [
                    'name_Book' => $request->name_Book,
                    'author_Book' => $request->author,
                    'id_Category' => $request->category,
                    'id_Discount' => $request->discount,
                    'price_Book' => $request->price,
                    'amount_Book' => $request->amount,
                    'describe_Book' => $request->describe,
                    'publishing_Book' => $request->nsx
                ]);
        }
        $arrBoook = book::all();
        foreach ($arrBoook as $book) {
            if(isset($book->id_Discount)){
                $arrBook = book::join('category','category.id_Category','=','book.id_Category')->
                join('discount','discount.id_Discount','=','book.id_Discount')->paginate(10);
            }
            else{
                $arrBook = book::join('category','category.id_Category','=','book.id_Category')
                ->paginate(10);
            }
        }

	    	$arrType = category::all();
	    	return view('admin.v_book_show',compact('arrBook','arrType'));

    }
}
