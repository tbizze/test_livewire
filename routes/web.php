<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Documento\DocDespesaIndex;
use App\Livewire\Documento\DocReceitaIndex;
use App\Livewire\Documento\DocTarBancoIndex;
use App\Livewire\Documento\MovTitularIndex;
use App\Livewire\Previsao\PrevDespesaIndex;
use App\Livewire\Previsao\PrevReceitaIndex;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/prev/despesas', PrevDespesaIndex::class)->name('prev.despesas.index');
    Route::get('/prev/receitas', PrevReceitaIndex::class)->name('prev.receitas.index');
    
    Route::get('/doc/despesas', DocDespesaIndex::class)->name('doc.despesas.index');
    Route::get('/doc/receitas', DocReceitaIndex::class)->name('doc.receitas.index');
    Route::get('/doc/tarifas', DocTarBancoIndex::class)->name('doc.tarifas.index');
    Route::get('/doc/mov-titular', MovTitularIndex::class)->name('doc.mov-titular.index');
});


Route::get('/test', [HomeController::class, 'test']);