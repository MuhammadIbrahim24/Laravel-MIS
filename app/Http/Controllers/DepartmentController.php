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

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name"); 

        // load the view and pass the departments
        return View::make('departments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');  
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        return View::make('departments.create', $data);
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
            return Redirect::to('departments/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $department = new department;
            $department->name       = Input::get('name');
            $department->save();

            // redirect
            Session::flash('message', 'Successfully created department!');
            return Redirect::to('departments');
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
        $data['dept'] = department::find($id);

        // show the edit form and pass the department
        return View::make('departments.edit', $data);
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
            return Redirect::to('departments/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $department = department::find($id);
            $department->name       = Input::get('name');
            $department->save();

            // redirect
            Session::flash('message', 'Successfully updated department!');
            return Redirect::to('departments');
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
        $department = department::find($id);
        $department->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the department!');
        return Redirect::to('departments');
    }
}
