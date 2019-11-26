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
    $arrType = category::all();
     return view('layout.v_master',compact('arrType'));
    }
    public function getBody($body)
    {
        $arrType = category::all();
        $arrBook = book::all();
        $arrDiscount = discount::all();
        //y/m/d
        $daynow = new \DateTime();

            $arrBookDiscount = book::join('discount','discount.id_Discount','=','book.id_Discount')->where('date_start','<=',$daynow)->where('date_end','>=',$daynow)->paginate(4);
            $arrIDBooksell = detailorder::select('id_Book',DB::raw('SUM(amount_Order)'))
            ->groupBy('id_Book')->havingRaw('sum(amount_Order)>1')->get();

            foreach ($arrIDBooksell as $IDBook) {
                $ID[]=$IDBook->id_Book;
            }
            $arrBookBetseller =  book::join('discount','discount.id_Discount','book.id_Discount')
            ->where('id_Book',$ID)->paginate(4);
        if($body == 'home')
        {
            return view('layout.v_body_home',compact('arrType','arrBookDiscount','arrBookBetseller'));
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
                        ->where('book.id_Category',$type->id_Category)->whereIn('discount.id_Discount',$idDiscount)->get();

                    if(count($arrBookTypeDiscount))
                    {
                        $id_Book = array();
                        foreach ($arrBookTypeDiscount as $BookDiscount) 
                        {
                            $id_Book[]=$BookDiscount->id_Book;
                        }
                        $arrBookTypeNotDiscount = book::where('id_Category',$type->id_Category)->whereNotIn('id_Book',$id_Book)
                        ->get();
                        return View('layout.v_categorydiscount',compact('arrType','arrBookTypeDiscount','arrBookTypeNotDiscount'));
                    }
                    $arrBookType = book::where('id_Category', $type->id_Category)->get();
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
                    ->whereIn('book.id_Discount',$idDisnow)->get();



                    //book not discount
                    if(count($arrIDBookDis)==0)
                    {
                        if(count($arrIDTypeDis)==0)
                        {
                            $arrBookTypeNotDis = book::where('id_Category',$Book->id_Category)
                            ->where('id_Book','<>',$Book->id_Book)->paginate(4);
                            return view('layout.v_detailbooknotdis_notType',compact('arrType','arrBookID','arrBookTypeNotDis'));
                        }
                        else
                        {
                            $arrBookTypeDis = book::join('discount','book.id_Discount','=','discount.id_Discount')
                            ->where('book.id_Category',$Book->id_Category)->where('id_Book','<>',$Book->id_Book)
                            ->whereIn('book.id_Discount',$idDisnow)->paginate(4);
                            
                            return view('layout.v_detailbooknotdis',compact('arrType','arrBookID','arrBookTypeDis'));
                        }
                    }
                    else //book discount
                    {       //type not discount
                        if(count($arrIDTypeDis)==0)
                        {}
                        else
                        {
                            $arrBookTypeDis = book::join('discount','book.id_Discount','=','discount.id_Discount')
                            ->where('book.id_Book','<>',$Book->id_Book)
                            ->where('book.id_Category',$Book->id_Category)
                            ->whereIn('book.id_Discount',$idDisnow)->paginate(4);
                            $arrBooks = book::join('discount','book.id_Discount','=','discount.id_Discount')
                            ->where('book.id_Book',$Book->id_Book)->get();

                            return view('layout.v_detailbook',compact('arrType','arrBooks','arrBookTypeDis'));
                        }
                    }
                }
            }
        }
    }
}
