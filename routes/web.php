<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

// user protected routes
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', 'HomeController@index')->name('user_dashboard');
    Route::get('/list', 'UserController@list')->name('user_list');
});

// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('admin_dashboard');
    Route::get('/users', 'AdminUserController@list')->name('admin_users');
});


require __DIR__.'/auth.php';