<?php
use Illuminate\Http\Request;
use App\Department;
use App\Programme;
use App\Peo;
use App\Plo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', 'HomeController@index')->name('home');



Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
    });



Route::get('/home', 'HomeController@index')->name('home');



Route::resource('users', 'UserController');



Route::resource('courses', 'CourseController');



Route::resource('departments', 'DepartmentController');



Route::get('department/{id}/programmes', 'ProgrammeController@index');

Route::get('department/{id}/programmes/create', 'ProgrammeController@create');

Route::resource('programmes', 'ProgrammeController');


Route::get('programme/{id}', 'PeoController@index');

Route::get('programme/{id}/peos', 'PeoController@index');

Route::get('programme/{id}/peos/create', 'PeoController@create');

Route::get('programme/{prog_id}/peo/{peo_id}/attach/{plo_id}', 'PeoController@attach');

Route::get('programme/{prog_id}/peo/{peo_id}/detach/{plo_id}', 'PeoController@detach');

Route::resource('peos', 'PeoController');


Route::get('programme/{id}/plos', 'PloController@index');

Route::get('programme/{id}/plos/create', 'PloController@create');

Route::resource('plos', 'PloController');


Route::get('programme/{id}/ppmapping', 'PPMAppingController@index');