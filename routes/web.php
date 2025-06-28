<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SeatController;
 
// Halaman beranda (opsional)
Route::get('/', function () {
    return view('welcome');
});


// Resource routes
Route::resource('cinemas', CinemaController::class);
Route::resource('movies', MovieController::class);
Route::resource('schedules', SchedulesController::class);
Route::resource('tickets', TicketController::class);
Route::resource('users', UserController::class);

Route::get('/schedules/{id}/seats', [SeatController::class, 'showPicker'])->name('seats.picker');
Route::post('/schedules/{id}/seats/reserve', [SeatController::class, 'reserve'])->name('seats.reserve');


