<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\SchedulesController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\Admin\UserController;


 
// Halaman beranda (opsional)
Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('cinemas', CinemaController::class);
    Route::resource('movies', MovieController::class);
    Route::resource('schedules', SchedulesController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('seats', SeatController::class);
});

Route::get('/schedules/{id}/seats', [SeatController::class, 'showPicker'])->name('seats.picker');
Route::post('/schedules/{id}/seats/reserve', [SeatController::class, 'reserve'])->name('seats.reserve');
Route::get('/seats/status/{schedule_id}', [SeatController::class, 'seatStatus']);

Route::get('/seats/{schedule}', [SeatController::class, 'index'])->name('seats.index');
Route::post('/seats/book', [SeatController::class, 'book'])->name('seats.book');
Route::get('/get-seats/{schedule_id}', [TicketController::class, 'getSeats']);


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
});

Route::get('/films', [FilmController::class, 'index'])->name('films.index');







