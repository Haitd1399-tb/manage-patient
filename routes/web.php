<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Location\LocationController;
use App\Http\Controllers\HomeController;

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



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::resource('/patient', '\App\Http\Controllers\Admin\PatientController')->names('adminPatient');
    Route::resource('/storeDrug', '\App\Http\Controllers\StoreDrug\StoreDrugController')->names('adminStoreDrug');
    Route::resource('/storeOriental', '\App\Http\Controllers\StoreOriental\StoreOrientalController')->names('adminStoreOriental');
    Route::resource('/drug', '\App\Http\Controllers\Drug\DrugController')->names('adminDrug');
    Route::resource('/oriental', '\App\Http\Controllers\Oriental\OrientalController')->names('adminOriental');
    Route::resource('/day', '\App\Http\Controllers\Day\DayController')->names('adminDay');
    Route::resource('/advance', '\App\Http\Controllers\Advance\AdvanceController')->names('adminAdvance');
    Route::resource('/photo', '\App\Http\Controllers\Photo\PhotoController')->names('adminPhoto');

    Route::get('/patient/debit/{patient}', 'Debit\DebitController@debit')->name('adminDebit');
    Route::get('/patient/treated/{patient}', 'Treated\TreatedController@treated')->name('adminTreated');
    Route::get('/generate-pdf/{patient}','Admin\PatientController@generatePDF')->name('adminPDF');
    Route::get('/pdf/{patient}','Pdf\PdfController@index')->name('adminPdf');
    Route::get('/payOriental/{patient}','Oriental\OrientalController@pay')->name('orientalPay');

    Route::get('/dashboard', [HomeController::class, 'index'])->name('adminHome');
    Route::get('/location/provinces', [LocationController::class, 'getProvinces'])->name('getProvinces');
    Route::get('/location/province/{province}/districts', [LocationController::class, 'getDistricts'])->name('getDistricts');
    Route::get('/location/district/{district}/wards', [LocationController::class, 'getWards'])->name('getWards');

    Route::get('/home-debit', 'Debit\DebitController@homeDebit')->name('home-debit');
    // Route::get('/home-debit/{patient}', 'Debit\DebitController@')->name('home-debit');


    Route::get('/home-treated', 'Treated\TreatedController@homeTreated')->name('home-treated');
    Route::post('/home-treated/untreated/{patient}', 'Treated\TreatedController@Untreated')->name('home-untreated');
    Route::get('/home-treated/{patient}', 'Treated\TreatedController@Showtreated')->name('show-treated');
});

Auth::routes();
