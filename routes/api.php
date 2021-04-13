<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('v1')->group(function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/sign_in', 'API\Auth\LoginController');
    Route::post('/sign_up_with_email', 'API\Auth\RegistrationController');
    Route::get('/sign_in_with_google', 'API\Auth\SocialiteController@redirectToGoogle');
    Route::get('/google_signin_callback', 'API\Auth\SocialiteController@handleGoogleCallback');
    Route::get("email/verify/{id}/{hash}", "API\Auth\VerificationApiController@verify")->name("verification.verify");
    Route::get("email/resend", "API\Auth\VerificationApiController@resend")->name("verification.resend");
    Route::post('/password/email', 'API\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'API\Auth\ResetPasswordController@reset');

    Route::prefix('patients')->group(function () {
        Route::get('/', 'API\Patient\PatientController@index');
    });

    Route::prefix('specialists')->group(function () {
        Route::get('/', 'API\Specialist\SpecialistController@index');
    });

});
