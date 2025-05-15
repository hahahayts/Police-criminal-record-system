<?php

use App\Http\Controllers\CrimeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/manage-users',[PagesController::class, 'manageUsers'])->name('manage.users');
    Route::get('/suspects',[PagesController::class, 'suspects'])->name('suspects');
    Route::get('/reports', [PagesController::class, 'reports'])->name('reports');
    Route::get('/view-crime/{id}',[PagesController::class, 'viewReport'])->name('view.crime');


    Route::post('/create-report',[CrimeController::class, 'store'])->name('create.report');
    Route::delete('/delete/report/{id}',[CrimeController::class,'delete'])->name('delete.report');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
