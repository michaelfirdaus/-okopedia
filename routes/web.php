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

//This route group only accessible for user that already logged in/authenticated
Route::group(['middleware' => 'auth'], function() {

    //This route group only accessible for admin
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
        
        //Routes to home page
        Route::get('/home', [
            'uses' => 'HomeController@index',
            'as'   => 'home'
        ]);
        
        //Routes to create product page
        Route::get('/product/create',[
            'uses' => 'ProductController@create',
            'as'   => 'product.create'
        ]);
    
        //Routes to edit specific product ID 
        Route::get('/product/edit/{id}',[
            'uses' => 'ProductController@edit',
            'as'   => 'product.edit'
        ]);
    
        //Deleting specific product ID
        Route::get('/product/delete/{id}',[
            'uses' => 'ProductController@destroy',
            'as'   => 'product.delete'
        ]);
    
        //Routes to list all products
        Route::get('/products',[
            'uses' => 'ProductController@index',
            'as'   => 'products'
        ]);
        
        //Save product to database
        Route::post('/product/store', [
            'uses' => 'ProductController@store',
            'as'   => 'product.store'
        ]);
    
        //Update specific product ID
        Route::post('/product/update/{id}',[
            'uses' => 'ProductController@update',
            'as'   => 'product.update'
        ]);
    
        //Routes to create new category page
        Route::get('/category/create',[
            'uses' => 'CategoryController@create',
            'as'   => 'category.create'
        ]);
    
        //Routes to edit specific category ID
        Route::get('/category/edit/{id}',[
            'uses' => 'CategoryController@edit',
            'as'   => 'category.edit'
        ]);
    
        //Deleting specific category ID
        Route::get('/category/delete/{id}',[
            'uses' => 'CategoryController@destroy',
            'as'   => 'category.delete'
        ]);
    
        //Routes to list all categories
        Route::get('/categories',[
            'uses' => 'CategoryController@index',
            'as'   => 'categories'
        ]);
    
        //Update specific category ID
        Route::post('/category/update/{id}',[
            'uses' => 'CategoryController@update',
            'as'   => 'category.update'
        ]);
    
        //Save category to the database
        Route::post('/category/store',[
            'uses' => 'CategoryController@store',
            'as'   => 'category.store'
        ]);
    
        //Routes to user's profile page
        Route::get('/user/profile',[
            'uses' => 'UserController@index',
            'as'   => 'user.profile'
        ]);
    
        //Routes to update user's profile page based on user ID
        Route::post('/user/profile/update/{id}',[
            'uses' => 'UserController@update',
            'as' => 'user.profile.update'
        ]);
    });

    //This route group only accessible for user
    Route::group(['prefix' => 'user'], function () {
        //Route to home page
        Route::get('/home', [
            'uses' => 'HomeController@index',
            'as'   => 'home'
        ]);
    
        //Route to user's profile page
        Route::get('/profile',[
            'uses' => 'UserController@index',
            'as'   => 'user.profile'
        ]);
    
        //Routes to update user's profile page based on user ID
        Route::post('/profile/update/{id}',[
            'uses' => 'UserController@update',
            'as'   => 'user.profile.update'
        ]);

        //Routes to specific product detail based on product ID
        Route::get('/product/{id}',[
            'uses' => 'ProductDetailController@index',
            'as'   => 'user.product.detail'
        ]);

        //Routes to list a product that searched by user
        Route::post('/product/search',[
            'uses' => 'ProductDetailController@search',
            'as'   => 'user.product.search'
        ]);

        //Route to add product to the cart
        Route::get('/product/{id}/add',[
            'uses' => 'CartController@create',
            'as'   => 'user.cart.create'
        ]);
        
        //Route to list user's cart
        Route::get('/cart/show', [
            'uses' => 'CartController@show',
            'as'   => 'user.cart.show'
        ]);

        //Save the cart to the database
        Route::post('/cart/store/{id}', [
            'uses' => 'CartController@store',
            'as'   => 'user.cart.store'
        ]);

        //Edit specific product on the user's cart based on cart ID
        Route::get('/cart/edit/{id}', [
            'uses' => 'CartController@edit',
            'as'   => 'user.cart.edit'
        ]);

        //Updating specific product on the cart based on cart ID
        Route::post('/cart/update/{id}', [
            'uses' => 'CartController@update',
            'as'   => 'user.cart.update'
        ]);

        //Deleting specific product on the cart based on cart ID
        Route::delete('/cart/destroy/{id}', [
            'uses' => 'CartController@destroy',
            'as'   => 'user.cart.destroy'
        ]);

        //Checkout user's cart
        Route::post('/cart/checkout', [
            'uses' => 'CartController@checkout',
            'as'   => 'user.cart.checkout'
        ]);

        //List all user's transaction history
        Route::get('/transaction/history',[
            'uses' => 'HistoryController@index',
            'as'   => 'user.transaction.history'
        ]);

        //View the detail of the transaction history based on transaction ID
        Route::get('/transaction/history/{id}/detail',[
            'uses' => 'HistoryController@detail',
            'as'   => 'user.transaction.history.detail'
        ]);
    });
});    


