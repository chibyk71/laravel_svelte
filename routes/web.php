<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/welcome', function () {
    return Inertia::render('Welcome');
})->name("welcome");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', [HomeController::class, 'show'])->name('home');
Route::post('/', [HomeController::class, 'fetch'])->name('home.fetch');

Route::get("/create", [PostController::class, "show"])->name("post");
Route::post("/create",[PostController::class, "store"])->name("post.store");

Route::post('/like/{id}', [LikeController::class, "store"]);

require __DIR__.'/auth.php';
