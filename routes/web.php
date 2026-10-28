<?php

use Illuminate\Support\Facades\Route;

// Controladores públicos
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\SubscriberController;

// Controladores de Autenticación
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Controladores de Administración
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/getseminarios', [ArticleController::class, 'getSeminarios']);
Route::get('/getproxseminarios', [ArticleController::class, 'getProxSeminarios']);
Route::get('/sobre-el-management-update', [ArticleController::class, 'about']);

Route::view('/contacto', 'contacto');

Route::get('/search', [ArticleController::class, 'search']);
Route::get('/search/{query}', [ArticleController::class, 'search']);

Route::get('/suscribir', [SubscriberController::class, 'subscribe']);
Route::post('/subscribe', [SubscribeController::class, 'store']);

Route::get('/resize/{path}', [ImageController::class, 'show'])->where('path', '.*');

Route::get('/categorias/{alias}', [ArticleController::class, 'category']);
Route::get('/autores/{autor}', [ArticleController::class, 'author']);
Route::get('/facilitador/{facilitador}', [ArticleController::class, 'facilitador']);
Route::get('/redirect/facilitator/{facilitador_id}', [ArticleController::class, 'facilitador_redirect']);
Route::get('/ediciones-anteriores/{alias}', [ArticleController::class, 'edition']);
Route::get('/categorias/{category}/item/{article}-{alias}', [ArticleController::class, 'show']);

Route::get('/home', [HomeController::class, 'index'])->name('home.dashboard');


// Rutas de Administración
Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'admin']);

    // Autenticación
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Registro
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware(['auth', 'admin']);
    Route::post('register', [RegisterController::class, 'register'])->middleware(['auth', 'admin']);

    // Restablecimiento de contraseña
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    // Panel Administrativo Interno
    Route::middleware(['auth', 'admin'])->group(function () {

        // Items
        Route::controller(ItemController::class)->prefix('items')->group(function () {
            Route::get('/', 'index');
            Route::get('all', 'getAll');
            Route::get('create', 'create');
            Route::post('create', 'store');
            Route::get('{item}', 'edit');
            Route::post('{item}', 'update');
            Route::post('{item}/update/{field}', 'updateField');
            Route::delete('{item}/remove', 'destroy');
        });

        // Users
        Route::controller(UserController::class)->prefix('users')->group(function () {
            Route::get('/', 'index');
            Route::get('all', 'getAll');
            Route::get('create', 'create');
            Route::get('{user}', 'edit');
            Route::post('{user}', 'update');
        });

        // Authors
        Route::controller(AuthorController::class)->prefix('authors')->group(function () {
            Route::get('/', 'index');
            Route::get('all', 'getAll');
            Route::get('create', 'create');
            Route::post('create', 'store');
            Route::get('{author}', 'edit');
            Route::post('{author}', 'update');
            Route::post('{author}/delete', 'destroy');
        });

        // Categories
        Route::controller(CategoryController::class)->prefix('categories')->group(function () {
            Route::get('/', 'index');
            Route::get('all', 'getAll');
            Route::get('create', 'create');
            Route::post('create', 'store');
            Route::get('{category}', 'edit');
            Route::post('{category}', 'update');
            Route::post('{category}/update/{field}', 'updateField');
        });

        // Tags
        Route::controller(TagController::class)->prefix('tags')->group(function () {
            Route::get('/', 'index');
            Route::get('all', 'getAll');
            Route::post('{tag}/update/{field}', 'updateField');
            Route::delete('{tag}/remove', 'destroy');
        });
    });
});