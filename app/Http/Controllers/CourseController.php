<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Course;
use App\Programme;
use Illuminate\Support\Facades\View;
use Validator;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class CourseController extends Controller
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
        $data['courses'] = Course::all()->sortBy("name");

        // load the view and pass the departments
        return View::make('courses.index', $data);
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
        $data['courses'] = Course::all()->sortBy("name");
        return View::make('courses.create', $data);
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
            'code'       => 'required|Length:6',
            'title'      => 'required',
            'theory_ch'  => 'required',
            'lab_ch'     => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('courses/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $course = new course;
            $course->code       = Input::get('code');
            $course->title      = Input::get('title');
            $course->theory_ch  = Input::get('theory_ch');
            $course->lab_ch     = Input::get('lab_ch');
            $course->save();

            // redirect
            Session::flash('message', 'Successfully created course!');
            return Redirect::to('courses');
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
        $data['courses'] = Course::all()->sortBy("name");
        $data['crs'] = course::find($id);

        // show the edit form and pass the course
        return View::make('courses.edit', $data);
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
            'code'       => 'required|Length:6',
            'title'      => 'required',
            'theory_ch'  => 'required',
            'lab_ch'     => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('courses/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $course = course::find($id);
            $course->code       = Input::get('code');
            $course->title      = Input::get('title');
            $course->theory_ch  = Input::get('theory_ch');
            $course->lab_ch     = Input::get('lab_ch');
            $course->save();

            // redirect
            Session::flash('message', 'Successfully updated course!');
            return Redirect::to('courses');
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
        $course = course::find($id);
        $course->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the course!');
        return Redirect::to('courses');
    }
}
