<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Address;
use App\Country;
use App\State;




class EditAccountController extends Controller
{


//Edit Name
    
    public function getAccountEdit() {


		return view('customer/edit/index', array('user' => Auth::user()));

    }


    public function update(Request $request){

    	$this->validate($request, [
        
        'name' => 'required|max:255',
        ]);

    	$user=Auth::user();

    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->save();

    	return redirect()->back()->with('message', 'Account is successfully Updated!');


    }


    // Edit Password


    public function getPasswordEdit(){

    	return view('customer/edit/password', array('user' => Auth::user()));

    }


    public function passwordupdate(Request $request){


    	$this->validate($request, [
        'current_password' => 'required|min:6|current_password',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6',

        ],

		$messages = [
		'required' => 'This is required field',
		]);



            request()->user()->fill([
            'password' => Hash::make(request()->input('password'))
            ])->save();
            
            return redirect()->route('passwordedit')->with('message', 'Password is successfully Updated!');


    }

        // Edit Address

        public function getAddressEdit(){

            $address=Address::where('user_id', Auth::user()->id)->first();
            $selectcountry=Country::all()->pluck('name','iso2');
            $selectstate=State::all()->pluck('name','code');

            return view('customer/edit/address',compact('address','selectcountry','selectstate'));


    
       //return view('customer/edit/address', array('address' => Address::where('user_id', Auth::user()->id)->first() ));     

       

    }


    public function addressUpdate(Request $request){



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

        $user=Auth::user();

        $address=Address::firstOrNew(['user_id'=>$user->id]);


        $address->addr_first_line= $request->addr_first_line;
        $address->addr_second_line= $request->addr_second_line;
        $address->city= $request->city;
        $address->state= $request->state;
        $address->postcode= $request->postcode;
        $address->country= $request->country;

        $address->save();

        return redirect()->route('addressupdate')->with('message', 'Address is successfully Updated!');

    }





}


  