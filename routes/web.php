<?php
//Start-Import_Controller

//End-Import_Controller
use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
 * key====== 6Le2DMYgAAAAAB6SqJpI_6QEOLX6syPfhUBlthz2
 *
 * sec===    6Le2DMYgAAAAAGKF8P3U3I8daB_x0mC4ry3ej1XZ
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/test',function (){
//    return auth()->user()->activeCode()->create([
//
//        'code'=>'99922',
//        'expired_at'=>now()->addMinutes(6)
//    ]);
//});

Route::get('/', function () {



//    alert()->error('Welcome')->persistent('ok');
    return view('welcome');
});
//Rout-Start-Auth
Auth::routes(['verify' => true]);

//S_Route-auh-google

Route::get('/auth/google' ,[GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback' ,[GoogleController::class, 'callback']);
Route::get('/auth/token' ,[AuthTokenController::class, 'getToken'])->name('2fa.token');
Route::post('/auth/token' ,[AuthTokenController::class, 'postToken'])->name('tokenpost');
//E_Route-auh-google

//S_Route-auh-Token

//E_Route-auh-Token

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rout-End-Auth

//Rout-Start-Profile
Route::middleware('auth')->group(function (){
    Route::get('/profile',[ProfileController::class , 'index'])->name('profile');

    Route::get('profile/towfactorauth',[ProfileController::class , 'towfactorauth'])->name('towfactorauth');
    Route::Post('profile/towfactorauth',[ProfileController::class , 'posttowfactorauth']);

    Route::get('profile/towfactorauth/phone',[ProfileController::class , 'getauthphone'])->name('profile.phone');
    Route::post('profile/towfactorauth/phone',[ProfileController::class , 'postauthphone']);



});


//Rout-End-Profile


Route::get('/secret',function (){
    return 'secret';

})->middleware(['auth','password.confirm']);
