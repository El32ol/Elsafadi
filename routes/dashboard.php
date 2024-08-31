<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\freelancer\ProposalsController;

// , 'middleware'=>['auth:admin,web']
Route::group(['prefix'=>'dashboard' 
, 'middleware'=>['auth:admin,web']]  , function(){

Route::resource('roles' , RolesController::class);

Route::get('proposal' , [ProposalsController::class , 'index'])->name('proposal.index');
Route::get('/proposal/{project}/create' , [ProposalsController::class , 'create'])->name('proposal.create');
Route::post('/proposal/{project}/create' , [ProposalsController::class , 'store'])->name('proposal.store');

Route::resource('/categories' , CategoriesController::class);



Route::get('/user-profile' , [ProfileController::class , 'index'])->name('profile');
Route::put('/update' , [ProfileController::class , 'update'])->name('profile.update');
// Route::prefix('/categories')->as('categories.')->group(function(){
    Route::get('/akl' , [ProposalsController::class , 'index']);
    Route::get('/trash' , [CategoriesController::class , 'trash'])->name('trash');

    Route::put('/trash/{category}/restore' , [CategoriesController::class , 'restore'])
        ->name('trash.restore');
    Route::delete('/trash/{category}/deleted' , [CategoriesController::class , 'forceDelete'])
            ->name('forceDelete');


//     Route::get('/' , [CategoriesController::class , 'index'])
//     ->name('index');
//     Route::get('/create' , [CategoriesController::class , 'create'])
//     ->name('create');
//     Route::post('/store' , [CategoriesController::class , 'store'])
//     ->name('store');
//     Route::get('/{category}' , [CategoriesController::class , 'show'])
//     ->name('show');
//     Route::get('/{category}/edit' , [CategoriesController::class , 'edit'])
//     ->name('edit');
//     Route::put('/{category}/update' , [CategoriesController::class , 'update'])
//     ->name('update');
//     Route::delete(' /{category}/delete' , [CategoriesController::class , 'destroy'])
//     ->name('destroy');

// });

});
