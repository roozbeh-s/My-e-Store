<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\Address;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Order;
use App\OrderAddress;
use App\OrderItem;
use Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Input;


class CheckoutController extends Controller
{
   	public function getCheckout(){

      if(Cart::count() > 0){

      $receivername=Auth::user()->name;
      $address= Auth::user()->address;
      $state= Auth::user()->address->province;
   		$selectcountry=Country::all()->pluck('name','iso2');
   		$selectstate=State::all()->pluck('name','code');
      $country= Auth::user()->address->nation;
      $cartItems=Cart::content();


		return view('checkout/deliveryinformation',compact('selectcountry','selectstate','address','receivername','country','state','cartItems','city'));

  }

  else { return redirect()->route('product');}

	}


	public function addNewShippingAddress(Request $request){


    if($request->input('checkbox_new_shipping_address')) {


		$this->validate($request, [
        'addr_first_line' => 'required',
        'addr_second_line' => 'required',
        'city' => 'required',
        'state' => 'required',
        'postcode' => 'required',
        'country' => 'required',


        ],

        $messages = [
        'required' => 'This is required field',
        ]);


    $request->session()->put([
      'receivername'=>$request->input('name'),
      'addr_first_line'=> $request->input('addr_first_line'),
      'addr_second_line'=> $request->input('addr_second_line'),
      'city'=> $request->input('city'),
      'state'=> $request->input('state'),
      'postcode'=> $request->input('postcode'),
      'country'=> $request->input('country')
      ]);


 
    return redirect()->route('paymentinfo');
  }

     else {

    $request->session()->put([
      'receivername'=>Auth::user()->name,
      'addr_first_line'=> Auth::user()->address->addr_first_line,
      'addr_second_line'=> Auth::user()->address->addr_second_line,
      'city'=> Auth::user()->address->city,
      'state'=> Auth::user()->address->province->code,
      'postcode'=> Auth::user()->address->postcode,
      'country'=> Auth::user()->address->nation->iso2
      ]);


    return redirect()->route('paymentinfo');

     
     }

	}


  public function paymentInfo(Request $request){

    $receivername=$request->session()->get('receivername');
    $addr_first_line=$request->session()->get('addr_first_line');
    $addr_second_line=$request->session()->get('addr_second_line');
    $city=$request->session()->get('city');
    $state=$request->session()->get('state');
    $postcode=$request->session()->get('postcode');
    $country=$request->session()->get('country');

    $state_name=State::where('code','=', $state)->first();
    $country_name=Country::where('iso2','=', $country)->first();
    $cartItems=Cart::content();



    return view('checkout/paymentinformation',compact('receivername','addr_first_line','addr_second_line','city','state_name','postcode','country_name','cartItems'));
  }


  public function createOrder(Request $request){



    $order = new Order;
    $orderaddress= new OrderAddress;
    

    $order->user_id = Auth::user()->id;
    $order->total = Cart::total();
    $order->subtotal = Cart::subtotal();
    $order->shipping_fee = 0;
    $order->tax=Cart::tax();
    $order->status='New';
    $order->payment_method = $request->get('radio-payment-options');
    $order->save();

    $orderaddress->order_id = $order->id;
    $orderaddress->user_id = Auth::user()->id;
    $orderaddress->receiver = session()->get('receivername');
    $orderaddress->addr_first_line = session()->get('addr_first_line');
    $orderaddress->addr_second_line = session()->get('addr_second_line');
    $orderaddress->city = session()->get('city');
    $orderaddress->state = session()->get('state');
    $orderaddress->postcode = session()->get('postcode');
    $orderaddress->country = session()->get('country');
    $orderaddress->save();

    $cartItems=Cart::content();


    foreach($cartItems as $cartItem){

    $orderitem = new OrderItem;
    $orderitem->order_id = $order->id;
    $orderitem->user_id = Auth::user()->id;
    $orderitem->product_id = $cartItem->id;
    $orderitem->product_name = $cartItem->name;
    $orderitem->product_price = $cartItem->price;
    $orderitem->qty = $cartItem->qty;
    $orderitem->thumbnailPath = $cartItem->options->image;
    $orderitem->product_options = $cartItem->options;
    $orderitem->save();

    }

    Mail::to(Auth::user()->email)->send(new OrderConfirmation($order, $orderaddress));

    $request->session()->forget('cart');

    return redirect()->route('orders')->with('order-success', 'Successfully purchased product');


  }

}
