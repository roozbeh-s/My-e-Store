<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Response;
use Session;
use Redirect;

class CartController extends Controller
{
    public function getCart(){

    	$cartItems=Cart::content();
    	return view('cart/shoppingcart',compact('cartItems'));

}

    public function AddToCart(Request $request, $sku){
		
		$product= Product::where('sku','=', $sku)->first();
		$color=$request->input('color');
		$size=$request->input('size');

		$this->validate($request, [
        'size' => 'sometimes|required',
        'color' => 'sometimes|required',],

		$messages = [
		'required' => 'This is required field',
	
		]);


		$cart=Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 
			'options' => ['size' => $size, 'color' => $color, 'image' => $product->thumbnailPath]]);


		return redirect()->back();

	}

	public function removeFromCart($id){

		Cart::remove($id);
		return redirect()->back();


	}


	public function increaseProductQuantity(Request $request, $rowId){

		$qty=$request->input('quantity');
		Cart::update($rowId,$qty);
		return redirect()->back();

	}


	public function updateProductOption(Request $request, $rowId){

		$color=$request->input('color');
		$size=$request->input('size');


		if($size != '' && $color != ''){ 

		$olditem=Cart::get($rowId);

		Cart::update($rowId, ['options' => ['size' => $size, 'color' => $color , 'image' => $olditem->options->image]]);
		Session::flash('message-success', "Product Option Successfully Updated");
		return redirect()->back();}


		else { 

			Session::flash('message-error', "Please Select Product Option ");
			return Redirect::back(); }
	

	}

	public function editoption(Request $request, $rowId){

		$item=Cart::get($rowId);
		$itemId=$item->id;
		$product= Product::where('id','=', $itemId)->first();
		$colorlabel = $product->options()->where('option_name', '=', 'color')->first();
		$sizelabel = $product->options()->where('option_name', '=', 'size')->first();
		$colorvalue= $product->OptionValues()->where('product_options.option_name', '=', 'color')->pluck('value');
		$sizevalue= $product->OptionValues()->where('product_options.option_name', '=', 'size')->pluck('value');

		
		return Response()->json(array('size'=>$sizevalue,'color'=>$colorvalue));
		
	}


}
