<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/areas', 'App\Http\Controllers\SalesAreasController@index')->name('area.index');
Route::get('/task2','App\Http\Controllers\BusinessController@index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    Route::get('/course/{id}', 'App\Http\Controllers\SalesAreasController@show')->name('area.show');
    Route::post('/areas', 'App\Http\Controllers\SalesAreasController@store');
    Route::get('/dashboard', function(){
        return Inertia::render('Dashboard');
    })->name('dashboard'); 
});
