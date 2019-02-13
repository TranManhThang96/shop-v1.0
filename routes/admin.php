<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 1/22/2019
 * Time: 4:43 PM
 * Description: admin route
 */

Route::get('/',function (){
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::group(['prefix'=>'categories'],function (){
    Route::any('index','CategoryController@index')->name('admin.categories.index');
    Route::any('add','CategoryController@save')->name('admin.categories.save');
    Route::get('remove/{id}','CategoryController@remove')->name('admin.categories.remove');
    Route::post('change-status','CategoryController@changeStatus')->name('admin.categories.changeStatus');
    Route::post('checkExist','CategoryController@checkExist')->name('admin.categories.checkExist');
    Route::get('test','CategoryController@test');
});
