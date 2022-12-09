<?php

use App\Http\Controllers\EmployerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [EmployerController::class, 'index'])->name("employers.index");

Route::get('/create', function () { return view('employers_create'); })->name("employers_create");

Route::post('/store', [EmployerController::class, 'store'])->name("employers.store");

Route::post('/show', [EmployerController::class, 'show'])->name("employers.show");
