<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{

    public function filterView(){
        return view('filter',['products'=>$this->topTen ()]);
    }

    public function topTen($start = null,$end = null){
        if (!$start){
            $start = (new Carbon())->now()->subMonth();
            $end = (new Carbon())->now();
        }else{
            $start = new Carbon($start);
            $end = new Carbon($end);
        }

        $orders = Order::whereBetween('purchase_date',[$start,$end])->get();
        $unique_products = array();
        foreach($orders as $order){
             foreach($order->products as $product){
                 if (array_key_exists($product->id,$unique_products)){
                     $unique_products[$product->id]['quantity'] += $product->pivot->quantity;
                 }else{
                     $unique_products[$product->id] = [
                         'id'=>$product->id,
                         'name'=>$product->name,
                         'quantity'=>$product->pivot->quantity
                     ];
                 }
             }
        }
        usort($unique_products,function ($a,$b){
            if ($a['quantity'] == $b['quantity']) return 0;
            return $a['quantity'] < $b['quantity']?1:-1;
//            return $a['quantity'] <=>$b['quantity'];
        });
            return $unique_products;
    }

    public function ajaxTopTen(Request $request){
        return view('products',['products'=>$this->topTen($request->start_date,$request->end_date)]);
    }

}
