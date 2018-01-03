<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


	public function items(){

		return $this->hasMany('App\OrderItem','order_id','id');      

    }


    public function address(){

		return $this->hasOne('App\OrderAddress','order_id','id');      

    }


    public function getStatusLabel(){

    	return $this->hasOne('App\OrderStatus','code','status'); 
    }

}
