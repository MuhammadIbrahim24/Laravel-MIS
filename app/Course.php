<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function programmes()
    {
    	return $this->belongsToMany('App\Programme');
    }

    public function clos()
    {
    	return $this->belongsToMany('App\Clo');
    }
}
