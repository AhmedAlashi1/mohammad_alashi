<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ExaminationController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\BackupController;
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
            Route::resource('users', UsersController::class);

            Route::get('users/{user}/examinations', [ExaminationController::class, 'indexByUser'])->name('users.examinations');
            Route::get('users/{user}/examinations/create', [ExaminationController::class, 'createForUser'])->name('users.examinations.create');
            Route::post('users/{user}/examinations', [ExaminationController::class, 'storeForUser'])->name('users.examinations.storeForUser');
            Route::get('users/{user}/examinations/{examination}/edit', [ExaminationController::class, 'editForUser'])->name('users.examinations.edit');
            Route::put('users/{user}/examinations/{examination}', [ExaminationController::class, 'updateForUser'])->name('users.examinations.update');
            Route::get('users/{user}/examinations/{examination}/prescription', [ExaminationController::class, 'showPrescription'])
                ->name('users.examinations.prescription');

            //inventories
            Route::resource('inventories', InventoryController::class);

            Route::resource('examinations', ExaminationController::class);

            //payments
            Route::get('examinations/{examination}/payments', [PaymentsController::class, 'indexByExamination'])->name('examinations.payments');
            Route::get('examinations/{examination}/payments/create', [PaymentsController::class, 'createPayment'])->name('examinations.payments.create');
            Route::post('examinations/{examination}/payments', [PaymentsController::class, 'storePayment'])->name('examinations.payments.store');
            Route::get('examinations/{examination}/payments/{payment}/edit', [PaymentsController::class, 'editPayment'])->name('examinations.payments.edit');
            Route::put('examinations/{examination}/payments/{payment}', [PaymentsController::class, 'updatePayment'])->name('examinations.payments.update');
            Route::delete('examinations/{examination}/payments/{payment}', [PaymentsController::class, 'destroyPayment'])->name('examinations.payments.destroy');

            Route::resource('payments', PaymentsController::class);


//            Route::get('backup/download', [BackupController::class, 'backupAndDownload'])->name('backup.download');
            Route::get('backup/create', [BackupController::class, 'createBackup'])->name('backup.create');
            Route::get('backup/download', [BackupController::class, 'downloadLatestBackup'])->name('backup.download');

            });
        });

