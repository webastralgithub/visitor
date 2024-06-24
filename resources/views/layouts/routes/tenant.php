<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Middleware\TenentAuthenticate;

use App\Http\Controllers\Tenant\Authentication;
use App\Http\Controllers\Tenant\Webhook;
use App\Http\Controllers\Tenant\Dashboard;
use App\Http\Controllers\Tenant\CustomerController;
use App\Http\Controllers\Tenant\LeadController;


/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::middleware(['auth'])->group(function() {
        Route::get('/', [Dashboard::class, 'show'])->name('dashboard');
        Route::get('/customers', [CustomerController::class, 'show'])->name('customerList');
        Route::get('/customer/create', [CustomerController::class, 'createForm'])->name('createCustomerForm');
        Route::post('/customer/create', [CustomerController::class, 'save'])->name('saveCustomer');
        Route::get('/customer/{id}', [CustomerController::class, 'showEdit'])->name('showEdit');
        Route::post('/customer/{id}', [CustomerController::class, 'update'])->name('update');
        
        Route::get('/leads', [LeadController::class, 'index'])->name('showLeads');
        Route::get('/lead/{id}', [LeadController::class, 'showLeadAssociate'])->name('showLeadAssociate');
    });
    Route::get('login', [Authentication::class, 'showLogin'])->name('login');
    Route::post('login', [Authentication::class, 'login'])->name('loginProcess');
    Route::get('logout', [Authentication::class, 'logout'])->name('logout');
    
    Route::post('webhook', [Webhook::class, 'webhook'])->name('webhook');
});
