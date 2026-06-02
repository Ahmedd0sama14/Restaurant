<?php
use App\Http\Controllers\{AboutController, ContactController, HeaderController, TeacherController, CourseController, CourseSessionController};
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::controller(AboutController::class)->group(function () {

    Route::get('/abouts', 'index') ->name('abouts.index');
    Route::post('/abouts/update/{about}','update' )->name('abouts.update');
});
Route::controller(StudentAuthController::class)->prefix('student')->group(function () {
Route::get('register','showRegister')->name('student.register');
Route::post('register','register')->name('student.register');
Route::get('login','showLogin')->name('student.login');
Route::post('login','login')->name('student.login');
Route::post('logout','logout')->name('student.logout');
Route::get('otp', 'showOtp')->name('student.otp');
Route::post('otp','otp')->name('student.otp');
Route::post('resend-otp','resendOtp')->name('student.resend-otp');
});
Route::controller(StudentController::class)->prefix('student')->group(function () {
    Route::get('dashboard','dashboard')->name('student.dashboard');

});
Route::resource('headers', HeaderController::class);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
Route::resource('teachers', TeacherController::class);
Route::resource('courses', CourseController::class);
Route::resource('sessions', CourseSessionController::class);
Route::resource('students', AdminStudentController::class);