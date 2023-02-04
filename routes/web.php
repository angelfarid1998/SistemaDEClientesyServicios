<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::Group(['middleware' => 'auth'], function () {

    Route::get('/clientes-index', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes-crear', [ClienteController::class, 'store'])->name('clientes.stores');
    Route::get('/clientes/show/{id}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::post('eliminarCliente/{id}', [ClienteController::class, 'eliminarObjetivo']);

    Route::post('/clientes', [ClienteController::class, 'AsignarServicios'])->name('clientes.AsignarServicios');
});

Route::Group(['middleware' => 'auth'], function () {

    Route::get('/servicios-index', [ServicioController::class, 'index'])->name('servicios.index');
    Route::get('/servicios', [ServicioController::class, 'create'])->name('servicios.create');
    Route::post('/servicios-crear', [ServicioController::class, 'store'])->name('servicios.stores');
    Route::get('/servicios/show/{id}', [ServicioController::class, 'show'])->name('servicios.show');
    Route::get('/servicios/edit/{id}', [ServicioController::class, 'edit'])->name('servicios.edit');
    Route::put('/servicios/{id}', [ServicioController::class, 'update'])->name('servicios.update');

    Route::post('eliminarServicio/{id}', [ServicioController::class, 'eliminarObjetivo']);
});
