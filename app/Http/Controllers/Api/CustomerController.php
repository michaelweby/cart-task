<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 23/2/2019
 * Time: 0:55
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;

class CustomerController extends Controller
{
    public function customersWhoOrdered(){
        $users =  User::has('orders')->get();
        $response['data'] = array();
        foreach ($users as $user){
            $unique_products = array();
            foreach ($user->orders as $order){
                foreach ($order->products as $product){
                    $unique_products[$product->id] = ['id'=>$product->id, 'name'=> $product->name];
                }
            }
            array_push($response['data'],[
                'id'=>$user->id,
                'name'=>$user->name,
                'products'=>array_values($unique_products)
            ]);
        }
        return response()->json($response);

    }
}
