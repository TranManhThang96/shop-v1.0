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


Route::group(['prefix' => 'district'],function (){
   Route::get('get-list-district-by-province','DistrictController@getListDistrictByProvince')->name('admin.district.getListDistrictByProvince');
});

Route::group(['prefix' => 'ward'],function (){
    Route::get('get-list-ward-by-district','WardController@getListWardByDistrict')->name('admin.ward.getListWardByDistrict');
});

Route::get('/test',function (){
    return response()->file('web.config');
});


Route::group(['prefix'=>'DB'],function (){
    Route::get('/raw-index','DBController@rawIndex')->name('admin.db.raw.index');
    Route::get('/raw-insert','DBController@rawInsert')->name('admin.db.raw.insert');
    Route::get('/raw-update','DBController@rawUpdate')->name('admin.db.raw.update');
    Route::get('/raw-transaction','DBController@transaction')->name('admin.db.raw.transaction');
    Route::get('/test-queryBuilder','DBController@testQueryBuilder')->name('admin.db.testQueryBuilder');
});

Route::post('/posts/checkExist','PostController@checkExist')->name('posts.checkExist');
Route::post('/suppliers/checkExist','SupplierController@checkExist')->name('suppliers.checkExist');
Route::post('/brands/checkExist','BrandController@checkExist')->name('brands.checkExist');
Route::post('/categories/changeStatus','CategoryController@changeStatus')->name('categories.changeStatus');
Route::post('/categories/checkExist','CategoryController@checkExist')->name('categories.checkExist');
Route::post('/customers/check-phone-exist','CustomerController@checkPhoneExist')->name('customers.checkPhoneExist');
Route::post('/customers/check-email-exist','CustomerController@checkEmailExist')->name('customers.checkEmailExist');
Route::post('/products/checkExist','ProductController@checkExist')->name('products.checkExist');

Route::resources([
    'brands' => 'BrandController',
    'posts' => 'PostController',
    'suppliers' => 'SupplierController',
    'categories' => 'CategoryController',
    'discounts' => 'DiscountController',
    'customers' => 'CustomerController',
    'products' => 'ProductController'
]);