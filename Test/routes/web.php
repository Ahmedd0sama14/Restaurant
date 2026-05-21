<?php
use App\Http\Controllers\{AboutController, ContactController, HeaderController, TeacherController, CourseController};
use Illuminate\Support\Facades\Route;

Route::controller(AboutController::class)->group(function () {

    Route::get('/abouts', 'index') ->name('abouts.index');
    Route::post('/abouts/update/{about}','update' )->name('abouts.update');
});

Route::resource('headers', HeaderController::class);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
Route::resource('teachers', TeacherController::class);
Route::resource('courses', CourseController::class);
