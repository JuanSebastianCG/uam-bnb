<?php

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



Auth::routes();

Route::get('/', function () {return view('welcome');})->name('welcome');

//registrados
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('properties', App\Http\Controllers\PropertyController::class);
    Route::resource('characteristics', App\Http\Controllers\CharacteristicController::class);
    Route::resource('characteristics_of_properties', App\Http\Controllers\Characteristic_of_propertyController::class);
    Route::resource('rental_availabilities', App\Http\Controllers\Rental_availabilityController::class);
    Route::resource('photographs', App\Http\Controllers\PhotographController::class)->except(['index']);
    Route::resource('qualifications', App\Http\Controllers\QualificationController::class)->except(['show']);;
    Route::resource('comments', App\Http\Controllers\CommentController::class);
    Route::resource('bills', App\Http\Controllers\BillController::class);

    Route::get('photos/{properties_id}', [App\Http\Controllers\PhotographController::class, 'index'])->name('photos');


});
Route::GET('lookForQualification',[App\Http\Controllers\QualificationController::class,'lookForQualification'])->name('lookForQualification');
Route::GET('allQualifications/{properties_id}',[App\Http\Controllers\QualificationController::class,'allQualifications'])->name('allQualifications');
