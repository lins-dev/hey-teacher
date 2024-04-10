<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(app()->isLocal()) {
        auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(QuestionController::class)
    ->prefix('/questions')
    ->group(function () {
        Route::post('/', 'store')->name('questions.store');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(VoteController::class)
    ->prefix('/votes')
    ->group(function () {
        Route::post('/like/{question_uuid}', 'like')->name('votes.like');
    });

require __DIR__ . '/auth.php';
