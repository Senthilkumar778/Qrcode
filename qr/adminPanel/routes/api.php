<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\GenerateORCodeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('auth')->group(function () {
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/forgot_password', [LoginController::class, 'forgot_password'])->name('forgot_password');
    Route::post('/reset_password/{token?}', [LoginController::class, 'reset_password'])->name('reset_password');
    Route::post('/otp_login', [LoginController::class, 'otp_login'])->name('otp_login');
    Route::post('/otp_login_verify', [LoginController::class, 'otp_login_verify'])->name('otp_login_verify');
});

Route::prefix('info')->group(function () {
    Route::post('getInfo', [DataController::class, 'getInfo'])->name('getInfo');
});

Route::prefix('page')->group(function () {
});


Route::any('listAllQRCode', [GenerateORCodeController::class, 'listAllQRCode'])->name('listAllQRCode');

