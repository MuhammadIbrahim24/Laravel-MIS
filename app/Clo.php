<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clo extends Model
{
    public function course()
    {
    	return $this->belongsTo('App\Course');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function taxonomy_level()
    {
    	return $this->belongsTo('App\TaxonomyLevel');
    }

    public function batch()
    {
    	return $this->belongsTo('App\Batch');
    }

    public function semester()
    {
    	return $this->belongsTo('App\Semester');
    }

    public function year()
    {
    	return $this->belongsTo('App\Year');
    }

    public function plos()
    {
    	return $this->belongsToMany('App\Plo');
    }

    public function programme()
    {
    	return $this->belongsTo('App\Programme');
    }

}
