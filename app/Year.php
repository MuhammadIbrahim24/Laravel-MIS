<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    public function clos()
    {
    	return $this->belongsToMany('App\Clo');
    }
}
