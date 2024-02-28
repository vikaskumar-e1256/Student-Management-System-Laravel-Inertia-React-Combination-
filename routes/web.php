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
    Route::controller(TeacherController::class)->prefix('teacher/')->name('teacher.')->group(function(){
        Route::get('list', 'index')
            ->name('list');
        Route::get('create', 'create')
            ->name('create');
        Route::post('store', 'store')
            ->name('store');
        Route::get('{teacher}/assigned-class-and-subject', 'assignedClassAndSubject')
            ->name('assigned.classAndSubject');
        Route::post('store/class-and-subject/{teacher}', 'storeClassAndSubject')
            ->name('store.classAndSubject');
    });

    // Student Router
    Route::controller(StudentController::class)->prefix('student/')->name('student.')->group(function(){
        Route::get('list', 'index')
            ->name('list');
        Route::get('create', 'create')
            ->name('create');
        Route::post('store', 'store')
            ->name('store');
    });

    // Subject Router
    Route::controller(SubjectController::class)->prefix('subject/')->name('subject.')->group(function(){
        Route::get('list', 'index')
            ->name('list');
        Route::get('create', 'create')
            ->name('create');
        Route::post('store', 'store')
            ->name('store');
    });

});


require __DIR__.'/auth.php';
