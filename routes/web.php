<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class)->except(['create', 'edit']);
});

Route::get('/manifest.webmanifest', function () {
    return response()
        ->file(public_path('manifest.webmanifest'))
        ->header('Content-Type', 'application/manifest+json');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

