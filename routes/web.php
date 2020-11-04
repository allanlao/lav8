<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController; 
use App\Http\Controllers\LeaveCreditController;
use App\Http\Controllers\LeaveCocController;
use App\Http\Controllers\LeaveController;

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

// Auth
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->name('login.attempt')->middleware('guest');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')
->group(function () {

// Dashboard

Route::get('/', [DashboardController::class, 'index']);

//Home

Route::get('/home', [HomeController::class, 'index']);

//Employee
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
Route::get('/employees/create', [EmployeeController::class, 'create']);
Route::post('/employees/store', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'update']);
Route::get('/employees/delete/{id}', [EmployeeController::class, 'delete']);


//Leaves

Route::resource('leaves',LeaveController::class)->except(['create']);
Route::get('/leaves/create/{id}', [LeaveController::class, 'create']);
Route::get('/leaves/delete/{id}', [LeaveController::class, 'destroy']);
Route::get('/leaves_approval', [LeaveController::class, 'approval']);
Route::get('/leaves_approval/{id}/{user}/{action}', [LeaveController::class, 'approve']);


//Leave Coc

Route::get('/cocs', [LeaveCocController::class, 'index']);
Route::post('/cocs/store', [LeaveCocController::class, 'store']);
Route::get('/cocs/create/{id}', [LeaveCocController::class, 'create'])->name('create_coc');
Route::get('/cocs_approval', [LeaveCocController::class, 'approval']);
Route::get('/cocs_approval/{id}/{user}/{action}', [LeaveCocController::class, 'approve']);


//Leave Credit

Route::get('/credits/{id}', [LeaveCreditController::class, 'index'])->name('credits-index');
Route::post('/credits/grp', [LeaveCreditController::class, 'createByGroup'])->name('credit-grp');
Route::post('/credits/storeMany', [LeaveCreditController::class, 'storeMany']);
Route::post('/credits/storeOne', [LeaveCreditController::class, 'storeOne']);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});