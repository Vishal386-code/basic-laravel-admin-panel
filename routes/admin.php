<?php

use App\Http\Middleware\HasAccessAdmin;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;




Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth', 'verified', HasAccessAdmin::class],
    'as' => 'admin.',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', 'UserController');
    // Route::resource('role', 'RoleController');
    // Route::resource('permission', 'PermissionController');
    // Route::resource('media', 'MediaController');
    // Route::resource('menu', 'MenuController')->except([
    //     'show',
    // ]);
    // Route::resource('menu.item', 'MenuItemController')->except([
    //     'show',
    // ]);
    // Route::group([
    //     'prefix' => 'category',
    //     'as' => 'category.',
    // ], function () {
    //     Route::resource('type', 'CategoryTypeController')->except([
    //         'show',
    //     ]);
    //     Route::resource('type.item', 'CategoryController')->except([
    //         'show',
    //     ]);
    // });
    // Route::resource('comment', 'CommentController');
    // Route::resource('thread', 'ThreadController');
    // Route::resource('attribute', 'AttributeController');
    // Route::resource('reaction', 'ReactionController');


    Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/data', [UserController::class, 'getUsers'])->name('users.data');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
  
    Route::get('edit-account-info', 'UserController@accountInfo')->name('account.info');
    Route::post('edit-account-info', 'UserController@accountInfoStore')->name('account.info.store');
    Route::post('change-password', 'UserController@changePasswordStore')->name('account.password.store');

    Route::resource('activitylog', 'ActivityLogController')->except([
        'create',
        'store',
        'edit',
        'update',
    ]);
    // Route::resource('payment', PaymentController::class)->except(['create', 'store']);
    Route::get('payment', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payment/{payment}', [PaymentController::class, 'show'])->name('payments.show');

    //Demo
    Route::group([
        'prefix' => 'demo',
        'as' => 'demo.',
    ], function () {
        Route::resource('forms', 'DemoFormsController')->except([
            'show',
            'edit',
            'update',
        ]);
    });
});
