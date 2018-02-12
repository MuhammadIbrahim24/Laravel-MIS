<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Programme extends Model
{
    public function department()
    {
    	return $this->belongsTo('App\Department');
    }

    public function courses()
    {
    	return $this->belongsToMany('App\Course');
    }

    public function plos()
    {
    	return $this->hasMany('App\Plo');
    }

    public function peos()
    {
    	return $this->hasMany('App\Peo');
    }

    public function clos()
    {
    	return $this->hasMany('App\Clo');
    }

    public static function getProgrammes(){
        return DB::table('programmes')
                ->select('*')
                ->orderBy('name', 'asc')
                ->get();
    }
}
