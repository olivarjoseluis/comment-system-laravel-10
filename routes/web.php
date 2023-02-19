<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', 'dashboard');

Route::get('/dashboard', function () {

  $comments = \App\Models\Comment::with('user', 'replies.user')
    ->orderBy('id', 'DESC')
    ->paginate();
  return view('dashboard', ['comments' => $comments]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('comments', [CommentController::class, 'store'])
  ->name('comments.store')
  ->middleware('auth');

Route::post('replies/{comment}', [ReplyController::class, 'store'])
  ->name('replies.store')
  ->middleware('auth');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
