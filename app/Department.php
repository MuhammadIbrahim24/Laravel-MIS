<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    public function programmes()
    {
    	return $this->hasMany('App\Programme');
    }

    public static function getDepartments(){
        return DB::table('departments')
        		->select('*')
        		->orderBy('name', 'asc')
                ->get();
    }
}
