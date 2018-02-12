<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Programme;
use App\Peo;
use App\Plo;
use Illuminate\Support\Facades\View;
use Validator;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\DB;

class PPMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $prog = Programme::find($id);
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        $data['peos'] = Peo::where('programme_id', $id)->get()->sortBy('effective_date');
        $data['plos'] = Plo::where('programme_id', $id)->get()->sortBy('effective_date');
        $data['peo_plo'] = DB::select('select * from peo_plo');
        $data['prog_id'] = $id;
        $data['prog_name'] = $prog->name;

        // load the view and pass the peos
        return View::make('peos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->middleware('auth');
        $prog = Programme::find($id);
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        $data['prog_id'] = $id;
        $data['prog_name'] = $prog->name;
        return View::make('peos.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'description'           => 'required',
            'effective_date' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('peos/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $peo = new peo;
            $peo->description          = Input::get('description');
            $peo->effective_date          = Input::get('effective_date');
            $peo->programme_id = Input::get('programme_id');
            $peo->save();

            // redirect
            Session::flash('message', 'Successfully created PEO!');
            return Redirect::to('programme/' . $peo->programme_id . '/peos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        $peo = Peo::find($id);
        $data['peo'] = $peo;
        $data['prog_id'] = $peo->programme->id;
        $data['prog_name'] = $peo->programme->name;
        $data['peoplo'] = $peo->plos()->get();
        $data['plos'] = Plo::where('programme_id', $peo->programme_id)->get();
       // $data['peo_plo'] = DB::select('select * from peo_plo');

        // show the peo
        return View::make('peos.show', $data);
    }

    public function detach($id)
    {

    }

    public function attach($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('auth');
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        $peo = Peo::find($id);
        $data['peo'] = $peo;
        $data['prog_id'] = $peo->programme->id;
        $data['prog_name'] = $peo->programme->name;

        // show the edit form and pass the peo
        return View::make('peos.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'description'    => 'required',
            'effective_date' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('peos/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $peo = Peo::find($id);
            $peo->description          = Input::get('description');
            $peo->effective_date          = Input::get('effective_date');
            $peo->programme_id = Input::get('programme_id');
            $peo->save();

            // redirect
            Session::flash('message', 'Successfully updated PEO!');
            return Redirect::to('programme/' . $peo->programme_id . '/peos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $this->middleware('auth');
        $peo = peo::find($id);
        $prog_id = $peo->programme_id;
        $peo->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the PEO!');
        return Redirect::to('programme/' . $prog_id . '/peos');
    }
}
