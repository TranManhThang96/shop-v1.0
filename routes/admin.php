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

Route::group(['prefix'=>'category'],function (){
    Route::any('list','CategoryController@list')->name('admin.category.list');
    Route::any('add','CategoryController@save')->name('admin.category.save');
    Route::get('remove/{id}','CategoryController@remove')->name('admin.category.remove');
    Route::post('change-status','CategoryController@changeStatus')->name('admin.category.changeStatus');
    Route::post('checkExist','CategoryController@checkExist')->name('admin.category.checkExist');
});

Route::group(['prefix'=>'product'],function (){
    Route::any('list','ProductController@list')->name('admin.product.list');
    Route::get('add','ProductController@add')->name('admin.product.add');
    Route::get('edit/{id}','ProductController@edit')->name('admin.product.edit');
    Route::post('save','ProductController@save')->name('admin.product.save');
});

Route::group(['prefix'=>'customer'],function (){
    Route::any('list','CustomerController@list')->name('admin.customer.list');
    Route::get('add','CustomerController@add')->name('admin.customer.add');
    Route::get('edit/{id}','CustomerController@edit')->name('admin.customer.edit');
    Route::post('save','CustomerController@save')->name('admin.customer.save');
    Route::get('remove/{id}','CustomerController@remove')->name('admin.customer.remove');
    Route::post('check-phone-exist','CustomerController@checkPhoneExist')->name('admin.customer.checkPhoneExist');
    Route::post('check-email-exist','CustomerController@checkEmailExist')->name('admin.customer.checkEmailExist');
});

Route::group(['prefix'=>'discount'],function (){
    Route::any('list','DiscountController@list')->name('admin.discount.list');
    Route::get('add','DiscountController@add')->name('admin.discount.add');
    Route::get('edit/{id}','DiscountController@edit')->name('admin.discount.edit');
    Route::get('remove/{id}','DiscountController@remove')->name('admin.discount.remove');
    Route::post('save','DiscountController@save')->name('admin.discount.save');
});

Route::group(['prefix' => 'district'],function (){
   Route::get('get-list-district-by-province','DistrictController@getListDistrictByProvince')->name('admin.district.getListDistrictByProvince');
});

Route::group(['prefix' => 'ward'],function (){
    Route::get('get-list-ward-by-district','WardController@getListWardByDistrict')->name('admin.ward.getListWardByDistrict');
});

Route::get('/test',function (){
    return response()->file('web.config');
});