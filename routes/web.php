<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExportExcelController;
use App\Http\Controllers\ExportPdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Task Routes
    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('task.index')
        ->middleware('can:view,App\Models\Task');

    Route::get('/task/create', [TaskController::class, 'create'])
        ->name('task.create')
        ->middleware('can:create,App\Models\Task');

    Route::post('/task/save', [TaskController::class, 'store'])
        ->name('task.store')
        ->middleware('can:create,App\Models\Task');

    Route::post('/task/search', [TaskController::class, 'search'])
        ->name('task.search')
        ->middleware('can:search,App\Models\Task');

    Route::get('/task/edit/{task}', [TaskController::class, 'edit'])
        ->name('task.edit')
        ->middleware('can:update,task');

    Route::get('/task/delete/{task}', [TaskController::class, 'destroy'])
        ->name('task.delete')
        ->middleware('can:update,task');

    Route::put('/task/update/{task}', [TaskController::class, 'update'])
        ->name('task.update')
        ->middleware('can:update,task');

        Route::put('/task/approve/{task}', [TaskController::class, 'approve'])
        ->name('task.approve')
        ->middleware('can:approveTask,task');

    // Department Routes
    Route::middleware('can:view,App\Models\Department')->group(function () {
        Route::get('/departments', [DepartmentController::class, 'index'])
            ->name('department.index');

        Route::get('/department/create', [DepartmentController::class, 'create'])
            ->name('department.create')
            ->middleware('can:create,App\Models\Department');

        Route::post('/department/save', [DepartmentController::class, 'store'])
            ->name('department.store')
            ->middleware('can:create,App\Models\Department');
    });

    // export task routes
    Route::get('/task/export/excel', [ExportExcelController::class, 'exportDailyTasks'])
        ->name('task.export.excel')
        ->middleware('can:exportDailyTasks,App\Models\Task');

    Route::get('/task/export/pdf', [ExportPdfController::class, 'exportDailyTasks'])
        ->name('task.export.pdf')
        ->middleware('can:exportDailyTasks,App\Models\Task');
});

require __DIR__ . '/auth.php';
