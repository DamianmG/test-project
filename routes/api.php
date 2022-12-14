<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\VerificationController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// registration and login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

// email verification
Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// forgot password
Route::post('forgot-password', [ForgotPasswordController::class, 'forgot']);

// logged in and verified only
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::post('menage-user-group', [UserGroupController::class, 'menageUserGroup']);

    Route::get('get-all-user-groups', [UserGroupController::class, 'getAllUserGroups']);

    Route::get('get-user-groups', [UserGroupController::class, 'getUserGroups']);
    
    Route::get('products', function () {
        return 'product 1, product 2, prouct 3';
    })->middleware('permission:products');

    Route::get('posts', function () {
        return 'post 1, post 2, post 3';
    })->middleware('permission:posts');
});
