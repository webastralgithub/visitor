<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\TenantController;
use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Controllers\Tenant\Dashboard;
use App\Http\Controllers\PaymentController;


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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth');
Route::get('/', [Dashboard::class, 'dashboard'])->name('agency.dashboard')->middleware('auth');

Route::middleware([SuperAdminMiddleware::class])->group(function () {
    Route::get('tenant', [TenantController::class, 'showTenants'])->name('showTenants');
    Route::get('tenant/create', [TenantController::class, 'createTenant'])->name('createTenant');
    Route::post('tenant/create', [TenantController::class, 'saveTenant'])->name('saveTenant');
    Route::get('tenant/edit/{id}', [TenantController::class, 'showUpdateTenant'])->name('updateTenant');
    Route::post('tenant/edit/{id}', [TenantController::class, 'updateTenant'])->name('updateTenant');
    Route::get('tenant/view/{id}', [TenantController::class, 'viewCustomer'])->name('viewCustomer');

    Route::get('invoices', [PaymentController::class, 'invoices'])->name('invoices');
    Route::get('stripe-webhook', [PaymentController::class, 'stripeWebhook'])->name('stripeWebhook');
});

Route::get('login', [Authentication::class, 'showLogin'])->name('login');
Route::post('login', [Authentication::class, 'login'])->name('loginProcess');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');
