<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DepartamentoController;
use App\Http\Controllers\Admin\PostController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('painel')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::resource('users', UserController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profilesave', [ProfileController::class, 'save'])->name('profile.save');

    // Route::get('/departamentos', [DepartamentoController::class, 'index']);
    // Route::get('/departamentos/create', [DepartamentoController::class, 'create'])->name('departamentos.create');
    // Route::post('/departamentos/store', [DepartamentoController::class, 'store'])->name('departamentos.store');
    // Route::get('/departamentos/edit', [DepartamentoController::class, 'edit'])->name('departamentos.edit');
    // Route::get('/departamentos/destroy', [DepartamentoController::class, 'destroy'])->name('departamentos.destroy');
    Route::resource("posts",PostController::class);
    Route::resource("departamento",DepartamentoController::class);
    Route::delete("deletefile/{id}",[PostController::class,'deletefile'])->name('deletefile');
    Route::get("indexdoc/",[PostController::class,'indexdoc'])->name('posts.indexdoc');
    // Route::delete("updatefile/{id}",[PostController::class,'updatefile'])->name('posts.update');
});

