<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SolicitudComisionController;
use App\Http\Controllers\SolicitudViaticoController;
use App\Http\Controllers\AprobacionFiscalizacionController;
use App\Http\Controllers\AprobacionTesoreriaController;
use App\Http\Controllers\ComprobanteEntregadoController;

Route::get('/', [AuthController::class, 'mostrarFormularioLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    // Grupo que permite múltiples roles: administrador y empleado
    Route::middleware('role:administrador,empleado')->group(function () {
        Route::get('viaticos', [SolicitudViaticoController::class, 'index'])->name('solicitudes_viaticos.index');
        Route::get('viaticos/create', [SolicitudViaticoController::class, 'create'])->name('solicitudes_viaticos.create');
        Route::post('viaticos', [SolicitudViaticoController::class, 'store'])->name('solicitudes_viaticos.store');
        Route::get('viaticos/{viatico}/edit', [SolicitudViaticoController::class, 'edit'])->name('solicitudes_viaticos.edit');
        Route::put('viaticos/{viatico}', [SolicitudViaticoController::class, 'update'])->name('solicitudes_viaticos.update');
        Route::delete('viaticos/{viatico}', [SolicitudViaticoController::class, 'destroy'])->name('solicitudes_viaticos.destroy');
        
        
        Route::post('solicitudes_viaticos', [SolicitudViaticoController::class, 'store'])->name('solicitudes_viaticos.store');
        Route::resource('solicitudes', SolicitudComisionController::class);
        Route::get('solicitudes/{solicitud}/edit', [SolicitudComisionController::class, 'edit'])->name('solicitudes.edit');
        Route::put('solicitudes/{solicitud}', [SolicitudComisionController::class, 'update'])->name('solicitudes.update');
    });

    // Grupo específico para administrador
    Route::middleware('role:administrador')->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::post('/usuarios/{usuario}/activar', [UsuarioController::class, 'activate'])->name('usuarios.activate');
    });

    // Grupo específico para fiscalización
    Route::middleware('role:fiscalizacion')->group(function () {
        Route::get('aprobaciones-fiscalizacion', [AprobacionFiscalizacionController::class, 'index'])->name('aprobaciones_fiscalizacion.index');
        Route::get('aprobaciones-fiscalizacion/{id}/edit', [AprobacionFiscalizacionController::class, 'edit'])->name('aprobaciones_fiscalizacion.edit');
        Route::put('aprobaciones-fiscalizacion/{id}', [AprobacionFiscalizacionController::class, 'update'])->name('aprobaciones_fiscalizacion.update');        
    });

    // Grupo específico para tesorería
    Route::middleware('role:tesoreria')->group(function () {
        Route::get('aprobaciones-tesoreria', [AprobacionTesoreriaController::class, 'index'])->name('aprobaciones_tesoreria.index');
        Route::get('aprobaciones-tesoreria/{id}/edit', [AprobacionTesoreriaController::class, 'edit'])->name('aprobaciones_tesoreria.edit');
        Route::put('aprobaciones-tesoreria/{id}', [AprobacionTesoreriaController::class, 'update'])->name('aprobaciones_tesoreria.update');
    });

    // **Dashboard para Todos**
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('comprobantes', [ComprobanteEntregadoController::class, 'index'])->name('comprobantes.index');
    Route::get('comprobantes/{id}/edit', [ComprobanteEntregadoController::class, 'edit'])->name('comprobantes.edit');
    Route::put('comprobantes/{id}', [ComprobanteEntregadoController::class, 'update'])->name('comprobantes.update');
    Route::get('comprobantes/{id}/download-pdf', [ComprobanteEntregadoController::class, 'downloadPdf'])->name('comprobantes.downloadPdf');
    Route::get('comprobantes/{id}/download-xml', [ComprobanteEntregadoController::class, 'downloadXml'])->name('comprobantes.downloadXml');
    Route::get('comprobantes/{id}/view-pdf', [ComprobanteEntregadoController::class, 'viewPdf'])->name('comprobantes.viewPdf');
    
});