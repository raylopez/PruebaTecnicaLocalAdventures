<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group(function () {
    Route::get('invoice', [InvoiceController::class,'index']);
    Route::post('invoice/generate',[InvoiceController::class,'generate']);
    Route::get('invoice/{id}/pdf',[InvoiceController::class, 'getPdf']);

    Route::get('company', [CompanyController::class, 'index']);
    Route::get('company/{id}', [CompanyController::class, 'getCompanyyId']);
    Route::get('company/{id}/clients', [CompanyController::class, 'clientsByCompany']);
    Route::get('company/{id}/clients/invoices',[CompanyController::class, 'getClientsInvoices']);

    Route::get('client',[ClientController::class, 'index']);
});


