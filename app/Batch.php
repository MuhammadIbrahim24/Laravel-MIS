<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public function clos()
    {
    	return $this->belongsToMany('App\Course');
    }
}
