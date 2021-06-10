<?php

use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Mail\MailTester;
use Illuminate\Support\Facades\Mail;

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

Route::get('/',function () {return view('welcome');});

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::get('docentes',  [DocenteController::class, 'index'])->name('docentes.index');

Auth::routes(['register' => false, 'verify' => true]);

/* Route::get('send-mail', function () {
    $details = [
        'title' =>  'Verification mail from MagicShirts.test',
        'body'  =>  'This is for testing verification email(smtp)'
    ];

    \Mail::to('pasrleiria@gmail.com')->send(new \App\Mail\verificationTest($details));

    dd("Email is Sent");
}); */

Route::middleware(['auth','verified'])->prefix('admin')->name('admin.')->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    // admininstração de users
    Route::get('users', [UserController::class, 'admin'])->name('users')
        ->middleware('can:viewAny,App\Models\User');
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

    //verificação do email
    Route::post('clientes/{cliente}/sendVerificationEmail', [ClienteController::class, 'sendVerificationEmail'])->name('clientes.sendVerificationEmail')
        ->middleware('can:update,cliente');
    Route::post('users/{user}/sendVerificationEmail', [UserController::class, 'sendVerificationEmail'])->name('users.sendVerificationEmail')
        ->middleware('can:update,user');
});

Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
/* ->middleware('can:create,App\Models\Cliente'); */
Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store');
/* ->middleware('can:create,App\Models\Cliente'); */
