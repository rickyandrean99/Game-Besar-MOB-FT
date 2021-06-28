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

Route::get('/', function () {
    return view('welcome');
});

// [RICKY] Route tipe get yang digunakan saat reload halaman
Route::get('/dashboard', 'TeamController@dashboard')->name('dashboard');

// [RICKY] Route tipe post yang digunakan olex Ajax
Route::post('/get-equipment-requirement', 'TeamController@getEquipmentRequirement')->name('get-equipment-requirement');
