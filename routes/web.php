<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
   
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoreyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\RandomUser;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/tests-data',[DataTableController::class, "returnData"]);
Route::get('/tests',[DataTableController::class, "index"]);

// Post Crud
Route::resource('posts', PostController::class);
// Route::resource('datatables', DataTableController::class);
// Route::get('datatablevalues', "App\Http\Controllers\DataTableController@returnData");

// Categorey With Active and Inactive
Route::resource('categoreys', CategoreyController::class);
Route::put('active/{id}', [CategoreyController::class, "active"]);
Route::put('inactive/{id}', [CategoreyController::class, "inactive"]);

// Product Crud With Relation
Route::resource('products', ProductController::class);
// Product Active, Inactive Option
Route::put('active-product/{id}', [ProductController::class, "active"]);
Route::put('inactive-product/{id}', [ProductController::class, "inactive"]);

//User Crud
Route::resource('users', UserController::class);
// User Select, InSelect
Route::get('select', [UserController::class, "select"]);

// Simple Vue Component Call
Route::get('test', function () {
    return Inertia::render("DataTable");
});

Route::get('randomuser', function () {
    return Inertia::render("randomuser");
});
Route::get('randomuser', [RandomUser::class, "index"]);

// ChildrenFile Componenet Call, in this Test File is Child.
Route::get('ChildrenFile', function () {
    return Inertia::render("ChildrenFile");
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


