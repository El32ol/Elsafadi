<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\freelancer\ProposalsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
  
] , function(){
    Route::get('/', function () {
        return view('auth.login');
    });
Route::resource('dashboard/categories' , CategoriesController::class);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:admin,web'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// require __DIR__.'/auth.php';


// Route::group([
//     'prefix'=>'admin',
//     'as' => 'admin.',
// ] , function() {

//     require __DIR__.'/auth.php';

// });

Route::get('messages' , [MessagesController::class , 'create']);
Route::post('messages' , [MessagesController::class , 'store'])->name('messages');

Route::get('otp/request' , [OtpController::class , 'create'])->name('otp.create');
Route::post('otp/request' , [OtpController::class , 'store']);
Route::get('verify/request' , [OtpController::class , 'verifyForm'])->name('otp.verify');
Route::post('verify/request' , [OtpController::class , 'verify']);

require __DIR__.'/dashboard.php';
require __DIR__.'/projects.php';
