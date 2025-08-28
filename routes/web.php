<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;

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

    // CRM Routes
    Route::resource('companies', CompanyController::class);
    Route::delete('companies/{company}/files/{file}', [CompanyController::class, 'deleteFile'])
        ->name('companies.files.delete');

    Route::resource('contacts', ContactController::class);
    Route::get('companies/{company}/contacts', [ContactController::class, 'companyContacts'])
        ->name('companies.contacts');
});
