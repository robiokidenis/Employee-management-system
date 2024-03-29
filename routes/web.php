<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/companies', [App\Http\Controllers\CompaniesController::class, 'index'])->name('companies');

Route::middleware(['auth','checkAdmin'])->group(function () {
    Route::resource('companies', App\Http\Controllers\CompaniesController::class);
    Route::resource('employees', App\Http\Controllers\EmployeesController::class);
    route::post('companies/{id}', [App\Http\Controllers\CompaniesController::class, 'update']);
});
Route::get('image/{filename}', [HomeController::class, 'displayImage'])->name('image.displayImage');
