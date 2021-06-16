<?php

use App\Mail\MailTester;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrecoController;
use App\Http\Controllers\TshirtController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EncomendaController;
use App\Http\Controllers\EstatisticasController;

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

Route::get('/', [PageController::class, 'index'])->name('home');


Route::middleware(['auth','verified'])->prefix('admin')->name('admin.')->group(function () {

    //sidebar
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('cores', [CorController::class, 'admin'])->name('cores');

    Route::get('categorias', [CategoriaController::class, 'admin'])->name('categorias');

    Route::get('tshirts', [TshirtController::class, 'admin_index'])->name('tshirts');


    // admininstração de users
    Route::get('users', [UserController::class, 'admin'])->name('users')
        ->middleware('can:viewAny,App\Models\User');
    Route::get('users/{user}/view', [UserController::class, 'view'])->name('users.view')
        ->middleware('can:view,user');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')
        ->middleware('can:view,user');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')
        ->middleware('can:create,App\Models\User');
    Route::post('users', [UserController::class, 'store'])->name('users.store')
        ->middleware('can:create,App\Models\User');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')
        ->middleware('can:update,user');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')
        ->middleware('can:delete,user');
    Route::delete('users/{user}/foto', [UserController::class, 'destroy_foto'])->name('users.foto.destroy')
        ->middleware('can:update,user');
    Route::get('users/{user}', [UserController::class, 'block'])->name('users.block')
        ->middleware('can:block,user');

    // admininstração de clientes
    Route::get('clientes', [ClienteController::class, 'admin'])->name('clientes')
        ->middleware('can:viewAny,App\Models\Cliente');
    Route::get('clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit')
        ->middleware('can:view,cliente');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')
        ->middleware('can:update,cliente');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy')
        ->middleware('can:delete,cliente');
    Route::delete('clientes/{cliente}/foto', [ClienteController::class, 'destroy_foto'])->name('clientes.foto.destroy')
        ->middleware('can:update,cliente');

    Route::get('users/edit/Password', [UserController::class, 'editPassword'])->name('users.editPassword');
    Route::patch('users/update/Password', [UserController::class, 'updatePassword'])->name('users.updatePassword');


    // administração de tshirts
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


    // admininstração de cores
    Route::get('cores', [CorController::class, 'admin'])->name('cores');
    Route::get('cores/{cor}/edit', [CorController::class, 'edit'])->name('cores.edit')
        ->middleware('can:view,cor');
    Route::get('cores/create', [CorController::class, 'create'])->name('cores.create')
        ->middleware('can:create,App\Models\Cor');
    Route::post('cores', [CorController::class, 'store'])->name('cores.store')
        ->middleware('can:create,App\Models\Cor');
    Route::put('cores/{cor}', [CorController::class, 'update'])->name('cores.update')
        ->middleware('can:update,cor');
    Route::delete('cores/{cor}', [CorController::class, 'destroy'])->name('cores.destroy')
        ->middleware('can:delete,cor');


    // admininstração de categorias
    Route::get('categorias', [CategoriaController::class, 'admin'])->name('categorias');
    Route::get('categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit')
        ->middleware('can:view,categoria');
    Route::get('categorias/create', [CategoriaController::class, 'create'])->name('categorias.create')
        ->middleware('can:create,App\Models\Categoria');
    Route::post('categorias', [CategoriaController::class, 'store'])->name('categorias.store')
        ->middleware('can:create,App\Models\Categoria');
    Route::put('categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update')
        ->middleware('can:update,categoria');
    Route::delete('categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')
        ->middleware('can:delete,categoria');

    // admininstração de preços
    Route::get('precos', [PrecoController::class, 'admin'])->name('precos');
    Route::get('precos/{preco}/edit', [PrecoController::class, 'edit'])->name('precos.edit')
        ->middleware('can:view,preco');
    Route::put('precos/{preco}', [PrecoController::class, 'update'])->name('precos.update')
        ->middleware('can:update,preco');



    // admininstração de encomendas
    Route::get('encomendas', [EncomendaController::class, 'admin'])->name('encomendas');
    Route::get('encomendas/{encomenda}/edit', [EncomendaController::class, 'edit'])->name('encomendas.edit');
        //->middleware('can:view,encomenda');
    Route::get('encomendas/create', [EncomendaController::class, 'create'])->name('encomendas.create');
        //->middleware('can:create,App\Models\Encomenda');
    Route::post('encomendas', [EncomendaController::class, 'store'])->name('encomendas.store');
        //->middleware('can:create,App\Models\Encomenda');
    Route::put('encomendas/{encomenda}', [EncomendaController::class, 'update'])->name('encomendas.update');
        //->middleware('can:update,encomenda');
    Route::delete('encomendas/{encomenda}', [EncomendaController::class, 'destroy'])->name('encomendas.destroy');
        //->middleware('can:delete,encomenda');

    //admininstração de estampas/catalogo
    Route::get('catalogo', [CatalogoController::class, 'admin'])->name('catalogo');
    Route::get('catalogo/{estampa}/edit', [CatalogoController::class, 'edit'])->name('catalogo.estampas.edit');
        //->middleware('can:view,estampa');
    Route::get('catalogo/create', [CatalogoController::class, 'create'])->name('catalogo.estampas.create');
        //->middleware('can:create,App\Models\Estampa');
    Route::post('catalogo', [CatalogoController::class, 'store'])->name('catalogo.estampas.store');
        //->middleware('can:create,App\Models\Estampa');
    Route::put('catalogo/{estampa}', [CatalogoController::class, 'update'])->name('catalogo.estampas.update');
        //->middleware('can:update,estampa');
    Route::delete('catalogo/{estampa}', [CatalogoController::class, 'destroy'])->name('catalogo.estampas.destroy');
        //->middleware('can:delete,estampa');

    //verificação do email
    Route::post('clientes/{cliente}/sendVerificationEmail', [ClienteController::class, 'sendVerificationEmail'])->name('clientes.sendVerificationEmail')
        ->middleware('can:update,cliente');
    Route::post('users/{user}/sendVerificationEmail', [UserController::class, 'sendVerificationEmail'])->name('users.sendVerificationEmail')
        ->middleware('can:update,user');

});

// carrinho de compras
Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('carrinho/tshirts/{tshirt}', [CarrinhoController::class, 'store_Tshirt'])->name('carrinho.store_Tshirt');
Route::put('carrinho/tshirts/{tshirt}', [CarrinhoController::class, 'update_Tshirt'])->name('carrinho.update_Tshirt');
Route::delete('carrinho/tshirts/{tshirt}', [CarrinhoController::class, 'destroy_Tshirt'])->name('carrinho.destroy_Tshirt');
Route::post('carrinho', [CarrinhoController::class, 'store'])->name('carrinho.store');
Route::delete('carrinho', [CarrinhoController::class, 'destroy'])->name('carrinho.destroy');


// catalogo
Route::get('admin/estampa/{estampa}/image', [CatalogoController::class, 'imagemEstampa'])->name('imagemEstampa');
Route::get('catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');


Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
/* ->middleware('can:create,App\Models\Cliente'); */
Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store');
/* ->middleware('can:create,App\Models\Cliente'); */


Auth::routes(['register' => false, 'verify' => true]);
