<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    //ADMIN
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
        
        Route::get('/home', [
            'uses' => 'HomeController@index',
            'as'   => 'home'
        ]);
        
        Route::get('/product/create',[
            'uses' => 'ProductController@create',
            'as'   => 'product.create'
        ]);
    
        Route::get('/product/edit/{id}',[
            'uses' => 'ProductController@edit',
            'as'   => 'product.edit'
        ]);
    
        Route::get('/product/delete/{id}',[
            'uses' => 'ProductController@destroy',
            'as'   => 'product.delete'
        ]);
    
        Route::get('/products',[
            'uses' => 'ProductController@index',
            'as'   => 'products'
        ]);
        
        Route::post('/product/store', [
            'uses' => 'ProductController@store',
            'as'   => 'product.store'
        ]);
    
        Route::post('/product/update/{id}',[
            'uses' => 'ProductController@update',
            'as'   => 'product.update'
        ]);
    
        Route::get('/category/create',[
            'uses' => 'CategoryController@create',
            'as'   => 'category.create'
        ]);
    
        Route::get('/category/edit/{id}',[
            'uses' => 'CategoryController@edit',
            'as'   => 'category.edit'
        ]);
    
        Route::get('/category/delete/{id}',[
            'uses' => 'CategoryController@destroy',
            'as'   => 'category.delete'
        ]);
    
        Route::get('/categories',[
            'uses' => 'CategoryController@index',
            'as'   => 'categories'
        ]);
    
        Route::post('/category/update/{id}',[
            'uses' => 'CategoryController@update',
            'as'   => 'category.update'
        ]);
    
        Route::post('/category/store',[
            'uses' => 'CategoryController@store',
            'as'   => 'category.store'
        ]);
    
        Route::get('/user/profile',[
            'uses' => 'UserController@index',
            'as'   => 'user.profile'
        ]);
    
        Route::post('/user/profile/update/{id}',[
            'uses' => 'UserController@update',
            'as' => 'user.profile.update'
        ]);
    });

    //USER
    Route::group(['prefix' => 'user'], function () {
        Route::get('/home', [
            'uses' => 'HomeController@index',
            'as'   => 'home'
        ]);
    
        Route::get('/profile',[
            'uses' => 'UserController@index',
            'as'   => 'user.profile'
        ]);
    
        Route::post('/profile/update/{id}',[
            'uses' => 'UserController@update',
            'as'   => 'user.profile.update'
        ]);

        Route::get('/product/{id}',[
            'uses' => 'ProductDetailController@index',
            'as'   => 'user.product.detail'
        ]);

        Route::post('/product/search',[
            'uses' => 'ProductDetailController@search',
            'as'   => 'user.product.search'
        ]);

        Route::get('/product/{id}/add',[
            'uses' => 'CartController@create',
            'as'   => 'user.cart.create'
        ]);
        
        Route::get('/cart/show', [
            'uses' => 'CartController@show',
            'as'   => 'user.cart.show'
        ]);

        Route::post('/cart/store/{id}', [
            'uses' => 'CartController@store',
            'as'   => 'user.cart.store'
        ]);

        Route::get('/cart/edit/{id}', [
            'uses' => 'CartController@edit',
            'as'   => 'user.cart.edit'
        ]);

        Route::post('/cart/update/{id}', [
            'uses' => 'CartController@update',
            'as'   => 'user.cart.update'
        ]);

        Route::delete('/cart/destroy/{id}', [
            'uses' => 'CartController@destroy',
            'as'   => 'user.cart.destroy'
        ]);

        Route::post('/cart/checkout', [
            'uses' => 'CartController@checkout',
            'as'   => 'user.cart.checkout'
        ]);

        Route::get('/transaction/history',[
            'uses' => 'HistoryController@index',
            'as'   => 'user.transaction.history'
        ]);

        Route::get('/transaction/history/{id}/detail',[
            'uses' => 'HistoryController@detail',
            'as'   => 'user.transaction.history.detail'
        ]);
    });
});    


