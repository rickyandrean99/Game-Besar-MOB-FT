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
    return redirect('/login');
});

// Route tipe get yang digunakan saat mengakses halaman
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'TeamController@dashboard')->name('dashboard');
    Route::get('/round', 'RoundController@round')->name('round');
    Route::get('/shop', "ShopController@index")->name('shop');
    Route::post('insertOrUpdate', "ShopController@insertOrUpdate")->name('insertOrUpdate');
    Route::get('/quest', 'QuestController@index')->name('quest');
});

// Route tipe post yang digunakan olex Ajax
Route::post('/get-equipment-requirement', 'TeamController@getEquipmentRequirement')->name('get-equipment-requirement');
Route::post('/crafting-equipment', 'TeamController@craftingEquipment')->name('crafting-equipment');
Route::post('/use-equipment', 'TeamController@useEquipment')->name('use-equipment');
Route::post('/attack-weapon', 'TeamController@attackWeapon')->name('attack-weapon');
Route::post('/upgrade-weapon', 'TeamController@upgradeWeapon')->name('upgrade-weapon');
Route::post('/gift', 'TeamController@gift')->name('gift');
Route::post('/update-round', 'RoundController@updateRound')->name('update-round');
Route::post('/update-sesi', 'RoundController@updateSesi')->name('update-sesi');
Route::post('/broadcast-video', 'RoundController@broadcastVideo')->name('broadcast-video');
Route::post('/testing-part-doang', 'RoundController@testingPartDoang')->name('testing-part-doang'); // Nanti pake route, controller, sama function punya erha kalo tim berhasil selesaiin quest
Route::post('/coba-private-quest', 'RoundController@cobaPrivate')->name('coba-private'); // ini cuma testing private doang (Gabung sama punya erha)

// [eRHa] Route hasil quest
Route::post('/quest-result', 'QuestController@result');

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');
