<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::group(['middleware' => 'customAuth'], function (){
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('create-ticket', [TicketController::class, 'createTicket'])->name('create.ticket');
    Route::post('store-ticket', [TicketController::class, 'storeTicket'])->name('store.ticket');

    Route::get('edit-ticket', [TicketController::class, 'editTicket'])->name('edit.ticket');
    Route::put('update-ticket', [TicketController::class, 'updateTicket'])->name('update.ticket');

    Route::get('ticket-details', [TicketController::class, 'getTicketDetails'])->name('ticket.details');
//});

Route::get('/', [CustomAuthController::class, 'signOut'])->name('signout');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('ticket-status', [GuestController::class, 'index'])->name('ticket.status');
Route::post('fetch-status', [GuestController::class, 'getTicketDetails'])->name('fetch.status');

Route::get('query-task', [GuestController::class, 'queryTask'])->name('query.task');
Route::post('get-data', [GuestController::class, 'getData'])->name('get.data');
Route::get('file-task', [GuestController::class, 'fileTask'])->name('file.task');


