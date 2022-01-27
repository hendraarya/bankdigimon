<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SiswaControllers;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\RubberController;
// use App\Http\Controllers\StampingController;
// use App\Http\COntrollers\WronlineController;

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
// Route::get('/', [HomeController::class,'index']);
// Route::get('/home', [HomeController::class,'index']);

// /*Route for process login*/
// Route::get('/login', [LoginController::class,'index']);
// Route::post('/proses-login', [LoginController::class,'login']);
// Route::get('/logout', [LoginController::class,'logout']);
// /*End Route for process login */

// /*Route for Export Data*/
// Route::post('/report-log-planningrb/excel',[RubberController::class,'exportExcel']);
// Route::post('/report-log-planningrb/pdf',[RubberController::class,'exportPDF']);

// /*End Route for Export Data*/

// /*Route for View*/
// Route::resource('sisw',SiswaControllers::class);
// Route::get('/maindigimon',function(){
//     return view('auth.login');
// });
// Route::get('/dashboard',function(){
//     return view('administrator.dashadmin');
// });
// Route::get('/exportdatarb',function(){
//     return view('bankrubber.exportdatrb');
// });
// /*Route::get('/viewdatarb',function(){
//     return view('bankrubber.viewdatrb');
// });*/
// Route::get('/viewdatarb',[RubberController::class,'viewdatrb']);

// #View Data Wr Online
// Route::get('/viewdatawronline',[WronlineController::class,'viewdatwronline']);
// /*Route::post('/viewdataplan/{id}',[RubberController::class,'viewdataplan']);*/
// /*End Route for View*/


Route::get('/','HomeController@index');
Route::get('/home','HomeController@index');

/*Route for process login*/
Route::get('/login','Auth\LoginController@index');
Route::post('/proses-login','Auth\LoginController@login');
Route::get('/logout','Auth\LoginController@logout');
/*End Route for process login */

/*Route for Export Data*/
Route::post('/report-log-planningrb/excel','RubberController@exportExcel');
Route::post('/report-log-planningrb/pdf','RubberController@exportPDF');
Route::post('/bankwronline/report/pdf','WronlineController@exportPDF');
Route::post('/bankwronline/report/excel','WronlineController@exportExcel');

/*End Route for Export Data*/

/*Route for View*/
Route::resource('sisw',SiswaControllers::class);
Route::get('/maindigimon',function(){
    return view('auth.login');
});
Route::get('/dashboard',function(){
    return view('administrator.dashadmin');
});
Route::get('/exportdatarb',function(){
    return view('bankrubber.exportdatrb');
});
/*Route::get('/viewdatarb',function(){
    return view('bankrubber.viewdatrb');
});*/
Route::get('/bankrubber/viewdatarb', function(){
    return view('bankrubber.viewdatrb');
});
Route::post('/bankrubber/get-list-data', 'RubberController@getListData');

#View Data Wr Online
Route::get('/bankwronline/viewdatawronline','WronlineController@viewdatwronline');
/*Route::post('/viewdataplan/{id}',[RubberController::class,'viewdataplan']);*/
/*End Route for View*/
