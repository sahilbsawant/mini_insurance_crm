<?php

use App\Models\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
    // dd('hello');
    return view('roles.admin');
});

Route::middleware(['auth', 'role:manager,admin'])->get('/manager', function () {
    return view('roles.manager');
});

Route::middleware(['auth', 'role:agent,manager,admin'])->get('/agent', function () {
    return view('roles.agent');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');

    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
});

Route::post('/clients/{client}/policies', [PolicyController::class, 'store'])
    ->name('policies.store')
    ->middleware('auth');


Route::post('/clients/{client}/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::get('/clients/{client}/tickets/create', function (Client $client) {
    return view('tickets.create', compact('client'));
})->name('tickets.create');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

Route::get('/clients/{client}/tickets/create', function (Client $client) {
    $tickets = $client->tickets()->latest()->get();
    return view('tickets.create', compact('client', 'tickets'));
})->name('tickets.create');

Route::get('/reports/daily-tickets/pdf', [ReportController::class, 'dailyTicketsPDF'])->name('reports.daily.pdf');
Route::get('/reports/daily-tickets/excel', [ReportController::class, 'dailyTicketsExcel'])->name('reports.daily.excel');

Route::get('/reports/policies/pdf', [ReportController::class, 'activePoliciesPDF'])->name('reports.policies.pdf');
Route::get('/reports/policies/excel', [ReportController::class, 'activePoliciesExcel'])->name('reports.policies.excel');



Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');


require __DIR__ . '/auth.php';
