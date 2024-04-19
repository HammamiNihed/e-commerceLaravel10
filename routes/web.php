<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Auth;
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

//Authentication routes
Auth::routes();
    
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    //category routes
    Route::get('/admin/categories', [CategoryController::class, 'listeCategory'])->name('allCategory');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashAdmin');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/admin/profile', [AdminController::class, 'profile']);
    Route::post('/admin/edit/profile', [AdminController::class, 'editProfile']);

    Route::post('/category/add', [CategoryController::class, 'AddCategory'])->name('addCategory');    
    Route::post('/edit/{id}', [CategoryController::class, 'update']);
    Route::get('/edit/{id}', [CategoryController::class, 'edit']);
    Route::get('/delete/{id}', [CategoryController::class, 'delete']);

    //product routes
    Route::get('/admin/produits', [ProduitController::class, 'listeProducts'])->name('allProducts');
    Route::post('/produit/add', [ProduitController::class, 'AddProduct'])->name('addProduct');    
    Route::post('/produit/edit', [ProduitController::class, 'update']);
    Route::get('/deleteProduit/{id}', [ProduitController::class, 'delete']);
});

//Client(user) routes
//Route::middleware(['auth', 'role:user'])->group(function () {    
    Route::get('/client/dashboard', [ClientController::class, 'dashboard']);
    Route::get('/products/{categoryId}', [ClientController::class, 'index']);
    Route::post('/products/filter', [ClientController::class, 'filterByName'])->name("filter");
    Route::get('/detailsProduct/{id_produit}', [ClientController::class, 'detailProduct']);

    Route::post('/client/order/store', [CommandeController::class, 'store']);
    Route::get('/client/cart', [CommandeController::class, 'cartPage']);
//});

