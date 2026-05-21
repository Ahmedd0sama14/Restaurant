<?php

use App\Http\Controllers\Api\{AboutController, ContactController, CourseTypesController,HeaderController,TeacherController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('headers', HeaderController::class);
Route::controller(ContactController::class)->group(function () {
    Route::post('contact', 'store');
});
Route::get('about', [AboutController::class, 'index']);
Route::apiResource('course-types', CourseTypesController::class);
Route::controller(TeacherController::class)->group(function () {
    Route::get('teachers', 'index');
    Route::get('teachers/{id}', 'show');
});
