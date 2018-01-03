<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Product;
use App\Order;
use App\Rating;
use DB;

class ReviewController extends Controller
{
    public function getRatingDetail($product_id,$order_id){

    	$user=Auth::user();
        $order= Order::with('items')->where('id','=', $order_id)->first();
        $rating= Rating::where('user_id', '=', $user->id)->where('product_id','=',$product_id)->first();
        
        if ($order->user_id==$user->id){
        $product=Product::where('id','=',$product_id)->first();
        return view('customer/rateproduct', compact('product','rating'));
    }

    else {

        return redirect()->route('review');
        

    }

}


    public function productRating(Request $request, $product_id){

        $review= new Rating;

        $review->user_id = Auth::user()->id;
        $review->rating = $request->input('star');
        $review->product_id = $product_id;
        $review->title = $request->input('title');
        $review->body = $request->input('review');
        $review->save();


        return redirect()->route('review');


    }

    public function productRatingUpdate(Request $request, $product_id){
        
        $userid = Auth::user()->id;
        $review = Rating::where('user_id', '=', $userid)->where('product_id','=',$product_id)->first();

        $review->rating = $request->input('star');
        $review->title = $request->input('title');
        $review->body = $request->input('review');
        $review->save();

        return redirect()->route('review');


    }

    public function getReview(){


        $user=Auth::user();

        $orders= DB::table('order_items')
        ->select('order_items.id','order_items.created_at','order_items.product_name','order_items.product_id','order_items.thumbnailPath','order_items.order_id','ratings.rating','ratings.title')
        ->leftjoin('ratings','order_items.product_id','=','ratings.product_id')
        ->where('ratings.user_id','=',$user->id)
        ->whereIn('order_items.id',function($query){
        $query-> select(DB::raw('MAX(order_items.id)'))->from('order_items')->where('order_items.user_id','=',Auth::user()->id)->groupby('order_items.product_id');
        })
        ->get();


        return view('customer\review',compact('orders'));
    }

}