<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Programme;
use Illuminate\Support\Facades\View;
use Validator;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dept = Department::find($id);
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        $data['dept_id'] = $id;
        $data['dept_name'] = $dept->name;

        // load the view and pass the programmes
        return View::make('programmes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->middleware('auth');
        $dept = Department::find($id);
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        $data['dept_id'] = $id;
        $data['dept_name'] = $dept->name;
        return View::make('programmes.create', $data);
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
            'name'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('programmes/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $programme = new programme;
            $programme->name          = Input::get('name');
            $programme->department_id = Input::get('department_id');
            $programme->save();

            // redirect
            Session::flash('message', 'Successfully created programme!');
            return Redirect::to('department/' . $programme->department_id . '/programmes');
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
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        $data['prog'] = Programme::find($id);

        // show the edit form and pass the programme
        return View::make('programmes.edit', $data);
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
            'name'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('programmes/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $programme = Programme::find($id);
            $programme->name          = Input::get('name');
            $programme->department_id = Input::get('department_id');
            $programme->save();

            // redirect
            Session::flash('message', 'Successfully updated programme!');
            return Redirect::to('department/' . $programme->department_id . '/programmes');
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
        $programme = Programme::find($id);
        $dept_id = $programme->department_id;
        $programme->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the programme!');
        return Redirect::to('department/' . $dept_id . '/programmes');
    }
}
