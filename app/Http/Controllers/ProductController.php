<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_option;
use App\Product_options_value;
use Session;
use App\SearchLog;
use Auth;
use App\Category;
use DB;



class ProductController extends Controller
{
    
    	public function getProduct() {

    	$products=Product::where('status',1)->paginate(4);

    	return view('product/index', compact('products'));



	}


	public function getProductDetail($sku) {

		$product= Product::where('sku','=', $sku)->first();
		$colorlabel = $product->options()->where('option_name', '=', 'color')->first();
		$sizelabel = $product->options()->where('option_name', '=', 'size')->first();
		$colorvalue= $product->OptionValues()->where('product_options.option_name', '=', 'color')->pluck('value','value');
		$sizevalue= $product->OptionValues()->where('product_options.option_name', '=', 'size')->pluck('value','value');

	
		return view('productdetail/productinfo', compact('product','colorlabel','colorvalue','sizelabel','sizevalue'));


	}


	public function ProductSearch(Request $request){

		$q=$request->input('q');
		$log = new SearchLog();
		$log->ip= \Request::ip();
		if(Auth::user()){
			
			$log->user_id=Auth::user()->id;
		}
		else {
			$log->user_id='guest';
		}
		
		$log->request=$q;
		$log->save();
		$products= Product::where('name','like', '%'.$q.'%')->paginate(4);
		return view('product/searchproduct', compact('products'));

	}


	public function getProductByCategory($category){


		$category=Category::where('name','=',$category)->first();
		$products=$category->products()->paginate(4);
		$minPrice=$category->products()->min('price');
		$maxPrice=$category->products()->max('price');
		return view('product/index', compact('products','minPrice','maxPrice','category'));

	}

	public function getproductbycategoryandPrice(Request $request, $category){


		$category=Category::where('name','=',$category)->first();
		$products=$category->products()->whereBetween('price',[$request->start_price, $request->end_price])->paginate(4);
		$minPrice=$category->products()->min('price');
		$maxPrice=$category->products()->max('price');

		return view('product/index', compact('products','minPrice','maxPrice','category'));


	}


}