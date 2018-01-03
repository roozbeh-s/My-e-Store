<?php

namespace App\Http\Controllers;
use Auth;
use App\Address;
use App\Country;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    	public function getAccount() {

		
		$address = Auth::user()->address;
		
		if(!empty($address)){
		$country = Auth::user()->address->nation;
		$state = Auth::user()->address->province;

		return view('customer/account', compact('address','country','state'));
			
		}else {

		return view('customer/account', compact('address'));
	}	

	}
}
