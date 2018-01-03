<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    


    public function nation (){

        return $this->hasOne('App\Country','iso2','country');

    }    


    public function province (){

        return $this->hasOne('App\State','code','state');

    }    
}
