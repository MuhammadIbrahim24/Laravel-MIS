<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public function clos()
    {
    	return $this->belongsToMany('App\Clo');
    }
}
