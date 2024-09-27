<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\Ticket\TicketController;
use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AdminController;

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

// customer route 
Route::get('/', [WelcomeController::class, 'index'])->name('index');

Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register']);


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['customer.auth']], function () {
    Route::get('/open-ticket', [TicketController::class, 'showNewTicketForm'])->name('open.ticket');
    Route::post('/tickets/store', [TicketController::class, 'storeNewTicket'])->name('tickets.store');
    Route::get('/tickets', [TicketController::class, 'showTickets'])->name('tickets.list');
    Route::get('/ticket-details/{ticket_id}', [TicketController::class, 'viewTicket'])->name('tickets.show');
    Route::post('/tickets/response', [TicketController::class, 'storeResponse'])->name('tickets.storeResponse');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// admin route 
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::group(['middleware' => ['admin.auth']], function () {
        Route::post('/tickets/list', [AdminController::class, 'showTickets'])->name('admintickets.list');
        Route::get('/ticket-details/{ticket_id}', [AdminController::class, 'viewTicket'])->name('admintickets.show');
        Route::post('/tickets/response', [AdminController::class, 'storeResponse'])->name('admintickets.storeResponse');

        Route::post('/tickets/update-status', [AdminController::class, 'updateStatus'])->name('admintickets.updateStatus');
    });
});
