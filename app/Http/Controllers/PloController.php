<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Programme;
use App\plo;
use Illuminate\Support\Facades\View;
use Validator;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class PloController extends Controller
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
        $data['plos'] = Plo::where('programme_id', $id)->get()->sortBy('effective_date');
        $data['prog_id'] = $id;
        $data['prog_name'] = $prog->name;

        // load the view and pass the plos
        return View::make('plos.index', $data);
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
        return View::make('plos.create', $data);
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
            return Redirect::to('plos/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $plo = new plo;
            $plo->description          = Input::get('description');
            $plo->effective_date          = Input::get('effective_date');
            $plo->programme_id = Input::get('programme_id');
            $plo->save();

            // redirect
            Session::flash('message', 'Successfully created PLO!');
            return Redirect::to('programme/' . $plo->programme_id . '/plos');
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
        //
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
        $plo = Plo::find($id);
        $data['plo'] = $plo;
        $data['prog_id'] = $plo->programme->id;
        $data['prog_name'] = $plo->programme->name;

        // show the edit form and pass the plo
        return View::make('plos.edit', $data);
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
            return Redirect::to('plos/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $plo = Plo::find($id);
            $plo->description          = Input::get('description');
            $plo->effective_date          = Input::get('effective_date');
            $plo->programme_id = Input::get('programme_id');
            $plo->save();

            // redirect
            Session::flash('message', 'Successfully updated PLO!');
            return Redirect::to('programme/' . $plo->programme_id . '/plos');
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
        $this->middleware('auth');
        // delete
        $plo = Plo::find($id);
        $prog_id = $plo->programme_id;
        $plo->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the PLO!');
        return Redirect::to('programme/' . $prog_id . '/plos');
    }
}
