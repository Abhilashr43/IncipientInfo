<?php

use App\Http\Controllers\RestaurantController;

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::get('restaurant', [RestaurantController::class, 'index'])->name('manage.restaurant');
    Route::get('restaurant/create', [RestaurantController::class, 'create_restaurant_view'])->name('manage.restaurant.create');
    Route::post('restaurant/create', [RestaurantController::class, 'store'])->name('manage.restaurant.store');
    Route::post('restaurant/edit', [RestaurantController::class, 'patch'])->name('manage.restaurant.edit');
    Route::get('restaurant/view/{res}', [RestaurantController::class, 'show'])->name('manage.restaurant.show');
    Route::delete('restaurant/destroy/{res}', [RestaurantController::class, 'destroy'])->name('manage.restaurant.destroy');
});
