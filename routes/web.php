<?php

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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'],function (){
    Route::get('/thang',function (){return 'thắng';});
    Route::get('dep',function (Request $request){return $request->query('q');});
    Route::get('/zai',function (){return 'zai';});
});

Route::resource('test','TestController');
