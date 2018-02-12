<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Programme;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        return View::make('home', $data);
    }
}
