<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;



use App\Http\Controllers\StockController;
use App\Http\Controllers\QuickSaleController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Dashboard - only for authenticated users
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::resource('invoices', InvoiceController::class);
Route::resource('products', ProductController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// فاکتورها
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');

// انبار
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/stocks/in', [StockController::class, 'in'])->name('stocks.in');
Route::get('/stocks/out', [StockController::class, 'out'])->name('stocks.out');

// فروش سریع
Route::get('/quick-sale', [QuickSaleController::class, 'index'])->name('quick-sale');

// اشخاص
Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');

// گزارشات
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

require __DIR__.'/auth.php';
