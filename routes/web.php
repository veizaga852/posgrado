<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ActivitieController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users',UserController::class);
Route::get('users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::get('users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

Route::resource('courses',CourseController::class);
Route::get('courses/{id}/update', [CourseController::class, 'update'])->name('courses.update');
Route::get('courses/{id}/destroy', [CourseController::class, 'destroy'])->name('courses.destroy');

Route::resource('records',RecordController::class);
Route::get('records/{id}/update', [RecordController::class, 'update'])->name('records.update');
Route::get('records/{id}/destroy', [RecordController::class, 'destroy'])->name('records.destroy');

Route::resource('activities',ActivitieController::class);
Route::get('activities/{id}/update', [ActivitieController::class, 'update'])->name('activities.update');
Route::get('activities/{id}/destroy', [ActivitieController::class, 'destroy'])->name('activities.destroy');
