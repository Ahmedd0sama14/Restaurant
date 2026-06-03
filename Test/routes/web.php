<?php

use App\Http\Controllers\{AboutController, ContactController, HeaderController, TeacherController, CourseController, CourseSessionController};
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::controller(AboutController::class)->group(function () {

    Route::get('/abouts', 'index')->name('abouts.index');
    Route::post('/abouts/update/{about}', 'update')->name('abouts.update');
});
Route::controller(StudentAuthController::class)->prefix('student')->group(function () {
    Route::get('register', 'showRegister')->name('student.register');
    Route::post('register', 'register')->name('student.register');
    Route::get('login', 'showLogin')->name('student.login');
    Route::post('login', 'login')->name('student.login');
    Route::post('logout', 'logout')->name('student.logout');
    Route::get('otp', 'showOtp')->name('student.otp');
    Route::post('otp', 'otp')->name('student.otp');
    Route::post('resend-otp', 'resendOtp')->name('student.resend-otp');
});
Route::controller(StudentController::class)->prefix('student')->group(function () {
    Route::get('dashboard', 'dashboard')->name('student.dashboard');
});
Route::resource('headers', HeaderController::class);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
Route::resource('teachers', TeacherController::class);
Route::resource('courses', CourseController::class);
Route::resource('sessions', CourseSessionController::class);
Route::resource('students', AdminStudentController::class);
Route::resource('exams', ExamController::class);
Route::get('/exams/{exam}/toggle', [ExamController::class, 'toggle'])->name('exams.toggle');
Route::scopeBindings()->group(function () {
Route::controller(QuestionController::class)->group(function () {

    Route::get('/exams/{exam}/questions', 'index')->name('questions.index');
    Route::get('/exams/{exam}/questions/create', 'create')->name('questions.create');
    Route::post('/exams/{exam}/questions', 'store')->name('questions.store');
    Route::get('/exams/{exam}/questions/{question}', 'show')->name('questions.show');
    Route::get('/exams/{exam}/questions/{question}/edit', 'edit')->name('questions.edit');
    Route::put('/exams/{exam}/questions/{question}', 'update')->name('questions.update');
    Route::delete('/exams/{exam}/questions/{question}', 'destroy')->name('questions.destroy');
});
Route::controller(QuestionAnswerController::class)->group(function () {
    Route::get('/exams/{exam}/questions/{question}/answers', 'index')->name('answers.index');
    Route::get('/exams/{exam}/questions/{question}/answers/create', 'create')->name('answers.create');
    Route::post('/exams/{exam}/questions/{question}/answers', 'store')->name('answers.store');
    Route::get('/exams/{exam}/questions/{question}/answers/{answer}', 'show')->name('answers.show');
    Route::get('/exams/{exam}/questions/{question}/answers/{answer}/edit', 'edit')->name('answers.edit');
    Route::put('/exams/{exam}/questions/{question}/answers/{answer}', 'update')->name('answers.update');
    Route::delete('/exams/{exam}/questions/{question}/answers/{answer}', 'destroy')->name('answers.destroy');
});});
Route::controller(DocumentController::class)->group(function () {
    Route::get('teachers/{teacher}/documents', 'index')->name('documents.index');
    Route::get('teachers/{teacher}/documents/create', 'create')->name('documents.create');
    Route::post('teachers/{teacher}/documents', 'store')->name('documents.store');
    Route::get('teachers/{teacher}/documents/{document}', 'show')->name('documents.show');
    Route::get('teachers/{teacher}/documents/{document}/edit', 'edit')->name('documents.edit');
    Route::put('teachers/{teacher}/documents/{document}', 'update')->name('documents.update');
    Route::delete('teachers/{teacher}/documents/{document}', 'destroy')->name('documents.destroy');

});
