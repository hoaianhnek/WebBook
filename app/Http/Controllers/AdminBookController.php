<?php

namespace App\Http\Controllers;

use App\book;
use DB;
use App\category;
use App\discount;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminBookController extends Controller
{
    public function viewBook(Request $request){
        $arrBoook = book::orderBy('amount_Book','asc')
        ->where('status_Book','true')
        ->get();
        foreach ($arrBoook as $book) {
            if(isset($book->id_Discount)){
                $arrBookDis[] = book::join('category','category.id_Category','=','book.id_Category')->
                join('discount','discount.id_Discount','=','book.id_Discount')
                ->where('id_Book',$book->id_Book)
                ->where('status_Category','true')
                ->first();
            }
            else{
                $arrBook[] = book::join('category','category.id_Category','=','book.id_Category')
                ->where('id_Book',$book->id_Book)
                ->where('status_Category','true')
                ->first();
            }
        }
    	$arrType = category::where('status_Category','true')->get();
    	// $arrBook = book::all();
    	return view('admin.v_book_show',compact('arrBook','arrType','arrBookDis'));
    }

    public function filterbook(Request $request){
    	if(isset($_POST['submit-filter'])){

        $id = $request->type;

        $arrBoook = book::orderBy('amount_Book','asc')->where('id_Category',$id)
            ->where('status_Book','true')
            ->get();

        foreach ($arrBoook as $book) {
            if(isset($book->id_Discount)){
                $arrBookDis[] = book::join('category','category.id_Category','=','book.id_Category')->
                join('discount','discount.id_Discount','=','book.id_Discount')
                ->where('id_Book',$book->id_Book)
                ->where('status_Category','true')
                ->first();
            }
            else{
                $arrBook[] = book::join('category','category.id_Category','=','book.id_Category')
                ->where('id_Book',$book->id_Book)
                ->where('status_Category','true')
                ->first();
            }
        }

    	$arrType = category::where('status_Category','true')->get();
        if(isset($arrBookDis))
    	return view('admin.v_book_show',compact('arrBook','arrType','arrBookDis'));
        else return view('admin.v_book_show',compact('arrBook','arrType'));
        }else{

            $arrBoook = book::orderBy('amount_Book','asc')
            ->where('status_Book','true')
            ->get();

            foreach ($arrBoook as $book) {
                if(isset($book->id_Discount)){
                    $arrBookDis[] = book::join('category','category.id_Category','=','book.id_Category')->
                    join('discount','discount.id_Discount','=','book.id_Discount')
                    ->where('id_Book',$book->id_Book)
                    ->where('status_Category','true')
                    ->first();
                }
                else{
                    $arrBook[] = book::join('category','category.id_Category','=','book.id_Category')
                    ->where('id_Book',$book->id_Book)
                    ->where('status_Category','true')
                    ->first();
                }
            }
        $arrType = category::where('status_Category','true')->get();
            return view('admin.v_book_show',compact('arrBook','arrType','arrBookDis'));
        }
    }

    public function viewaddBook(){
    	$arrType = category::where('status_Category','true')->get();
    	$arrDis = discount::all();
    	return view('admin.v_book_add',compact('arrType','arrDis'));
    }
    public function addBook(Request $request){
    	       
            $rules = [
                'name_Book' => 'required',
                'author' => 'required',
                'image' => 'required',
                'category'=>'required',
                'price' => 'required|numeric|min:1',
                'amount' => 'required|numeric|min:1',
                'nsx' => 'required',
                'describe' => 'required'
            ];
            $messages = [
                'name_Book.required' => 'Tên sách không được để trống',
                'author.required' => 'Tác giả không được để trống',
                'image.required' => 'Vui lòng chọn hình',
                'category.required' => 'Vui lòng chọn thể loại',
                'price.required' => 'Giá không được để trống',
                'price.numeric' => 'Giá là trường nhập số',
                'price.min' => 'Giá phải lớn hơn 0',
                'amount.required' => 'Số lượng không được để trống',
                'amount.numeric' => 'Số lượng là trường nhập số',
                'amount.min' => 'Số lượng nhỏ phải lớn hơn 0',
                'nsx.required' => 'Nhà sản xuất không được để trống',
                'describe.required' => 'Mô tả không được để trống'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
            // Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
                return redirect('admin/add-book')->withErrors($validator)->withInput();
            }else{
                if(isset($request->discount)){
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
                    $data['status_Book'] = 'true';
    	    	    DB::table('book')->insert($data);
                }
                else{
                    $data = array();
                    $data['name_Book'] = $request->name_Book;
                    $data['image_Book'] = $request->image;
                    $data['describe_Book'] = $request->describe;
                    $data['author_Book'] = $request->author;
                    $data['id_Category'] = $request->category;
                    $data['price_Book'] = $request->price;
                    $data['amount_Book'] = $request->amount;
                    $data['publishing_Book'] = $request->nsx;
                    $data['status_Book'] = 'true';
                    DB::table('book')->insert($data);
                }
    			$arrBoook = book::orderBy('amount_Book','asc')->where('status_Book','true')
                ->get();
                foreach ($arrBoook as $book) {
                    if(isset($book->id_Discount)){
                        $arrBookDis[] = book::join('category','category.id_Category','=','book.id_Category')->
                        join('discount','discount.id_Discount','=','book.id_Discount')
                        ->where('id_Book',$book->id_Book)
                        ->where('status_Category','true')
                        ->first();
                    }
                    else{
                        $arrBook[] = book::join('category','category.id_Category','=','book.id_Category')
                        ->where('id_Book',$book->id_Book)
                        ->where('status_Category','true')
                        ->first();
                    }
                }
    	    	$arrType = category::where('status_Category','true')->get();
    	    	return view('admin.v_book_show',compact('arrBook','arrType','arrBookDis'));
	       }
    }
    public function deleteBook($bookid){

    		book::where('id_Book',$bookid)->update([
                'status_Book' => 'false'
            ]);
    		$message = "Success deleted";
    		echo "<script type='text/javascript'>alert('$message');</script>";

            $arrBoook = book::orderBy('amount_Book','asc')
            ->where('status_Book','true')
            ->get();
            foreach ($arrBoook as $book) {
                if(isset($book->id_Discount)){
                    $arrBookDis[] = book::join('category','category.id_Category','=','book.id_Category')->
                    join('discount','discount.id_Discount','=','book.id_Discount')
                    ->where('id_Book',$book->id_Book)
                    ->where('status_Category','true')
                    ->first();
                }
                else{
                    $arrBook[] = book::join('category','category.id_Category','=','book.id_Category')
                    ->where('id_Book',$book->id_Book)
                    ->where('status_Category','true')
                    ->first();
                }
            }

	    	$arrType = category::where('status_Category','true')->get();
	    	return view('admin.v_book_show',compact('arrBook','arrType','arrBookDis'));
    }

    public function showupdateBook($bookid){

            $bookk = book::join('category','category.id_Category','=','book.id_Category')
            ->where('book.id_Book',$bookid)->first();
            if(isset($bookk->id_Discount)){
                $book = book::join('category','category.id_Category','=','book.id_Category')
                ->join('discount','discount.id_Discount','=','book.id_Discount')
                ->where('book.id_Book',$bookid)
                ->get();
                $idDis = book::where('book.id_Book',$bookid)->first();
                $arrDis = discount::whereNotIn('id_Discount',$idDis)->get();
        }else{
                $book = book::join('category','category.id_Category','=','book.id_Category')
                ->where('book.id_Book',$bookid)->get();
                $arrDis = discount::all();
        }
    		
        		$booktype = book::where('book.id_Book',$bookid)->select('id_Category')
                ->first();

    		      $arrType = category::whereNotIn('id_Category',$booktype)
                  ->where('status_Category','true')->get();
    		
	    	
	    	return view('admin.v_book_edit',compact('book','arrType','arrDis'));

    }
    public function updateBook(Request $request,$idBook){
    	if($request->image != null){
            if($request->discount != null){
        		book::where('id_Book',$idBook)->update(
        			[
        				'name_Book' => $request->name_Book,
        				'image_Book' => $request->image,
        				'author_Book' => $request->author,
        				'id_Category' => $request->category,
        				'id_Discount' => $request->discount,
        				'price_Book' => $request->price,
        				'describe_Book' => $request->describe,
        				'publishing_Book' => $request->nsx
        			]);
            }else{
                book::where('id_Book',$idBook)->update(
                    [
                        'name_Book' => $request->name_Book,
                        'image_Book' => $request->image,
                        'author_Book' => $request->author,
                        'id_Category' => $request->category,
                        'price_Book' => $request->price,
                        'describe_Book' => $request->describe,
                        'publishing_Book' => $request->nsx
                    ]);
            }
    	}else{
            if($request->discount != null){
                book::where('id_Book',$idBook)->update(
                    [
                        'name_Book' => $request->name_Book,
                        'author_Book' => $request->author,
                        'id_Category' => $request->category,
                        'price_Book' => $request->price,
                        'id_Discount' => $request->discount,
                        'describe_Book' => $request->describe,
                        'publishing_Book' => $request->nsx
                    ]);
            }else{
                book::where('id_Book',$idBook)->update(
                    [
                        'name_Book' => $request->name_Book,
                        'author_Book' => $request->author,
                        'id_Category' => $request->category,
                        'price_Book' => $request->price,
                        'describe_Book' => $request->describe,
                        'publishing_Book' => $request->nsx
                    ]);
            }
        }

        $arrBoook = book::orderBy('amount_Book','asc')
        ->where('status_Book','true')
        ->get();
        foreach ($arrBoook as $book) {
            if(isset($book->id_Discount)){
                $arrBookDis[] = book::join('category','category.id_Category','=','book.id_Category')->
                join('discount','discount.id_Discount','=','book.id_Discount')
                ->where('id_Book',$book->id_Book)
                ->where('status_Category','true')
                ->first();
            }
            else{
                $arrBook[] = book::join('category','category.id_Category','=','book.id_Category')
                ->where('id_Book',$book->id_Book)
                ->where('status_Category','true')
                ->first();
            }
        }
	    	$arrType = category::where('status_Category','true')->get();
	    	return view('admin.v_book_show',compact('arrBook','arrType','arrBookDis'));

    }

    public function loadBookAjax(Request $request){
        if($request->ajax()){
            $output = '';
            $book = book::where('name_Book','LIKE','%'.$request->search.'%')
            ->where('status_Book','true')
            ->get();
            if($book){
                foreach ($book as $b) {
                    if(isset($b->id_Discount)){
                        $arrBookDis[] = book::join('category','category.id_Category','=','book.id_Category')
                        ->join('discount','discount.id_Discount','=','book.id_Discount')
                        ->where('id_Book',$b->id_Book)
                        ->first();
                    }else{
                        $arrBook[] = book::join('category','category.id_Category','=','book.id_Category')
                        ->where('id_Book',$b->id_Book)
                        ->first();
                    }
                }
            }
        }
            if(isset($arrBookDis)){
            foreach ($arrBookDis as $book) {
                $output .= '
                    <tr>
                        <td>'.$book->id_Book.'</td>
                        <td>
                            <span class="text-ellipsis">'.$book->name_Book.'</span>
                        </td>
                        <td>
                            <img src="../../public/image/'.$book->image_Book.'" style="width: 100px;height: 140px">
                        </td>
                        <td class="text-ellipsis">
                          <div style="overflow-y: scroll; height: 175px">
                            '.$book->describe_Book.'
                          </div>
                        </td>
                        <td>
                            <span class="text-ellipsis">'.$book->author_Book.'</span>
                        </td>
                        <td>
                            <span class="text-ellipsis">'.$book->name_Category.'</span>
                        </td>
                        <td>
                            <span>'.$book->price_Book.'</span>
                        </td>
                        <td>
                            <span>'.$book->amount_Book.'</span>
                        </td>
                        <td>
                            '.$book->name_Discount.'
                        </td>
                        <td>'.$book->publishing_Book.'</td>
                        <td>
                            <a href="update-'.$book->id_Book.'" class="active" ui-toggle-class="">
                              <i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a href="delete-'.$book->id_Book.'" class="active" ui-toggle-class="">
                              <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                      </tr>
                      ';
            }}
            if(isset($arrBook)){
            foreach ($arrBook as $Book) {
                $output .='
                <tr>
                        <td>'.$Book->id_Book.'</td>
                        <td>
                            <span class="text-ellipsis">'.$Book->name_Book.'</span>
                        </td>
                        <td>
                            <img src="../../public/image/'.$Book->image_Book.'" style="width: 100px;height: 140px">
                        </td>
                        <td class="text-ellipsis">
                          <div style="overflow-y: scroll; height: 175px">
                                '.$Book->describe_Book.'
                          </div>
                        </td>
                        <td>
                            <span class="text-ellipsis">'.$Book->author_Book.'</span>
                        </td>
                        <td>
                            <span class="text-ellipsis">'.$Book->name_Category.'</span>
                        </td>
                        <td>
                            <span>'.$Book->price_Book.'</span>
                        </td>
                        <td>
                            <span>'.$Book->amount_Book.'</span>
                        </td>
                        
                        <td>
                        </td>
                        <td>'.$Book->publishing_Book.'</td>
                        <td>
                            <a href="update-'.$Book->id_Book.'" class="active" ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a>
                            <a href="delete-'.$Book->id_Book.'" class="active" ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                            d
                        </td>
                        </tr>
                ';
            }}
        return Response($output);
    }
}
