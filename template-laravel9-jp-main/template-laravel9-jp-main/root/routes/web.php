<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
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
Route::get('',function(){
    return view('admin/base');
});
// admin
Route::prefix('admin')->name('admin')->group(function () {
    // admin/
    Route::view('admin/job', 'admin.index')->name('.index');
    // admin/jobs    admin.jobs
    // App\Http\Controllers\JobController
    Route::prefix('jobs')->name('.jobs')->controller(JobController::class)->group(function () {
        Route::get('', 'index')->name('.index');
        Route::post('', 'store')->name('.store');
        Route::get('create', 'create')->name('.create');
        Route::get('{job}', 'show')->name('.show');
        Route::patch('{job}', 'update')->name('.update');
        Route::delete('{job}', 'destroy')->name('.destroy');
        Route::get('{job}/edit', 'edit')->name('.edit');
        Route::post('{job}/confirm', 'confirm')->name('.confirm');
        Route::post('csv', 'csv')->name('.csv');
    });
});