<?php
//Start-Import_Controller

//End-Import_Controller
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Auth;
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
//Route::get('/rez',function(){
//    return 'hi';
//});


Route::get('/', function () {

    alert()->success('welcome')->persistent('ok');
    return view('welcome');
});
//['verif'=>true]
//Rout-Start-Auth
Auth::routes();

//S_Route-auh-google
Route::get('/auth/google' ,[GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback' ,[GoogleController::class, 'callback']);
//E_Route-auh-google





Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rout-End-Auth

//Rout-Start-Profile
Route::middleware('auth')->group(function (){
    Route::get('/profile',[ProfileController::class , 'index'])->name('profile');
    Route::get('profile/towfactorauth',[ProfileController::class , 'towfactorauth'])->name('towfactorauth');
    Route::Post('profile/towfactorauth',[ProfileController::class , 'posttowfactorauth']);

});


//Rout-End-Profile


Route::get('/secret',function (){
    return 'secret';

})->middleware(['auth','password.confirm']);
