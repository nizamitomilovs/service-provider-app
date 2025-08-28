<?php

use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProviderController::class, 'index'])->name('providers.index');
Route::get('/providers/{id}', [ProviderController::class, 'show'])->name('providers.show');
