<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/error', function(){
    return view('error_page');
})->name('error');

Route::middleware('admin')->group(function () {
Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::match(['get', 'post'],'/admin/create-party', [AdminController::class, 'createParty']);
Route::post('/admin/create', [AdminController::class, 'create']);
Route::match(['get', 'post'],'/admin/dashboard', [AdminController::class, 'showUser']);
Route::match(['get', 'post'], '/admin/edit', [AdminController::class, 'edit']);
});

