<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::resource('patient',[PatientController::class, 'index']);


Route::group(['middleware'=> ['XSS']], function(){
    Route::redirect('/','/patient');
    Route::resource('patient', PatientController::class);
    Route::post('/patient/getCities',[PatientController::class,'getCities'])->name('patient.cities');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->as('admin.')->group(function() {
    Route::get('login',[AdminLoginController::class,'showLoginForm'])->name('login');
    Route::post('login',[AdminLoginController::class,'login']);
    Route::resource('/',AdminController::class);
    Route::get('/cancer',[AdminController::class,'createCancerType'])->name('cancer.index');
    Route::post('/cancer',[AdminController::class,'storeCancerType'])->name('cancer.store');
});