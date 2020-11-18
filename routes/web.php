<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\LeaveCreditController;
use App\Http\Controllers\LeaveCocController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\TrainingController;

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
//Route::namespace('App\Http\Controllers')->group(function () {
    Auth::routes();
//});
// Auth
/*Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('guest');
Route::post('login', 'Auth\LoginController@login')->name('login.attempt')->middleware('guest');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
*/
Route::middleware('auth')
->group(function () {

// Dashboard

Route::get('/', [DashboardController::class, 'index']);

//Position

Route::resource('positions', PositionController::class);


Route::resource('users', UserController::class);
//schools
Route::get('/schools/create', [SchoolController::class, 'create']);


//Employee
Route::resource('employees', EmployeeController::class);



//Leaves
Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
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
Route::get('/credits/summary', [LeaveCreditController::class, 'summary'])->name('credits.summary');
Route::get('/credits/{id}', [LeaveCreditController::class, 'index'])->name('credits.index');
Route::post('/credits_grp', [LeaveCreditController::class, 'createByGroup'])->name('credits.grp');
Route::get('/credits_grp', [LeaveCreditController::class, 'createByGroup']);
Route::post('/credits/storeMany', [LeaveCreditController::class, 'storeMany']);
Route::post('/credits/storeOne', [LeaveCreditController::class, 'storeOne']);

Route::delete('/credits/{id}', [LeaveCreditController::class, 'destroy']);

//Trainings
//Leaves
Route::post('/trainings/store', [TrainingController::class, 'store'])->name('trainings.store');
Route::post('/trainings', [TrainingController::class, 'index'])->name('trainings.index');
Route::get('/trainings/create/{id}', [TrainingController::class, 'create']);
Route::get('/trainings/delete/{id}', [TrainingController::class, 'destroy']);
Route::get('/trainings/edit/{id}', [TrainingController::class, 'edit']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});


