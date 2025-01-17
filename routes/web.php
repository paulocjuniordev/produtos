<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProductSearch;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/produtos', ProductSearch::class)->name('produtos.index');
});
