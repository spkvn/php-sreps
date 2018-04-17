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

Route::get('/', function () {
    return view('welcome');
});

// Route to list all products in the system.
Route::get('/products', 'ProductController@index')->name('products.index');

// Route to show the form to create a new product
Route::get('/products/create', 'ProductController@create')->name('products.create');
// Route to post new product form to
Route::post('/products', 'ProductController@store')->name('products.store');

// Tip: Route Params
// A route parameter (see the {product} in the route below) is an ID of a particular product.
// The route parameter name needs to 100% match the parameter on the controller method
// E.G "/products/{product}" must equal public function edit(Product $product)

//Route to show the form to edit one specific product
Route::get('/products/{product}', 'ProductController@edit')->name('products.edit');
//Route to post the edit form to
Route::post('/products/{product}', 'ProductController@update')->name('products.update');

// Route to delete a product
Route::post('/products/{product}/destroy', 'ProductController@destroy')->name('products.destroy');

Route::get('/sales', 'SalesController@index')->name('sales.index');
Route::get('/sales/autocomplete','SalesController@autocompleteResults')->name('sales.autocomplete');
Route::get('/sales/create', 'SalesController@create')->name('sales.create');
Route::get('/sales/{sale}', 'SalesController@edit')->name('sales.edit');
Route::post('/sales', 'SalesController@store')->name('sales.store');
Route::post('/sales/{sale}', 'SalesController@update')->name('sales.update');
Route::post('/sales/{sale}/destroy', 'SalesController@destroy')->name('sales.destroy');
