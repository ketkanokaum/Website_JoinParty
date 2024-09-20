<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\DashboardController;
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
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
});
Route::get('/error', function(){
    return view('error_page');
})->name('error');

Route::middleware([
    'admin',
])->group(function () {
//Route::get('/admin', [dashboardController::class, 'index'])->name('dashboard');
Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('dashboard');;
Route::match(['get', 'post'],'/admin/create', [AdminController::class, 'createParty']);
Route::post('/admin/insert', [AdminController::class, 'insert']);
Route::match(['get', 'post'],'/admin/dashboard', [AdminController::class, 'showUser']);
Route::get('/admin/showUser', [AdminController::class, 'showUser'])->name('showUser.users');
Route::get('/admin/edit/', [AdminController::class, 'showEditPage']);
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

});

Route::get('/party', [ManageController::class, 'showParty'])->name('party.show');
Route::get('/user/profile', [ManageController::class, 'showProfile'])->name('profile.show');
Route::get('/user/editProfile/', [ManageController::class, 'showEditProfile']);
Route::post('/user/edit-profile/{id}', [ManageController::class, 'updateProfile'])->name('profile.update');
