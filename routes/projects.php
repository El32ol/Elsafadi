<?php

use App\Http\Controllers\project\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'clients',
    // 'as' => 'clients.',
    'middleware'=> ['auth:admin,web'],
    ], function () {

        Route::resource('projects' , ProjectsController::class)->names([
            'index' =>'clients.index',
            'update' =>'clients.update',
            'create' =>'clients.create',
            'show' =>'clients.show',
            'store' =>'clients.store',
            'edit' =>'clients.edit',
            'destroy' =>'clients.destroy',
        ]);

    });