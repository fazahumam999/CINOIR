<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CinemaController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\SchedulesController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\SeatController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\CinemasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; //aku nambahin ini
use App\Http\Middleware\PreventBackHistory; //aku nambahin ini
use App\Http\Controllers\Admin\BannerController; //aku nambahin ini
use Illuminate\Support\Facades\Auth; //aku nambahin ini


 
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
    Route::resource('banners', BannerController::class);
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

Route::get('/films/now-showing', [FilmController::class, 'nowShowing'])->name('films.now_showing');
Route::get('/films/coming-soon', [FilmController::class, 'comingSoon'])->name('films.coming_soon');

Route::get('/cinemas', [CinemasController::class, 'index'])->name('cinemas.index');

// aku nambahin ini

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/banners');
    }

    return back()->with('error', 'Email atau password salah.');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'Anda berhasil logout.');
})->name('logout');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/banners', BannerController::class)->names('admin.banners');

});

Route::middleware(['auth', PreventBackHistory::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('banners.index');
});








