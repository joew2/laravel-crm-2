<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
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
    Route::post('companies/{company}/categories', [CompanyController::class, 'syncCategories'])
        ->name('companies.categories.sync');

    Route::resource('categories', CategoryController::class);
    Route::get('categories/search', [CategoryController::class, 'search'])
        ->name('categories.search');

    Route::resource('contacts', ContactController::class);
    Route::get('companies/{company}/contacts', [ContactController::class, 'companyContacts'])
        ->name('companies.contacts');
});
