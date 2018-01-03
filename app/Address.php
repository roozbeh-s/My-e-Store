<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','addr_first_line','addr_second_line','city','state','postcode','country'

    ];

    public function nation (){

        return $this->hasOne('App\Country','iso2','country');

    }    


    public function province (){

        return $this->hasOne('App\State','code','state');

    }    


}
