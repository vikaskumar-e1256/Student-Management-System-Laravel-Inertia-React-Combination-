<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teacher\TeacherController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Teacher Router
    Route::prefix('teacher/')->group(function(){
        Route::get('list', [TeacherController::class, 'index'])
            ->name('teacher.list');
        Route::get('create', [TeacherController::class, 'create'])
            ->name('teacher.create');
        Route::post('store', [TeacherController::class, 'store'])
            ->name('teacher.store');
        Route::get('{teacher}/assigned-class-and-subject', [TeacherController::class, 'assignedClassAndSubject'])
            ->name('teacher.assigned.classAndSubject');
        Route::post('store/class-and-subject/{teacher}', [TeacherController::class, 'storeClassAndSubject'])
            ->name('teacher.store.classAndSubject');
    });

    // Student Router
    Route::prefix('student/')->group(function(){
        Route::get('list', [StudentController::class, 'index'])
            ->name('student.list');
        Route::get('create', [StudentController::class, 'create'])
            ->name('student.create');
        Route::post('store', [StudentController::class, 'store'])
            ->name('student.store');
    });

    // Subject Router
    Route::prefix('subject/')->group(function(){
        Route::get('list', [SubjectController::class, 'index'])
            ->name('subject.list');
        Route::get('create', [SubjectController::class, 'create'])
            ->name('subject.create');
        Route::post('store', [SubjectController::class, 'store'])
            ->name('subject.store');
    });

});


require __DIR__.'/auth.php';
