<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/carros', [CarroController::class, 'carros'])->name('carros.index');
Route::get('/listacarros', [CarroController::class, 'listar'])->name('carros.lista');
Route::get('/salvarcarro', [CarroController::class, 'salvarForm'])->name('carros.salvar.form');
Route::post('/salvarcarro', [CarroController::class, 'salvar'])->name('carros.store');
Route::get('/alterarcarro', [CarroController::class, 'alterarForm'])->name('carros.alterar.form');
Route::get('/alterarcarro/buscar-placa', [CarroController::class, 'buscarPorPlaca'])->name('carros.buscar.placa');
Route::put('/alterarcarro', [CarroController::class, 'alterar'])->name('carros.update');
Route::get('/deletarcarro', [CarroController::class, 'deletarForm'])->name('carros.deletar.form');
Route::delete('/deletarcarro', [CarroController::class, 'deletar'])->name('carros.destroy');
Route::get('/emitir-nfse/{id}', [CarroController::class, 'emitirNfse'])->name('emitir.nfse');
Route::post('/emitir-nfse/{id}/cliente', [CarroController::class, 'salvarDadosClienteNfse'])->name('emitir.nfse.cliente');
Route::get('/faturas', [InvoiceController::class, 'create'])->name('invoice.create');
Route::post('/processar-pdf', [InvoiceController::class, 'generate'])->name('invoice.pdf');
Route::get('/orcamentos', [InvoiceController::class, 'createBudget'])->name('budget.create');
Route::post('/processar-orcamento-pdf', [InvoiceController::class, 'generateBudget'])->name('budget.pdf');
require __DIR__.'/auth.php';
