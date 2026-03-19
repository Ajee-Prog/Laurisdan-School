<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FrontHomePage\LaurisdanPageController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDashboardController;

use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\QuestionController;
// Refactors Exam Controller
use App\Http\Controllers\Admin\AdminExamController;
use App\Http\Controllers\Teacher\TeacherExamController;
use App\Http\Controllers\Student\StudentExamController;



use App\Http\Controllers\HomeController;



use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ParentAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SuperAdminController;

// Route::get('/', function () {
//     return view('laurisdan.welcomes');
// });

// Route::get('/', [LaurisdanPageController::class, 'index']);
Route::get('/', [LaurisdanPageController::class, 'index'])->name('home');
Route::get('/about', [LaurisdanPageController::class, 'about'])->name('about');
Route::get('/contact', [LaurisdanPageController::class, 'contact'])->name('contact');
Route::post('/contact', [LaurisdanPageController::class, 'sendContact'])->name('contact.send');

Route::get('/school-news', [NewsController::class, 'publicNews'])->name('news.public');
Route::get('/school-news/{id}', [NewsController::class, 'singleNews'])->name('news.single');



Route::get('/superadmin/login', [SuperAdminController::class, 'loginForm'])->name('superadmin.login');

Route::post('/superadmin/login', [SuperAdminController::class, 'login'])->name('superadmin.login.post');

// Student Login
Route::get('/student/login', [StudentAuthController::class,'showLoginForm'])->name('student.login');

Route::post('/student/login', [StudentAuthController::class,'login'])->name('student.login.submit');

Route::post('/student/logout', [StudentAuthController::class,'logout'])->name('student.logout');

Auth::routes();


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USERS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {



    /*
    |--------------------------------------------------------------------------
    | MAIN DASHBOARD ROUTE (auto-redirect by role) redirect/entry (DashboardController handles role routing)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index']) ->name('dashboard');
    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN ROUTES (manage everything)
    |--------------------------------------------------------------------------
    */

    // Route::middleware(['role:admin,superadmin,teacher'])->group(function () {
    //     Route::resource('exams', ExamController::class);
    // });




    Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {

        // Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])
            ->name('superadmin.dashboard');

        // Manage Admins
        // Route::resource('superadmin/admins', App\Http\Controllers\Admin\UserController::class);

        // Manage Teachers
        // Route::resource('superadmin/teachers', App\Http\Controllers\TeacherController::class);

        // Manage Students
        // Route::resource('superadmin/students', App\Http\Controllers\StudentController::class);

        // Manage Parents
        // Route::resource('superadmin/parents', App\Http\Controllers\ParentController::class);

        // Manage Classes
        // Route::resource('superadmin/classes', App\Http\Controllers\ClassController::class);

        // Manage Sessions
        // Route::resource('superadmin/sessions', App\Http\Controllers\SessionController::class);

        // Manage Terms
        // Route::resource('superadmin/terms', App\Http\Controllers\TermController::class);

        // Manage Subjects
        // Route::resource('superadmin/subjects', App\Http\Controllers\SubjectController::class);

        // Manage Exams
        // Route::resource('superadmin/exams', App\Http\Controllers\ExamController::class);

        // Manage School Fees
        // Route::resource('superadmin/fees', App\Http\Controllers\FeeController::class);
        // Route::resource('news', NewsController::class);

    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES (manage everything)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth','role:superadmin,admin'])->prefix('admin')->group(function(){

        // Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

        Route::resource('students', StudentController::class);
        Route::resource('teachers', TeacherController::class);
        Route::get('/teachers/pdf', [TeacherController::class, 'exportPdf'])->name('teachers.pdf');
        // Exams & Questions
        Route::resource('exams', ExamController::class);
        Route::resource('parents', ParentController::class);
        Route::resource('classes', ClassController::class);
        Route::resource('books', BookController::class);
        Route::resource('activities', ActivityController::class);
        Route::resource('sessions', SessionController::class);
        Route::resource('terms', TermController::class);
        Route::resource('subjects', SubjectController::class);

        Route::resource('teacher-attendance', TeacherAttendanceController::class);
        Route::resource('student-attendance', StudentAttendanceController::class);
        Route::resource('transporters', TransporterController::class);

        //     Route::get('/admin/questions', [QuestionController::class, 'index'])->name('questions.index');
        // Route::get('/admin/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        // Route::post('/admin/questions/store', [QuestionController::class, 'store'])->name('questions.store');

        Route::get('/exams/{id}/toggle-status', [ExamController::class, 'toggleStatus'])->name('exams.toggle');



        // Question Bank (linked to exam)
        Route::get('/exams/{exam}/questions', [QuestionController::class, 'index'])->name('exams.questions.index');
        Route::get('/exams/{exam}/questions/create', [QuestionController::class, 'create'])->name('exams.questions.create');
        // Route::get('/exams/{exam}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('/exams/{exam}/questions', [QuestionController::class, 'store'])->name('exams.questions.store');

        Route::resource('questions', QuestionController::class)->except(['create', 'store']);

        // Refactor Exam controller start here
            Route::get('/exams', [AdminExamController::class,'index'])->name('admin.exams.index');
            Route::get('/exams/create', [AdminExamController::class,'create'])->name('admin.exams.create');
            Route::post('/exams', [AdminExamController::class,'store'])->name('admin.exams.store');
            // Route::get('/exams/{exam}', [AdminExamController::class,'show'])->name('admin.exams.show');
            Route::get('/exams/{exam}', [ExamController::class,'show'])->name('admin.exams.show');
            Route::post('/exams/{exam}/toggle', [AdminExamController::class,'toggle'])->name('admin.exams.toggle');
        // Refactors Exam Controller Ends


        Route::get('students-export-pdf', [App\Http\Controllers\StudentController::class, 'exportPdf'])->name('students.export.pdf');
        Route::get('books/export/pdf', [BookController::class, 'exportPdf'])->name('books.export.pdf');
        Route::get('session-export/pdf', [SessionController::class,'exportPdf'])->name('session.export.pdf');
        Route::get('exams-export/pdf', [ExamController::class,'exportPdf'])->name('exams.export.pdf');



        // Admin & Superadmin fee routes
        Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
        Route::get('/fees/create', [FeeController::class, 'create'])->name('fees.create');
        Route::post('/fees/store', [FeeController::class, 'store'])->name('fees.store');

        // finance admin dashboard + csv import
        Route::get('/fees/finance-dashboard', [FeeController::class, 'financeDashboard'])->name('fees.finance');
        Route::post('/fees/import-csv', [FeeController::class, 'importCsv'])->name('fees.import.csv');

        // Route::get('/questions/export/csv', [QuestionController::class, 'exportCsv'])->name('questions.export.csv');


        /*
        // To Test a New Question.............but is not needed
        Route::get('/exams/{exam}/questions', [QuestionController::class, 'index'])
        ->name('questions.index');

    Route::get('/exams/{exam}/questions/create', [QuestionController::class, 'create'])
        ->name('questions.create');

    Route::post('/exams/{exam}/questions', [QuestionController::class, 'store'])
        ->name('questions.store');

    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])
        ->name('questions.edit');

    Route::put('/questions/{question}', [QuestionController::class, 'update'])
        ->name('questions.update');

    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])
        ->name('questions.destroy');

        */

    });

        /*
        |--------------------------------------------------------------------------
        | TEACHER ROUTES
        |--------------------------------------------------------------------------
        */
        Route::middleware(['auth','role:teacher,admin'])->group(function () {
            Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
            // Route::get('/teacher/dashboard', [DashboardController::class, 'teacherDashboard'])->name('teacher.dashboard');

        // Teacher can manage exams
        Route::resource('exams', ExamController::class)->except(['show']);
         Route::resource('questions', QuestionController::class);

        //  Refactors Exam start here...***
        Route::get('/exams', [TeacherExamController::class,'index'])->name('teacher.exams.index');
        Route::get('/exams/{exam}', [TeacherExamController::class,'show'])->name('teacher.exams.show');
        // Exam Questions
        // Route::get('/exams/{exam}/questions', [QuestionController::class, 'index'])
        // ->name('questions.index');

        //     Route::get('/exams/{exam}/questions/create', [QuestionController::class, 'create'])
        //         ->name('questions.create');

        //     Route::post('/exams/{exam}/questions', [QuestionController::class, 'store'])
        //         ->name('questions.store');

        //     Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])
        //         ->name('questions.edit');

        //     Route::put('/questions/{question}', [QuestionController::class, 'update'])
        //         ->name('questions.update');

        //     Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])
        //         ->name('questions.destroy');
        });

    /*
    |--------------------------------------------------------------------------
    | STUDENT ROUTES
    |--------------------------------------------------------------------------
    */
    // Route::middleware(['auth:student'])->group(function () {

    //     // Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    //     // Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('dashboard.student');
    //     Route::get('/dashboard/student', [StudentDashboardController::class, 'dashboard'])->name('dashboard.student');
    //     // Route::get('/student/dashboard', [DashboardController::class, 'index'])->name('dashboard.student');


    //     // Student exam list & open
    //     Route::get('/student/exams', [ExamController::class, 'studentExamss'])->name('student.exams');
    //     Route::get('/student/exam/{id}', [ExamController::class, 'studentExamView'])->name('student.exam.view');

    //     // CBT start & submit (POST)
    //     // real exam start below route because route points unto it
    //     Route::get('/student/exam/{id}/start', [ExamController::class, 'startExamCBT'])->name('student.exam.start');
    //     // Route::post('/student/exam/{id}/submit', [ExamController::class, 'submitCBT'])->name('student.exam.submit');

    //     // Route::get('/student/exam', [ExamController::class, 'studentExams'])->name('student.exam');
    //     Route::get('/student/exam/{subject}', [ExamController::class, 'studentExams'])->name('student.exam');
    //     // real exam start below route
    //     Route::get('/student/exam/start/{subject}', [ExamController::class, 'startExams'])->name('exam.start');
    //     Route::post('/student/exam/submit', [ExamController::class, 'submitExam'])->name('exam.submit');

    //     Route::get('/student/books', [BookController::class, 'studentBooks'])->name('student.books');
    //     Route::get('/student/results', [StudentController::class, 'results'])->name('student.results');

    //     // ------------------------------------ Tryin new method-----------------------





    // });

    /*
    |--------------------------------------------------------------------------
    | PARENT ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:parent'])->group(function () {
        // Route::get('/parent/dashboard', [ParentController::class, 'index'])->name('parent.dashboard');
        Route::get('/parent/dashboard', [DashboardController::class, 'parentDashboard'])->name('parent.dashboard');
        Route::get('/parent/results', [ParentController::class, 'childResults'])->name('parent.results');
    });



    // Receipt starts

    // receipt + pdf viewing (admins and students who own it)
    Route::get('/fee/{id}/receipt', [FeeController::class, 'receipt'])->name('fee.receipt');
    Route::get('/fee/{id}/receipt/pdf', [FeeController::class, 'receiptPdf'])->name('fee.receipt.pdf');

    // student view of their fee history
    Route::get('/student/fees', [FeeController::class, 'studentHistory'])->name('student.fee.history')->middleware('role:student');

    // receipts ends
}); //General auths admin ends here

// Student with Admission No
    Route::middleware(['auth','role:student'])->group(function () {

        // Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
        // Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('dashboard.student');
        Route::get('/dashboard/student', [StudentDashboardController::class, 'dashboard'])->name('dashboard.student');
        // Route::get('/student/dashboard', [DashboardController::class, 'index'])->name('dashboard.student');


        // Student exam list & open
        Route::get('/student/exams', [ExamController::class, 'studentExamss'])->name('student.exams');
        Route::get('/student/exam/{id}', [ExamController::class, 'studentExamView'])->name('student.exam.view');

        // CBT start & submit (POST)
        // real exam start below route because route points unto it
        Route::get('/student/exam/{id}/start', [ExamController::class, 'startExamCBT'])->name('student.exam.start');
        // Route::get('/student/exam/{exam}/start', [ExamController::class, 'startExamCBT'])->name('student.exam.start');
        // Route::post('/student/exam/{id}/submit', [ExamController::class, 'submitCBT'])->name('student.exam.submit');


        // Route::get('/student/exam', [ExamController::class, 'studentExams'])->name('student.exam');
        // Route::get('/student/exam/{subject}', [ExamController::class, 'studentExams'])->name('student.exam');
        // real exam start below route
        Route::get('/student/exam/{exam}/start', [ExamController::class, 'startExamCBT'])->name('student.exam.start');//this can b used
        // Route::get('/student/exam/start/{subject}', [ExamController::class, 'startExams'])->name('exam.start');
        // Route::post('/student/exam/{id}/submit', [ExamController::class, 'submitCBT'])->name('student.exams.submit');
        Route::post('/student/exam/submit', [ExamController::class, 'submitExam'])->name('student.exams.submit');
        // Route::post('/student/exam/submit', [ExamController::class, 'submitExam'])->name('exam.submit');

        // **************Refactors Exam against future bugs*************
        Route::get('/exams', [StudentExamController::class,'index'])->name('student.exams');

    Route::get('/exam/{exam}/view', [StudentExamController::class,'view'])->name('student.exam.view');

    Route::get('/exam/{exam}/start', [StudentExamController::class,'start'])->name('student.exam.start');

    Route::post('/exam/{exam}/submit', [StudentExamController::class,'submit'])->name('student.exam.submit');
        // ******************Refactors Ends here******************

        Route::get('/student/books', [BookController::class, 'studentBooks'])->name('student.books');
        Route::get('/student/results', [StudentController::class, 'results'])->name('student.results');

        Route::get('/student/profile', [StudentController::class, 'profile'])->name('profile.show');

        // ------------------------------------ Tryin new method-----------------------





    });
// Student with Admission ends here...........................


// Receipt Fee
Route::get('/fee/{id}/receipt', [FeeController::class, 'generateReceipt'])->middleware(['auth','role:super_admin,admin'])
    ->name('fee.receipt');


    // This should be add to the Student route group
 Route::get('/student/fees', [FeeController::class, 'studentHistory'])->middleware(['auth','role:student'])->name('student.fee.history');


//  New Fees to used well correct
// Route::middleware(['auth'])->group(function () {
//     // Admin & Superadmin fee routes
//     Route::middleware(['role:admin,super_admin'])->group(function(){
//         Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
//         Route::get('/fees/create', [FeeController::class, 'create'])->name('fees.create');
//         Route::post('/fees/store', [FeeController::class, 'store'])->name('fees.store');

//         // finance admin dashboard + csv import
//         Route::get('/fees/finance-dashboard', [FeeController::class, 'financeDashboard'])->name('fees.finance');
//         Route::post('/fees/import-csv', [FeeController::class, 'importCsv'])->name('fees.import.csv');
//     });

//     // receipt + pdf viewing (admins and students who own it)
//     Route::get('/fee/{id}/receipt', [FeeController::class, 'receipt'])->name('fee.receipt');
//     Route::get('/fee/{id}/receipt/pdf', [FeeController::class, 'receiptPdf'])->name('fee.receipt.pdf');

//     // student view of their fee history
//     Route::get('/student/fees', [FeeController::class, 'studentHistory'])->name('student.fee.history')->middleware('role:student');
// });
// fee well correct ends
// Now the Error will Disappeared ends here





// // new contact forms route

// // ***************************All Admins Route Start Here*********************************

// // //  Auth controller after logged in
// // Route::middleware('auth')->group(function () {
// //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// // });

// // Route::middleware('auth')->group(function () {
// //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// // });

// Route::resource('students', StudentController::class);
// Route::resource('teachers', TeacherController::class);
// Route::resource('parents', ParentController::class);
// Route::resource('classes', ClassController::class);
// //  Auth controller after logged in


// // // Student Exam
// // Route::middleware(['auth','role:student'])->group(function(){
// //     Route::get('exam/{subject}', [App\Http\Controllers\ExamController::class, 'index'])->name('exam.start');
// //     Route::post('exam/submit', [App\Http\Controllers\ExamController::class, 'submit'])->name('exam.submit');
// //     Route::get('student/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
// // });

// // // Admin
// // Route::middleware(['auth','role:admin'])->group(function(){
// //     Route::get('admin/exam/create', [App\Http\Controllers\ExamController::class, 'create'])->name('admin.exam.create');
// //     Route::post('admin/exam/store', [App\Http\Controllers\ExamController::class, 'store'])->name('admin.exam.store');
// // });

// // Route::middleware(['auth', 'role:admin,teacher'])->group(function() {
// //     Route::resource('students', App\Http\Controllers\StudentController::class);
// //     Route::get('students-export-pdf', [App\Http\Controllers\StudentController::class, 'exportPdf'])->name('students.export.pdf');
// // });
// // // Exam CBT New Routes ends here

// // // Admin routes
// // Route::middleware(['auth', 'role:admin'])->group(function () {
// //     Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// // });

// // // Teacher routes
// // Route::middleware(['auth', 'role:teacher'])->group(function () {
// //     // Route::get('/teacher/dashboard', function () {
// //     //     return view('teacher.dashboard');
// //     // })->name('teacher.dashboard');
// //     Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teacher.dashboard');
// //     Route::resource('classes', ClassController::class);
// //     Route::resource('exams', ExamController::class);
// //     Route::resource('students', StudentController::class);
// // });

// // // Student routes
// // Route::middleware(['auth', 'role:student'])->group(function () {
// //     Route::get('/student/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
// // });

// // // Parent routes
// // Route::middleware(['auth', 'role:parent'])->group(function () {
// //     Route::get('/parent/dashboard', [App\Http\Controllers\ParentController::class, 'dashboard'])->name('parent.dashboard');
// // });

// // // _________ Dashboard routes starts-------------
// // // Admin-only
// // Route::middleware(['auth', 'role:admin'])->group(function () {
// //     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// // });

// // // Teacher-only
// // Route::middleware(['auth', 'role:teacher'])->group(function () {
// //     Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teacher.dashboard');
// // });

// // // Student-only
// // Route::middleware(['auth', 'role:student'])->group(function () {
// //     Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
// // });

// // _________ Dashboard routes ends here -------------


// // // _________ indexs routes -------------
// // Route::middleware(['auth', 'role:teacher'])->group(function(){
// //     Route::get('/teacher/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');
// // });

// // Route::middleware(['auth', 'role:student'])->group(function(){
// //     Route::get('/student/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
// // });

// // Route::middleware(['auth', 'role:parent'])->group(function(){
// //     Route::get('/parent/dashboard', [App\Http\Controllers\Parent\DashboardController::class, 'index'])->name('parent.dashboard');
// // });




// // _________ indexs routes ends -------------



// // ***************************All Admins Route Ends Here*********************************


// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('contacts', ContactController::class)->only(['index','show','destroy']);
// });

// //******************************************************************************** */

// // Student exam routes
// Route::middleware(['auth', 'role:student'])->group(function () {
//     Route::get('/student/exam', [App\Http\Controllers\StudentController::class, 'exam'])->name('student.exam');
//     Route::post('/student/exam/submit', [App\Http\Controllers\StudentController::class, 'submitExam'])->name('student.exam.submit');
//     Route::get('/student/exam/select', function(){
//         return view('student.exam-select');
//     })->name('student.exam.select');

//     Route::get('/student/exam', [App\Http\Controllers\StudentController::class, 'exam'])->name('student.exam');
//     Route::post('/student/exam/submit', [App\Http\Controllers\StudentController::class, 'submitExam'])->name('student.exam.submit');


// });

// // Admin Question CRUD
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::resource('questions', App\Http\Controllers\QuestionController::class);
// });

// //***************************************************************************** */

// // Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route::middleware(['auth', 'role:admin'])->group(function(){
//     Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// });

// Route::middleware(['auth', 'role:teacher'])->group(function(){
//     Route::get('/teacher/dashboard', function(){
//         return view('teacher.dashboard');
//     })->name('teacher.dashboard');
// });

// Route::middleware(['auth', 'role:teacher'])->group(function(){
//     Route::get('/teacher/dashboard', [App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');
// });

// Route::middleware(['auth', 'role:student'])->group(function(){
//     Route::get('/student/dashboard', function(){
//         return view('student.dashboard');
//     })->name('teacher.dashboard');
// });
// Route::middleware(['auth', 'role:student'])->group(function(){
//     Route::get('/student/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
// });

// Route::middleware(['auth', 'role:parent'])->group(function(){
//     Route::get('/parent/dashboard', function(){
//         return view('parent.dashboard');
//     })->name('parent.dashboard');
// });

// Route::middleware(['auth', 'role:parent'])->group(function(){
//     Route::get('/parent/dashboard', [App\Http\Controllers\Parent\DashboardController::class, 'index'])->name('parent.dashboard');
// });

// // Route::middleware(['auth'])->group(function() {
// //     // Route::get('/home', [HomeController::class, 'index'])->name('home');

// //     // Admin
// //     Route::prefix('admin')->middleware('can:admin')->group(function(){
// //         Route::get('/', [DashboardController::class, 'index']);
// //         Route::resource('books', BookController::class);
// //         Route::get('books/export/pdf', [BookController::class, 'exportPdf'])->name('books.export.pdf');
// //         // other admin routes
// //     });

// //     // Teacher
// //     Route::prefix('teacher')->middleware('can:teacher')->group(function(){
// //         Route::resource('teacher', TeacherController::class);
// //     });

// //     // Student
// //     Route::prefix('student')->middleware('can:student')->group(function(){
// //         Route::resource('student', StudentController::class);
// //     });

// //     // Parent
// //     Route::prefix('parent')->middleware('can:parent')->group(function(){
// //         Route::resource('parent', ParentController::class);
// //     });

// //     // Exams
// //     Route::resource('exams', ExamController::class);
// // });

// Route::resource('books', BookController::class);
// Route::get('books-export/pdf', [BookController::class,'exportPdf'])->name('books.export.pdf');


// Route::resource('exams', ExamController::class);
// Route::get('exams-export/pdf', [ExamController::class,'exportPdf'])->name('exams.export.pdf');


// Route::resource('sessions', SessionController::class);
// Route::get('session-export/pdf', [SessionController::class,'exportPdf'])->name('session.export.pdf');


// // Admin


// // Route::get('/dashboard', function () {
// //     $role = Auth::user()->role;
// //     if($role=='admin') return view('dashboard.admin');
// //     if($role=='teacher') return view('dashboard.teacher');
// //     if($role=='student') return view('dashboard.student');
// //     if($role=='parent') return view('dashboard.parent');
// // })->middleware('auth')->name('dashboard');


// //  Auth controller after logged in
// // Route::middleware('auth')->group(function () {
// //     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// // });

// /*Route::get('/dashboard', function () {
//     $role = Auth::user()->role;

//     if ($role == 'admin') {
//         return view('dashboard.admin');
//     }

//     if ($role == 'teacher') {
//         $teacher = Teacher::where('user_id', Auth::id())->first();
//         return view('dashboard.teacher', compact('teacher'));
//     }

//     if ($role == 'student') {
//         $student = Student::where('user_id', Auth::id())->first();
//         return view('dashboard.student', compact('student'));
//         // return view('students.dashboard', compact('student'));
//     }

//     if ($role == 'parent') {
//         $parent = ParentModel::where('user_id', Auth::id())->first();
//         return view('dashboard.parent', compact('parent'));
//     }

//     abort(403, 'Unauthorized role');
// })->middleware('auth')->name('dashboard');
// */


// // This is main controller YusTech.....

// // // Routes For CRUD.......
// Route::resource('students', StudentController::class)->middleware('role:admin');
// Route::resource('teachers', TeacherController::class)->middleware('role:admin');
// Route::resource('parents', ParentController::class)->middleware('role:admin');
// Route::resource('classes', ClassController::class)->middleware('role:admin');
// Route::resource('books', BookController::class)->middleware('role:admin');
// Route::resource('exams', ExamController::class)->middleware('role:teacher');
// Route::resource('activities', ActivityController::class)->middleware('role:admin');
// Route::resource('sessions', SessionController::class)->middleware('role:admin');
// Route::resource('terms', TermController::class)->middleware('role:admin');


// // Checkout later...

// Route::middleware(['auth'])->group(function () {
//     // Route::get('/dashboard', function () {
//     //     $role = auth()->user()->role;
//     //     return redirect("/$role/dashboard");
//     // });
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//     // Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('role:admin');
//     Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->middleware('role:teacher');
//     Route::get('/student/dashboard', [StudentController::class, 'index'])->middleware('role:student');
//     Route::get('/parent/dashboard', [ParentController::class, 'index'])->middleware('role:parent');
// });

// Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
//     ->middleware(['auth','role:admin'])
//     ->name('admin.dashboard');

// Route::get('/student/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])
//     ->middleware(['auth','role:student'])
//     ->name('student.dashboard');


//     // I want to clean all my routes here

//     // =========================
// // ADMIN ROUTES
// // =========================

// Route::middleware(['auth','role:admin'])->group(function(){
//         // Route::get('/admin/dashboard', [AdminDashboard::class,'index'])->name('admin.dashboard');




//         Route::resource('students', StudentController::class);
//         Route::resource('teachers', TeacherController::class);
//         Route::get('/teachers/pdf', [TeacherController::class, 'exportPdf'])->name('teachers.pdf');
//         Route::resource('parents', ParentController::class);
//         Route::resource('classes', ClassController::class);
//         Route::resource('books', BookController::class);
//         Route::resource('activities', ActivityController::class);
//         Route::resource('sessions', SessionController::class);
//         // Exams Management
//                 Route::resource('exams', ExamController::class);

//         Route::resource('terms', TermController::class);


//         Route::resource('questions', QuestionController::class);
// });


// // =========================
// // TEACHER ROUTES
// // =========================
// Route::middleware(['auth','role:teacher'])->group(function(){
// // Route::get('/teacher/dashboard', [TeacherDashboard::class,'index'])->name('teacher.dashboard');
// Route::resource('exams', ExamController::class);
// });

// *********************************************************************************************
// // =========================
// // STUDENT ROUTES
// // =========================
// Route::middleware(['auth','role:student'])->group(function(){

//     Route::get('/student/exam', [App\Http\Controllers\StudentController::class, 'exam'])->name('student.exam');
//     Route::post('/student/exam/submit', [App\Http\Controllers\StudentController::class, 'submitExam'])->name('student.exam.submit');
//     Route::get('/student/exam/select', function(){
//         return view('student.exam-select');
//     })->name('student.exam.select');


// // Route::get('/student/dashboard', [StudentDashboard::class,'index'])->name('student.dashboard');

//     Route::get('/student/books', [App\Http\Controllers\StudentController::class, 'books'])->name('student.books');

//     // Route::get('/exam/{subject}', [StudentController::class, 'startExam'])->name('exam.start');
//     // Route::get('/exam', [StudentController::class, 'startExam'])->name('exam.start');
//     // Route::post('exam/submit', [App\Http\Controllers\ExamController::class, 'submit'])->name('exam.submit');
//     // Route::get('student/dashboard', [App\Http\Controllers\StudentController::class, 'index'])->name('student.dashboard');

//     // Route::get('/student/exams', [StudentController::class, 'examList'])->name('student.exams');
//     // Route::get('/student/exam/{examId}', [StudentController::class,'exam'])->name('student.exam');
//     // Route::post('/student/exam/submit', [StudentController::class,'submitExam'])->name('student.exam.submit');
//     // Route::get('/student/exam/select', function(){ return view('student.exam-select'); })->name('student.exam.select');

//     // Route::get('/student/results', [StudentController::class, 'results'])->name('student.results');
//     Route::get('students-export-pdf', [App\Http\Controllers\StudentController::class, 'exportPdf'])->name('students.export.pdf');
// });

// // =========================
// // PARENT ROUTES
// // =========================
// Route::middleware(['auth','role:parent'])->group(function(){
// Route::get('/parent/dashboard', [ParentDashboard::class,'index'])->name('parent.dashboard');
// });

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// /*
// |--------------------------------------------------------------------------
// | AUTHENTICATED USERS
// |--------------------------------------------------------------------------
// */
// Route::middleware(['auth'])->group(function () {

//     /*
//     |--------------------------------------------------------------------------
//     | ADMIN ONLY ROUTES
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware(['role:admin'])->group(function () {




//         // Route::get('/admin/dashboard', function () {
//         //     return view('admin.dashboard');
//         // })->name('admin.dashboard');

//         // Students Management
//         Route::resource('students', StudentController::class);

//         // Teachers Management
//         Route::resource('teachers', TeacherController::class);
//         Route::get('/teachers/pdf', [TeacherController::class, 'exportPdf'])->name('teachers.pdf');   // FIXED!

//         // Parents Management
//         Route::resource('parents', ParentController::class);

//         Route::resource('classes', ClassController::class);
//         Route::resource('books', BookController::class);
//         Route::resource('activities', ActivityController::class);
//         Route::resource('sessions', SessionController::class);

//         // Exams Management
//         Route::resource('exams', ExamController::class);

//         Route::resource('terms', TermController::class);


//         Route::resource('questions', QuestionController::class);
//     });

//     /*
//     |--------------------------------------------------------------------------
//     | TEACHER ROUTES
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware(['role:teacher'])->group(function () {
//         // Route::get('/teacher/dashboard', function () {
//         //     return view('teacher.dashboard');
//         // })->name('teacher.dashboard');

//         // Manage Exams
//         Route::resource('exams', ExamController::class);

//         Route::get('/teacher/exams', [ExamController::class, 'teacherExams'])
//             ->name('teacher.exams');
//     });

//     /*
//     |--------------------------------------------------------------------------
//     | STUDENT ROUTES
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware(['role:student'])->group(function () {

//         // Route::get('/student/dashboard', function () {
//         //     return view('dashboard.student');
//         // })->name('student.dashboard');

//         Route::get('/student/exam', [ExamController::class, 'studentExam'])->name('student.exam');

//         Route::get('/student/exam/start/{subject}', [ExamController::class, 'startExam'])->name('exam.start');

//         Route::post('/student/exam/submit', [ExamController::class, 'submitExam'])->name('exam.submit');

//         Route::get('/student/results', [StudentController::class, 'results'])->name('student.results');




//         Route::get('/student/exam', [App\Http\Controllers\StudentController::class, 'exam'])->name('student.exam');
//         Route::post('/student/exam/submit', [App\Http\Controllers\StudentController::class, 'submitExam'])->name('student.exam.submit');
//         Route::get('/student/exam/select', function(){
//             return view('student.exam-select');
//         })->name('students.exam.select');

//         Route::get('students-export-pdf', [App\Http\Controllers\StudentController::class, 'exportPdf'])->name('students.export.pdf');

//     });
// });

// // Route::middleware(['auth', 'role:admin,teacher'])->group(function() {
// //     Route::resource('students', App\Http\Controllers\StudentController::class);
// //     Route::get('students-export-pdf', [App\Http\Controllers\StudentController::class, 'exportPdf'])->name('students.export.pdf');
// // });



//     // And all clean routes ends here







// // Admin

// Route::get('/dashboard', function () {
//     $role = Auth::user()->role;
//     if($role=='admin') return view('dashboard.admin');
//     if($role=='teacher') return view('dashboard.teacher');
//     if($role=='student') return view('dashboard.student');
//     if($role=='parent') return view('dashboard.parent');
// })->middleware('auth')->name('dashboard');


// Route::get('/dashboard', function () {
//     $role = Auth::user()->role;

//     if ($role == 'admin') {
//         return view('dashboard.admin');
//     }

//     if ($role == 'teacher') {
//         $teacher = Teacher::where('user_id', Auth::id())->first();
//         return view('dashboard.teacher', compact('teacher'));
//     }

//     if ($role == 'student') {
//         $students = Student::where('user_id', Auth::id())->first();
//         return view('dashboard.student', compact('students'));
//     }

//     if ($role == 'parent') {
//         $parent = ParentModel::where('user_id', Auth::id())->first();
//         return view('dashboard.parent', compact('parent'));
//     }

//     abort(403, 'Unauthorized role');
// })->middleware('auth')->name('dashboard');


// This is main controller YusTech.....

// // Routes For CRUD.......

// // // Routes For CRUD.......
// Route::resource('students', StudentController::class)->middleware('role:admin');
// Route::resource('teachers', TeacherController::class)->middleware('role:admin');
// Route::resource('parents', ParentController::class)->middleware('role:admin');
// Route::resource('classes', ClassController::class)->middleware('role:admin');
// Route::resource('books', BookController::class)->middleware('role:admin');
// Route::resource('exams', ExamController::class)->middleware('role:teacher');
// Route::resource('activities', ActivityController::class)->middleware('role:admin');
// Route::resource('sessions', SessionController::class)->middleware('role:admin');
// Route::resource('terms', TermController::class)->middleware('role:admin');
// // Route::resource('students', App\Http\Controllers\StudentController::class)->middleware('role:admin');
// Route::resource('teachers', TeacherController::class)->middleware('role:admin');
// Route::resource('parents', ParentController::class)->middleware('role:admin');
// // Route::resource('classes', App\Http\Controllers\ClassController::class)->middleware('role:admin');
// // Route::resource('books', BookController::class)->middleware('role:admin');
// // Route::resource('exams', App\Http\Controllers\ExamController::class)->middleware('role:teacher');
// Route::resource('activities', ActivityController::class)->middleware('role:admin');
// // Route::resource('sessions', SessionController::class)->middleware('role:admin');
// Route::resource('terms', TermController::class)->middleware('role:admin');


// Checkout later...

// Route::middleware(['auth'])->group(function () {
//     // Route::get('/dashboard', function () {
//     //     $role = auth()->user()->role;
//     //     return redirect("/$role/dashboard");
//     // });

//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('role:admin');
//     Route::get('/teacher/dashboard', [TeacherController::class, 'index'])->middleware('role:teacher');
//     Route::get('/student/dashboard', [App\Http\Controllers\Admin\StudentController::class, 'index'])->middleware('role:student');
//     Route::get('/parent/dashboard', [ParentController::class, 'index'])->middleware('role:parent');
// });
// // Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
// //     ->middleware(['auth','role:admin'])
// //     ->name('admin.dashboard');

// Route::get('/students/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])
//     ->middleware(['auth','role:student'])
//     ->name('student.dashboard');




