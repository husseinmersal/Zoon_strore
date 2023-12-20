<?php
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;


Route::group([
        'middleware' => ['auth','auth.type:admin,super-admin'],
], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');


        Route::get('profile', [ProfileController::class, 'edit'])
                ->name('profile.edit');

        Route::patch('profile', [ProfileController::class, 'update'])
                ->name('profile.update');



                
        Route::get('dashboard/categories/trash', [CategoriesController::class, 'trash'])
                ->name('categories.trash');


        Route::put('dashboard/categories/{category}/restore', [CategoriesController::class, 'restore'])
                ->name('categories.restore');


        Route::delete('dashboard/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])
                ->name('categories.force-delete');


        Route::resource('dashboard/categories', CategoriesController::class);


        Route::resource('dashboard/products', ProductsController::class);


});





