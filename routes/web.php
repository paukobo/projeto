<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TshirtController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware(['auth','verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('cores', [CorController::class, 'admin'])->name('cores');


    // tshirts

    //Route::get('tshirts', [TshirtController::class, 'index'])->name('tshirts');

    //Route::get('tshirts', [TshirtController::class, 'admin_index'])->name('tshirts');
    /*
    Route::get('tshirts/{tshirt}/edit', [TshirtController::class, 'edit'])->name('tshirts.edit')
        ->middleware('can:view,tshirt');
    Route::get('tshirts/create', [TshirtController::class, 'create'])->name('tshirts.create')
        ->middleware('can:create,App\Models\Tshirt');
    Route::post('tshirts', [TshirtController::class, 'store'])->name('tshirts.store')
        ->middleware('can:create,App\Models\Tshirt');
    Route::put('tshirts/{tshirt}', [TshirtController::class, 'update'])->name('tshirts.update')
        ->middleware('can:update,tshirt');
    Route::delete('tshirts/{tshirt}', [TshirtController::class, 'destroy'])->name('tshirts.destroy')
        ->middleware('can:delete,tshirt');
    */
});

//cores
Route::get('cores', [CorController::class, 'index'])->name('cores.index');

// tshirts
Route::get('tshirts', [TshirtController::class, 'index'])->name('tshirt.index');

// carrinho de compras
Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('carrinho/tshirts/{tshirt}', [CarrinhoController::class, 'store_Tshirt'])->name('carrinho.store_Tshirt');
//Route::get('/add-to-cart/{id}', [TshirtController::class, 'getAddToCart'])->name('tshirt.addToCart');

Route::put('carrinho/tshirts/{tshirt}', [CarrinhoController::class, 'update_Tshirt'])->name('carrinho.update_Tshirt');
Route::delete('carrinho/tshirts/{tshirt}', [CarrinhoController::class, 'destroy_Tshirt'])->name('carrinho.destroy_Tshirt');
Route::post('carrinho', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::delete('carrinho', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');


Auth::routes(['register' => true, 'verifiy' => true]);

