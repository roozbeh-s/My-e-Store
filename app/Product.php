<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    
        'id','name','imagePath','description','price','sku','quantity','status','created_at','updated_at'

    ];


    public function options(){

        return $this->hasMany('App\ProductOption','product_id','id');
    }


    public function OptionValues(){
        return $this->hasManyThrough('App\ProductOptionValue','App\ProductOption','product_id','option_id','id');

    }


}
