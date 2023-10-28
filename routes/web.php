<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchInventoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Models\Transfer;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');

Route::resource('/users', UserController::class)->middleware(['auth','role:admin']);
Route::resource('/branches', BranchController::class)->middleware(['auth','role:admin']);
Route::resource('/inventories', BranchInventoryController::class)->middleware(['auth','role:admin']);
Route::resource('/products', ProductController::class)->middleware(['auth','role:admin']);
Route::resource('/categories', CategoryController::class)->middleware(['auth','role:admin']);
Route::resource('/transfers', TransferController::class)->middleware(['auth','role:carrier,admin']);
Route::resource('/sales', SaleController::class)->middleware(['auth','role:seller,admin']);

require __DIR__.'/auth.php';
