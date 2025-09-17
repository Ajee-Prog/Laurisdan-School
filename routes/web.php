<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FrontHomePage\LaurisdanPageController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LaurisdanPageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Admin
    Route::prefix('admin')->middleware('can:admin')->group(function(){
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::resource('books', BookController::class);
        Route::get('books/export/pdf', [BookController::class, 'exportPdf'])->name('books.export.pdf');
        // other admin routes
    });

    // Teacher
    Route::prefix('teacher')->middleware('can:teacher')->group(function(){
        Route::resource('teacher', App\Http\Controllers\Teacher\TeacherController::class);
    });

    // Student
    Route::prefix('student')->middleware('can:student')->group(function(){
        Route::resource('student', App\Http\Controllers\Student\StudentController::class);
    });

    // Parent
    Route::prefix('parent')->middleware('can:parent')->group(function(){
        Route::resource('parent', App\Http\Controllers\Parent\ParentController::class);
    });

    // Exams
    Route::resource('exams', ExamController::class);
});

Route::resource('books', App\Http\Controllers\BookController::class);
Route::get('books-export/pdf', [App\Http\Controllers\BookController::class,'exportPdf'])->name('books.export.pdf');


Route::resource('exams', App\Http\Controllers\ExamController::class);
Route::get('exams-export/pdf', [App\Http\Controllers\ExamController::class,'exportPdf'])->name('exams.export.pdf');


// Admin

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if($role=='admin') return view('dashboard.admin');
    if($role=='teacher') return view('dashboard.teacher');
    if($role=='student') return view('dashboard.student');
    if($role=='parent') return view('dashboard.parent');
})->middleware('auth')->name('dashboard');



// Routes For CRUD.......
Route::resource('students', StudentController::class)->middleware('role:admin');
Route::resource('teachers', TeacherController::class)->middleware('role:admin');
Route::resource('parents', ParentController::class)->middleware('role:admin');
Route::resource('classes', SchoolClassController::class)->middleware('role:admin');
Route::resource('books', BookController::class)->middleware('role:admin');
Route::resource('exams', ExamController::class)->middleware('role:teacher');
Route::resource('activities', ActivityController::class)->middleware('role:admin');
Route::resource('sessions', SessionController::class)->middleware('role:admin');
Route::resource('terms', TermController::class)->middleware('role:admin');