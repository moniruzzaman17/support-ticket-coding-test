<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\Ticket\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [WelcomeController::class, 'index'])->name('index');

Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);

Route::get('/open-ticket', [TicketController::class, 'showNewTicketForm'])->name('open.ticket');
Route::post('/tickets/store', [TicketController::class, 'storeNewTicket'])->name('tickets.store');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['admin.auth']], function () {
    // Admin routes
});

Route::group(['middleware' => ['customer.auth']], function () {
    Route::get('/tickets', [TicketController::class, 'showTickets'])->name('tickets.list');
});

// ticket route