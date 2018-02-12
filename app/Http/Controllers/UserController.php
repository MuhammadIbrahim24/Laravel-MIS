<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Programme;
use Illuminate\Support\Facades\View;
use Validator;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');  
    }


    public function index()
    {

        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name"); 
        // get all the users
        $data['users'] = User::all()->sortByDesc("is_admin");

        // load the view and pass the users
        return View::make('users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['departments'] = Department::all()->sortBy("name");
        $data['programmes'] = Programme::all()->sortBy("name");
        return View::make('users.create', $data);
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
            'name'       => 'required',
            'email'      => 'required|email',
            'password' => 'required|Min:6',
            'is_admin' => 'in:0,1'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = new user;
            $user->name       = Input::get('name');
            $user->email      = Input::get('email');
            $user->password   = bcrypt(Input::get('password'));
            $user->is_admin   = Input::get('is_admin');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('users');
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
        // get the user
        $data['user'] = user::find($id);

        // show the edit form and pass the user
        return View::make('users.edit', $data);
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
            'email'      => 'required|email',
            'password' => 'required|Min:6',
            'is_admin' => 'in:0,1'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $user = user::find($id);
            $user->name       = Input::get('name');
            $user->email      = Input::get('email');
            $user->password   = bcrypt(Input::get('password'));
            $user->is_admin   = Input::get('is_admin');
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated user!');
            return Redirect::to('users');
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
        $user = user::find($id);
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the user!');
        return Redirect::to('users');
    }
}
