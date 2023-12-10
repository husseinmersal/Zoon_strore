<?php
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');



Route::get('dashboard/categories/trash', [CategoriesController::class, 'trash'])
        ->name('categories.trash');

        
Route::put('dashboard/categories/{category}/restore', [CategoriesController::class, 'restore'])
->name('categories.restore');

        
Route::delete('dashboard/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
->name('categories.force-delete');


Route::resource('dashboard/categories', CategoriesController::class);


Route::resource('dashboard/products', ProductsController::class);






