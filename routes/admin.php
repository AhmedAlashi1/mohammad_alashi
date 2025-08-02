<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\StudyTypeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LessonSectionController;
use App\Http\Controllers\Admin\CourseMaterialController;
use App\Http\Controllers\Admin\ContactUsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::prefix(LaravelLocalization::setLocale() . '/admin')->middleware(['web'])
    ->name('admin.')
    ->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::middleware('auth:admin')->group(function () {
            // Dashboard
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
            // Logout
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

            Route::resource('admins', AdminController::class);
            //users
            Route::get('users', [UsersController::class, 'index'])->name('users.index');
            Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
            Route::put('users/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

            //cities
            Route::resource('grades', GradeController::class);
            Route::post('grades/toggle-status/{grade}', [GradeController::class, 'toggleStatus'])->name('grades.toggleStatus');
//            Route::post('grades/sort', [GradeController::class, 'sort'])->name('grades.sort');
            Route::post('grades/reorder', [GradeController::class, 'sort'])->name('grades.reorder');


            //semesters
            Route::resource('semesters', SemesterController::class);
            Route::post('semesters/toggle-status/{id}', [SemesterController::class, 'toggleStatus'])->name('semesters.toggleStatus');

            //
            Route::resource('subjects', SubjectController::class);
            Route::post('subjects/toggle-status/{id}', [SubjectController::class, 'toggleStatus'])->name('subjects.toggleStatus');

            //sections
                Route::prefix('subjects/{subject}/sections')->name('subjects.sections.')->group(function () {
                Route::get('/', [LessonSectionController::class, 'index'])->name('index');
                Route::get('/create', [LessonSectionController::class, 'create'])->name('create');
                Route::post('/', [LessonSectionController::class, 'store'])->name('store');
                Route::get('/{section}/edit', [LessonSectionController::class, 'edit'])->name('edit');
                Route::put('/{section}', [LessonSectionController::class, 'update'])->name('update');
                Route::delete('/{section}', [LessonSectionController::class, 'destroy'])->name('destroy');
            });
            Route::post('sections/{section}/toggle-status', [LessonSectionController::class, 'toggleStatus'])->name('sections.toggleStatus');


            Route::prefix('subjects/{subject}/materials')->name('subjects.materials.')->group(function () {
                Route::get('/{type}', [CourseMaterialController::class, 'index'])->name('index'); // type = lesson | note
                Route::get('/{type}/create', [CourseMaterialController::class, 'create'])->name('create');
                Route::post('/{type}', [CourseMaterialController::class, 'store'])->name('store');
                Route::get('/{material}/edit', [CourseMaterialController::class, 'edit'])->name('edit');
                Route::put('/{material}', [CourseMaterialController::class, 'update'])->name('update');
                Route::delete('/{material}', [CourseMaterialController::class, 'destroy'])->name('destroy');
            });
            Route::post('subjects/materials/toggle-status/{id}', [CourseMaterialController::class, 'toggleStatus'])->name('subjects.materials.toggleStatus');


            //orders
            Route::prefix('orders')->name('orders.')->group(function () {
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
                Route::get('/{order}', [OrderController::class, 'show'])->name('show'); // عرض تفاصيل الطلب

        });
    });

