<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminController;

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


Route::get('/home',[App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth','is_admin']
,function(){
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    });
});



Route::get('/copy', function () {
    return view('admin/copy');
});
// routes/web.php
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth'  ]
    ], function(){ //...

        Route::get('/', function () {
            return view('welcome');
        });

        Route::group(['middleware'=>'is_admin']
,function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::resource('/categories',CategoryController::class);
});


       
    });

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

   


	
});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
