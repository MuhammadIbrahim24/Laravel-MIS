<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peo extends Model
{
    public function programme()
    {
    	return $this->belongsTo('App\Programme');
    }

    public function plos()
    {
    	return $this->belongsToMany('App\Plo');
    }
}
