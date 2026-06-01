<?php

use App\Http\Controllers\Api\{AboutController, ContactController, CourseTypesController, HeaderController, TeacherController};
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseSessionController;
use App\Http\Controllers\Api\StudentAuthController;
use Illuminate\Support\Facades\Route;


Route::controller(StudentAuthController::class)->prefix('auth/student')->group(function () {
Route::post('register','register');
Route::post('otp','otp');
Route::post('resend-otp','resendOtp');
Route::post('reset-password','resetPassword');
Route::post('verify-code','verifyCode');
Route::post('verify-reset-password','verifyResetPassword');
Route::post('login','login');
Route::post('logout','logout')->middleware('auth:sanctum');
Route::delete('delete-account','delete')->middleware('auth:sanctum');
});

Route::controller(ContactController::class)->group(function () {
    Route::post('contact', 'store');
});
Route::get('about', [AboutController::class, 'index']);
Route::prefix('v1')->name('api.')->group(function () {
    Route::apiResource('course-types', CourseTypesController::class);
    Route::apiResource('headers', HeaderController::class);
    Route::apiResource('courses', CourseController::class);
});

Route::controller(TeacherController::class)->group(function () {
    Route::get('teachers', 'index');
    Route::get('teachers/{id}', 'show');
});
Route::get('CoursesSessions', [CourseSessionController::class, 'index']);
