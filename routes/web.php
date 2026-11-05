<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\AgendamentoController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    // O primeiro administrador é criado apenas quando ainda não existe nenhum.
    Route::get('/primeiro-acesso', [AuthController::class, 'showFirstAdmin'])
        ->name('admin.first.create');
    Route::post('/primeiro-acesso', [AuthController::class, 'storeFirstAdmin'])
        ->name('admin.first.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clientes', ClienteController::class);
    Route::resource('enderecos', EnderecoController::class);
    Route::resource('agendamentos', AgendamentoController::class);

    Route::get('/administradores/cadastrar', [AdminController::class, 'create'])
        ->name('admins.create');
    Route::post('/administradores', [AdminController::class, 'store'])
        ->name('admins.store');
});
