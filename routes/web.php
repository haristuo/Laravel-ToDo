<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Models\Todo;

Route::get('/', function () {
    return redirect('/register');
});

//zugang nur wenn man eingeloggt ist
Route::middleware(['auth'])->group(function(){
Route::resource('todos', TodoController::class);
});




Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TodoController::class, 'index'])->name('todos');
    Route::resource('todos', TodoController::class)->except(['index']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
