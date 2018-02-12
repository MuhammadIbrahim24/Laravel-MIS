<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plo extends Model
{
    public function clos()
    {
    	return $this->belongsToMany('App\Clo');
    }

    public function programme()
    {
    	return $this->belongsTo('App\Programme');
    }

    public function peos()
    {
    	return $this->belongsToMany('App\Peo');
    }
}
