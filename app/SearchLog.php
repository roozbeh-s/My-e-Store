<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    public $table = 'search_logs';


    public function setUpdatedAtAttribute($value)
{
    // to Disable updated_at
}

}
