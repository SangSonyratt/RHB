<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SidebarController;

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
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::post('', [SidebarController::class, 'createSidebar']);
    Route::delete('sidebars/{id}', [SidebarController::class, 'deleteSidebar'])->name('sidebars.destroy');
    Route::put('sidebars/{id}', [SidebarController::class, 'updateSidebar']);
    Route::get('sidebars/{id}', [SidebarController::class, 'showSidebarbyId']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('', [SidebarController::class, 'showSidebar']);
});
Auth::routes();