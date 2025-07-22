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
use App\Http\Controllers\TicketsController;
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

Route::get('/film/{id}', [FilmController::class, 'show'])->name('film.detail');

Route::get('/tickets/{id}/select-seat', [TicketsController::class, 'selectSeat'])->name('tickets.selectSeat');
Route::get('/get-seats/{schedule_id}', [TicketsController::class, 'getSeats'])->name('tickets.getSeats');

Route::post('/tickets/confirm', [TicketsController::class, 'confirm'])->name('tickets.confirm');
Route::post('/tickets/confirm', [TicketController::class, 'confirm'])->name('tickets.confirm');
Route::post('/tickets/store', [TicketsController::class, 'store'])->name('tickets.store');

Route::get('/cinemas', [CinemasController::class, 'index'])->name('cinemas.index');
Route::get('/cinemas/{cinema}', [CinemasController::class, 'show'])->name('cinemas.show');

Route::get('/tickets/payment', [TicketsController::class, 'payment'])->name('payment.page');
Route::get('/tickets/payment/{order}', [TicketsController::class, 'payment'])->name('payment.page');
Route::post('/tickets/payment', [TicketsController::class, 'payment'])->name('user.tickets.payment');
Route::get('/payment/{id}', [TicketsController::class, 'payment'])->name('user.tickets.payment');
Route::get('/tickets/payment/{id}', [TicketsController::class, 'payment'])->name('user.tickets.payment');

Route::post('/tickets/confirm', [TicketsController::class, 'confirm'])->name('tickets.confirm');
Route::get('/tickets/payment/{id}', [TicketsController::class, 'payment'])->name('user.tickets.payment');
Route::get('/tickets/payment/{ticket}', [TicketsController::class, 'payment'])->name('tickets.payment');
Route::post('/tickets/complete-payment', [TicketsController::class, 'completePayment'])->name('tickets.completePayment');
Route::get('/payment', [TicketsController::class, 'showPaymentPage'])->name('payment.page');
Route::get('/tickets/payment', [TicketsController::class, 'payment'])->name('user.tickets.payment');

Route::post('/tickets/cancel', [TicketsController::class, 'cancel'])->name('tickets.cancel');

Route::get('user/films/{id}', [FilmController::class, 'show'])->name('user.films.show');
Route::post('/user/tickets/complete-payment', [TicketsController::class, 'completePayment'])->name('user.tickets.completePayment');
Route::get('/user/tickets/success', function () {
    return view('user.tickets.success');
})->name('user.tickets.success');

Route::get('/search-movies', [FilmController::class, 'search']);
Route::get('/films/{id}', [FilmController::class, 'show']);
Route::get('/films/{id}', [FilmController::class, 'show'])->name('films.show');
Route::post('/get-cinemas', [FilmController::class, 'getCinemas']);
Route::post('/get-schedules', [FilmController::class, 'getSchedules']);





















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








