<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController; 
use App\Http\Controllers\LeaveCreditController;
use App\Http\Controllers\LeaveCocController;

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

// Dashboard

Route::get('/', [DashboardController::class, 'index']);

//Employee
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
Route::get('/employees/create', [EmployeeController::class, 'create']);
Route::post('/employees/store', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'update']);
Route::get('/employees/delete/{id}', [EmployeeController::class, 'delete']);


//Leave Credit

Route::get('/credits/{id}', [LeaveCreditController::class, 'index'])->name('credits-index');
Route::post('/credits/grp', [LeaveCreditController::class, 'createByGroup'])->name('credit-grp');
Route::post('/credits/storeMany', [LeaveCreditController::class, 'storeMany']);
Route::post('/credits/storeOne', [LeaveCreditController::class, 'storeOne']);


//Leave Coc

Route::get('/cocs/{id}', [LeaveCocController::class, 'index']);
Route::post('/cocs/store', [LeaveCocController::class, 'store']);
Route::get('/cocs/create/{id}', [LeaveCocController::class, 'create'])->name('create_coc');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
