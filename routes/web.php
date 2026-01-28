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
    Route::post('invoice/generate-head',[InvoiceController::class,'generate']);
    Route::post('invoice/generate-detail',[InvoiceController::class, 'detail']);
    Route::get('invoice/pdf',[InvoiceController::class, 'getPdf']);
    Route::get('invoice/pdftest',[InvoiceController::class, 'testPdf']);

    Route::get('company', [CompanyController::class, 'index']);
    Route::get('company/{id}/clients', [CompanyController::class, 'clientsByCompany']);

    Route::get('clients',[ClientController::class, 'index']);
});


