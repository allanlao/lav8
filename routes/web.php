<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController; 

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
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');;
Route::get('/employees/create', [EmployeeController::class, 'create']);
Route::post('/employees/store', [EmployeeController::class, 'store']);
//Employee
//Route::get('/employees', [EmployeeController::class, 'create']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
