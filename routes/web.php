<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
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

//Route::resource('/instructor/schedule', ScheduledClassController::class)->only(['index','create','store','destroy'])->middleware(['auth','role:instructor']);
Route::resource('/users', UserController::class)->middleware(['auth']);
Route::resource('/branches', BranchController::class)->middleware(['auth']);
Route::resource('/suppliers', SupplierController::class)->middleware(['auth']);
Route::resource('/products', ProductController::class)->middleware(['auth']);
Route::resource('/categories', CategoryController::class)->middleware(['auth']);
Route::resource('/transfers', TransferController::class)->middleware(['auth']);
Route::resource('/sales', SaleController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
