<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ProductOption extends Model
{
    public $table = 'product_options';


    public function OptionValues (){

        return $this->hasMany('App\ProductOptionValue','option_id','id');




    } 

   
}
