<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\OrderStatus;


class OrderController extends Controller
{
    
    public function getOrders(){

    	$user=Auth::user();
        $status=OrderStatus::all()->pluck('label','code');
        $orders= Order::with('items')->where('user_id','=', $user->id)->paginate(5);    	
    	return view('customer/orders', compact('orders','status'));
 	
    }

    public function searchOrder(Request $request){

        $user=Auth::user();
        $status=OrderStatus::all()->pluck('label','code');
        $orders= Order::with('items')->where('user_id','=', $user->id)->where('status','=', $request->status)->paginate(5);

    
        return view('customer/orders', compact('orders','status'));

    }


    public function getOrderDetail($id){

        $user=Auth::user();
        $order= Order::with('items')->where('id','=', $id)->first();
        
        if ($order->user_id==$user->id){
        return view('customer/orderdetail', compact('order'));
    }

    else {
        
        $user=Auth::user();
        $orders= Order::with('items')->where('user_id','=', $user->id)->get();      
        return redirect()->route('orders',['orders' => $orders]);
    }

    }

}
