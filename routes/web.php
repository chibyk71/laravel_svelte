<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentlikeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReplylikeController;
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

Route::post('/like/{id}/like', [LikeController::class, "store"]);
Route::post('/like/{id}/unlike', [LikeController::class, "destroy"]);

Route::get("/comment/{id}", [CommentController::class, "index"])->name("comment");
Route::post("/comment/{id}", [CommentController::class, "store"])->name("comment.store");

Route::post("/comment/{id}/like", [CommentlikeController::class, "store"])->name("comment.like");
Route::post("/comment/{id}/unlike", [CommentlikeController::class, "destroy"])->name("comment.unlike");

Route::get("/reply/{id}", [ReplyController::class, "index"])->name("reply");
Route::post("/reply/{id}", [ReplyController::class, "store"])->name("reply.store");

Route::post("/reply/{id}/like", [ReplylikeController::class, "store"])->name("reply.like");
Route::post("/reply/{id}/unlike", [ReplylikeController::class, "destroy"])->name("reply.unlike");

require __DIR__.'/auth.php';
