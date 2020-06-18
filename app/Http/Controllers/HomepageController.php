<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\book;
use App\discount;
use Illuminate\Database\Eloquent\Collection;
use App\detailorder;
use DB;

class HomepageController extends Controller
{

    public function getHome(){
    $arrType = category::where('status_Category','=','true')->get();
     return view('layout.v_master',compact('arrType'));
    }
    public function getBody($body)
    {
        $arrType = category::where('status_Category','=','true')->get();
        $arrBook = book::where('status_Book','true')->get();
        $arrDiscount = discount::all();
        //y/m/d
        $daynow = new \DateTime();

        //sách văn học
        $literary = book::where('id_Category','VH')->where('status_Book','true')
        ->get();
        foreach ($literary as $l) {
            if(isset($l->id_Discount)){
                $arrLiterary[] = book::join('discount','discount.id_Discount','=','book.id_Discount')
                ->where('id_Book',$l->id_Book)->first();
            }
        }
        //sách tiểu thuyết
        $novel = book::where('id_Category','TT')
        ->get();
        foreach ($novel as $l) {
            if(isset($l->id_Discount)){
                $arrNovel[] = book::join('discount','discount.id_Discount','=','book.id_Discount')
                ->where('id_Book',$l->id_Book)->first();
            }
        }


            $discount = book::join('discount','discount.id_Discount','=','book.id_Discount')
            ->join('detailorder','detailorder.id_Book','=','book.id_Book')
            ->join('category','category.id_Category','=','book.id_Category')
            ->where('status_Category','=','true')
            ->select('detailorder.id_Book',DB::raw('SUM(detailorder.amount_Order) AS sosach'))
            ->where('status_Book','true')
            ->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)
            ->orderBy('sosach','desc')
            ->groupBy('detailorder.id_Book')
            ->limit(4)
            ->get();

            foreach ($discount as $d) {
                $arrBookDiscount[] = book::join('discount','discount.id_Discount','=','book.id_Discount')
                ->where('book.id_Book',$d->id_Book)
                ->first();
            }

            $arrIDBooksell = detailorder::select('id_Book',DB::raw('SUM(amount_Order)'))
            ->groupBy('id_Book')->havingRaw('sum(amount_Order)>1')->get();

            foreach ($arrIDBooksell as $IDBook) {
                $ID=$IDBook->id_Book;
            }

        if($body == 'home')
        {
            if(isset($ID))
            {
                $arrBookBetseller =  book::join('discount','discount.id_Discount','book.id_Discount')
                ->where('id_Book',$ID)->paginate(4);
                return view('layout.v_body_home',compact('arrType','arrBookDiscount','arrBookBetseller','arrLiterary','arrNovel'));
            }
            return view('layout.v_body_home',compact('arrType','arrBookDiscount','arrLiterary','arrNovel'));
        }
        else
        {
            foreach ($arrType as $type)
            {
                if($body == $type->id_Category)
                {
                    $nowDiscount = discount::where('date_start','<=',$daynow)->where('date_end','>=',$daynow)->get();
                    $idDiscount = array();
                    foreach ($nowDiscount as $dis)
                    {
                        $idDiscount[] = $dis->id_Discount;
                    }
                    $arrBookTypeDiscount = book::join('discount','book.id_Discount','=','discount.id_Discount')
                        ->where('status_Book','true')
                        ->where('book.id_Category',$type->id_Category)->whereIn('discount.id_Discount',$idDiscount)->get();

                    if(count($arrBookTypeDiscount))
                    {
                        $id_Book = array();
                        foreach ($arrBookTypeDiscount as $BookDiscount)
                        {
                            $id_Book[]=$BookDiscount->id_Book;
                        }
                        $arrBookTypeNotDiscount = book::where('id_Category',$type->id_Category)->whereNotIn('id_Book',$id_Book)
                        ->where('status_Book','true')
                        ->get();
                        return View('layout.v_categorydiscount',compact('arrType','arrBookTypeDiscount','arrBookTypeNotDiscount'));
                    }
                    $arrBookType = book::where('id_Category', $type->id_Category)
                    ->where('status_Book','true')
                    ->get();
                    return view('layout.v_categorynotdiscount', compact('arrType', 'arrBookType'));
                }
            }
            foreach ($arrBook as $Book)
            {
                if($body == $Book->id_Book)
                {
                    //id_discount now
                    $arrDisnow = discount::where('date_start','<=',$daynow)->where('date_end','>=',$daynow)->get();
                    //check id_book discount  now
                    foreach ($arrDisnow as $arrDisnows) {
                        $idDisnow[] = $arrDisnows->id_Discount;
                    }
                    //check id_book discount  now
                    $arrIDBookDis = book::join('discount','book.id_Discount','=','discount.id_Discount')
                    ->where('book.id_Book',$Book->id_Book)
                    ->whereIn('book.id_Discount',$idDisnow)->get();

                    $arrBookID = book::where('book.id_Book',$Book->id_Book)->get();
                    //check type discount now
                    $arrIDTypeDis = book::join('discount','book.id_Discount','=','discount.id_Discount')
                    ->where('book.id_Category',$Book->id_Category)
                    ->where('status_Book','true')
                    ->whereIn('book.id_Discount',$idDisnow)->get();



                    //book not discount //category not discount
                    if(count($arrIDBookDis)==0)
                    {
                        if(count($arrIDTypeDis)==0)
                        {
                            $arrBookTypeNotDis = book::where('id_Category',$Book->id_Category)
                            ->where('id_Book','<>',$Book->id_Book)->paginate(4);
                            return view('layout.v_detailbooknotdis_notType',compact('arrType','arrBookID','arrBookTypeNotDis'));
                        }//book not dis //category discount
                        else
                        {
                            $arrBookTypee = book::where('book.id_Category',$Book->id_Category)
                            ->where('id_Book','<>',$Book->id_Book)->get();
                            foreach ($arrBookTypee as $book) {
                                if($book->id_Discount){
                                    $arrBookTypeDis[] = book::join('discount','book.id_Discount','=','discount.id_Discount')
                                    ->whereIn('book.id_Discount',$idDisnow)
                                    ->where('id_Book',$book->id_Book)
                                    ->first();
                                }else{
                                    $arrBookTypeNotDiscount[] = book::where('id_Book',$book->id_Book)
                                    ->first();
                                }
                            }

                            return view('layout.v_detailbooknotdis',compact('arrType','arrBookID','arrBookTypeDis','arrBookTypeNotDiscount'));
                        }
                    }
                    else //book discount
                    {       //type not discount
                        if(count($arrIDTypeDis)==0)
                        {

                        }//book discount //type discount
                        else
                        {   //lấy danh sách theo thể loại trừ sách đang hiển thị chi tiếts
                            $arrBookDisTypeDis = book::where('book.id_Book','<>',$Book->id_Book)
                            ->where('book.id_Category',$Book->id_Category)->get();
                            //chạy danh sách sách
                            foreach ($arrBookDisTypeDis as $book) {
                                //lấy sách khuyến mãi
                                if(isset($book->id_Discount)){
                                    $arrBookTypeDis[] = book::join('discount','book.id_Discount','=','discount.id_Discount')
                                    ->whereIn('book.id_Discount',$idDisnow)
                                    ->where('id_Book',$book->id_Book)->first();
                                }else{
                                    $arrBookDisTypeNotDis[] = book::where('id_Book',$book->id_Book)
                                    ->first();
                                }

                            }


                            $arrBooks = book::join('discount','book.id_Discount','=','discount.id_Discount')
                            ->where('book.id_Book',$Book->id_Book)->get();
                            if(isset($arrBookTypeDis))
                            return view('layout.v_detailbook',compact('arrType','arrBooks','arrBookTypeDis','arrBookDisTypeNotDis'));
                            else
                                 return view('layout.v_detailbook',compact('arrType','arrBooks','arrBookDisTypeNotDis'));
                        }
                    }
                }
            }
        }
    }

    public function searchAjax(Request $request){
        if($request->ajax()){
            $output = '';
            // $book = book::join('discount','discount.id_Discount','=','book.id_Discount')
            // ->where('name_Book','LIKE','%'.$request->search.'%')
            // ->get();
            $arrBook = book::where('name_Book','LIKE','%'.$request->search.'%')
                ->get();
            $output .= ' <div class="container-category">
                            <div class="row p-4">
            ';
            foreach ($arrBook as $b) {
                if(isset($b->id_Discount)){
                    $arrBookDis[] = book::join('discount','discount.id_Discount','=','book.id_Discount')
                                ->where('name_Book','LIKE','%'.$request->search.'%')
                                ->where('id_Book',$b->id_Book)
                                ->first();


                }else{
                    $arrBookNotDis[] = book::where('name_Book','LIKE','%'.$request->search.'%')
                                ->where('id_Book',$b->id_Book)
                                ->first();
                }
            }
            if(isset($arrBookDis)){
                foreach ($arrBookDis as $book) {
                    $output .= '
                        <div class="col-sm-3">
                            <div class="text-center container-category-content">
                                <div class="container-category-img p-4">
                                    <a href="master-'.$book->id_Book.'">
                                        <img src="../image/'.$book->image_Book.'" alt="'.$book->name_Book.'" width="190px">
                                        <div class="container-category-discount">-'.$book->number_Discount.'%</div>
                                    </a>
                                </div>
                                <div class="text-centers">
                                    <a href="master-'.$book->id_Book.'" class="text-body text-decoration-none">'.$book->name_Book.'</a>
                                    <div class="container-category-price-entry">'.$book->price_Book.'đ</div>
                                    <span class="container-category-price-present">'.($book->price_Book - $book->price_Book * $book->number_Discount/100).'đ</span>
                                </div>
                            </div>
                        </div>
                    ';
                }

            }
            if(isset($arrBookNotDis)){

                foreach ($arrBookNotDis as $book) {
                    $output .= '
                            <div class="col-sm-3">
                                <div class="text-center container-category-content">
                                    <div class="container-category-img p-4">
                                        <a href="master-'.$book->id_Book.'">
                                            <img src="../image/'.$book->image_Book.'" alt="'.$book->name_Book.'" width="190px">
                                        </a>
                                    </div>
                                    <div class="text-centers">
                                        <a href="master-'.$book->id_Book.'" class="text-body text-decoration-none">'.$book->name_Book.'</a>
                                        <div class="container-category-price-entry-notdiscount">'.$book->price_Book.'đ</div>
                                    </div>
                                </div>
                            </div>
                        ';
                }

            }
        }
        return Response($output);
    }
}
