<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Parent\ParentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClassController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\ClassController;
// use App\Http\Controllers\Admin\ExamController;
// use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\FrontHomePage\LaurisdanPageController;
use App\Http\Controllers\Admin\ContactController;




// Route::get('/', function () {
//     return view('laurisdan.welcomes');
// });

// Route::get('/', [LaurisdanPageController::class, 'index']);
Route::get('/', [LaurisdanPageController::class, 'index'])->name('home');
Route::get('/contact', [LaurisdanPageController::class, 'contact'])->name('contact');
Route::post('/contact', [LaurisdanPageController::class, 'sendContact'])->name('contact.send');
Route::get('/about', [LaurisdanPageController::class, 'about'])->name('about');


Auth::routes();

// new contact forms route

// ***************************All Admins Route Start Here*********************************

// Student Exam
Route::middleware(['auth','role:student'])->group(function(){
    Route::get('exam/{subject}', [App\Http\Controllers\ExamController::class, 'index'])->name('exam.start');
    Route::post('exam/submit', [App\Http\Controllers\ExamController::class, 'submit'])->name('exam.submit');
    Route::get('student/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
});

// Admin
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('admin/exam/create', [App\Http\Controllers\ExamController::class, 'create'])->name('admin.exam.create');
    Route::post('admin/exam/store', [App\Http\Controllers\ExamController::class, 'store'])->name('admin.exam.store');
});

Route::middleware(['auth', 'role:admin,teacher'])->group(function() {
    Route::resource('students', App\Http\Controllers\StudentController::class);
    Route::get('students-export-pdf', [App\Http\Controllers\StudentController::class, 'exportPdf'])->name('students.export.pdf');
});
// Exam CBT New Routes ends here

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Teacher routes
Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Route::get('/teacher/dashboard', function () {
    //     return view('teacher.dashboard');
    // })->name('teacher.dashboard');
    Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::resource('classes', ClassController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('students', StudentController::class);
});

// Student routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
});

// Parent routes
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/parent/dashboard', [App\Http\Controllers\ParentController::class, 'dashboard'])->name('parent.dashboard');
});

// _________ Dashboard routes starts-------------
// Admin-only
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Teacher-only
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teacher.dashboard');
});

// Student-only
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
});

// _________ Dashboard routes ends here -------------


// _________ indexs routes -------------
Route::middleware(['auth', 'role:teacher'])->group(function(){
    Route::get('/teacher/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');
});

Route::middleware(['auth', 'role:student'])->group(function(){
    Route::get('/student/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
});

Route::middleware(['auth', 'role:parent'])->group(function(){
    Route::get('/parent/dashboard', [App\Http\Controllers\Parent\DashboardController::class, 'index'])->name('parent.dashboard');
});




// _________ indexs routes ends -------------



// ***************************All Admins Route Ends Here*********************************


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('contacts', ContactController::class)->only(['index','show','destroy']);
});

//******************************************************************************** */

// Student exam routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/exam', [App\Http\Controllers\StudentController::class, 'exam'])->name('student.exam');
    Route::post('/student/exam/submit', [App\Http\Controllers\StudentController::class, 'submitExam'])->name('student.exam.submit');
    Route::get('/student/exam/select', function(){
        return view('student.exam-select');
    })->name('student.exam.select');

    Route::get('/student/exam', [App\Http\Controllers\StudentController::class, 'exam'])->name('student.examt');
    // Route::post('/student/exam/submit', [App\Http\Controllers\StudentController::class, 'submitExam'])->name('student.exam.submit');


});

// Admin Question CRUD
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('questions', App\Http\Controllers\QuestionController::class);
});

//***************************************************************************** */

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:teacher'])->group(function(){
    Route::get('/teacher/dashboard', function(){
        return view('teacher.dashboard');
    })->name('teacher.dashboard');
});

Route::middleware(['auth', 'role:teacher'])->group(function(){
    Route::get('/teacher/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');
});

Route::middleware(['auth', 'role:student'])->group(function(){
    Route::get('/student/dashboard', function(){
        return view('student.dashboard');
    })->name('teacher.dashboard');
});
Route::middleware(['auth', 'role:student'])->group(function(){
    Route::get('/student/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
});

Route::middleware(['auth', 'role:parent'])->group(function(){
    Route::get('/parent/dashboard', function(){
        return view('parent.dashboard');
    })->name('parent.dashboard');
});

Route::middleware(['auth', 'role:parent'])->group(function(){
    Route::get('/parent/dashboard', [App\Http\Controllers\Parent\DashboardController::class, 'index'])->name('parent.dashboard');
});

// Route::middleware(['auth'])->group(function() {
//     // Route::get('/home', [HomeController::class, 'index'])->name('home');

//     // Admin
//     Route::prefix('admin')->middleware('can:admin')->group(function(){
//         Route::get('/', [DashboardController::class, 'index']);
//         Route::resource('books', BookController::class);
//         Route::get('books/export/pdf', [BookController::class, 'exportPdf'])->name('books.export.pdf');
//         // other admin routes
//     });

//     // Teacher
//     Route::prefix('teacher')->middleware('can:teacher')->group(function(){
//         Route::resource('teacher', TeacherController::class);
//     });

//     // Student
//     Route::prefix('student')->middleware('can:student')->group(function(){
//         Route::resource('student', StudentController::class);
//     });

//     // Parent
//     Route::prefix('parent')->middleware('can:parent')->group(function(){
//         Route::resource('parent', ParentController::class);
//     });

//     // Exams
//     Route::resource('exams', ExamController::class);
// });

Route::resource('books', BookController::class);
Route::get('books-export/pdf', [BookController::class,'exportPdf'])->name('books.export.pdf');


Route::resource('exams', ExamController::class);
Route::get('exams-export/pdf', [ExamController::class,'exportPdf'])->name('exams.export.pdf');


Route::resource('sessions', SessionController::class);
Route::get('session-export/pdf', [SessionController::class,'exportPdf'])->name('session.export.pdf');


// Admin

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if($role=='admin') return view('dashboard.admin');
    if($role=='teacher') return view('dashboard.teacher');
    if($role=='student') return view('dashboard.student');
    if($role=='parent') return view('dashboard.parent');
})->middleware('auth')->name('dashboard');


// This is main controller YusTech.....

// // Routes For CRUD.......
Route::resource('students', StudentController::class)->middleware('role:admin');
Route::resource('teachers', TeacherController::class)->middleware('role:admin');
Route::resource('parents', ParentController::class)->middleware('role:admin');
Route::resource('classes', ClassController::class)->middleware('role:admin');
Route::resource('books', BookController::class)->middleware('role:admin');
Route::resource('exams', ExamController::class)->middleware('role:teacher');
Route::resource('activities', ActivityController::class)->middleware('role:admin');
Route::resource('sessions', SessionController::class)->middleware('role:admin');
Route::resource('terms', TermController::class)->middleware('role:admin');


// Checkout later...

Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', function () {
    //     $role = auth()->user()->role;
    //     return redirect("/$role/dashboard");
    // });

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('role:admin');
    Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->middleware('role:teacher');
    Route::get('/student/dashboard', [StudentController::class, 'index'])->middleware('role:student');
    Route::get('/parent/dashboard', [ParentController::class, 'index'])->middleware('role:parent');
});
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
    ->middleware(['auth','role:admin'])
    ->name('admin.dashboard');

Route::get('/student/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])
    ->middleware(['auth','role:student'])
    ->name('student.dashboard');