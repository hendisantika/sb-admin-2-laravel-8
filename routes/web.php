<?php

use Illuminate\Support\Facades\Route;

//Auth
use App\Http\Controllers\Auth\LoginController;

//Admin
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

Route::view('/','welcome');


Route::group(['namespace' => 'Admin','middleware' => 'auth'],function(){
	
	Route::get('/admin',[AdminController::class,'index'])->name('admin');

	//Route Rescource
	Route::resource('/admin/user','UserController');

	//Route View
	Route::view('/admin/404-page','admin.404-page')->name('404-page');
	Route::view('/admin/blank-page','admin.blank-page')->name('blank-page');
	Route::view('/admin/buttons','admin.buttons')->name('buttons');
	Route::view('/admin/cards','admin.cards')->name('cards');
	Route::view('/admin/utilities-colors','admin.utilities-color')->name('utilities-colors');
	Route::view('/admin/utilities-borders','admin.utilities-border')->name('utilities-borders');
	Route::view('/admin/utilities-animations','admin.utilities-animation')->name('utilities-animations');
	Route::view('/admin/utilities-other','admin.utilities-other')->name('utilities-other');
	Route::view('/admin/chart','admin.chart')->name('chart');
	Route::view('/admin/tables','admin.tables')->name('tables');
});

Route::group(['namespace' => 'Auth','middleware' => 'guest'],function(){
	Route::view('/login','auth.login')->name('login');
	Route::post('/login',[LoginController::class,'authenticate'])->name('login.post');
});

// Other
Route::view('/register','auth.register')->name('register');
Route::view('/forgot-password','auth.forgot-password')->name('forgot-password');
Route::post('/logout',function(){
	return redirect()->to('/login')->with(Auth::logout());
})->name('logout');
