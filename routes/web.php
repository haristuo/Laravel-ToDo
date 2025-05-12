<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::redirect('/', '/todos');
Route::resource('todos', TodoController::class);