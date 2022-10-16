<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserGroupController;

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

Route::view('forgot_password', 'auth.reset_password')->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset']);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('user-groups', [UserGroupController::class, 'index']);
});
