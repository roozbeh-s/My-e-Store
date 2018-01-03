<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    public $table = 'product_options_values';



    public function OptionValues()
{
    return $this->belongsTo('App\ProductOption', 'id');
}





}
