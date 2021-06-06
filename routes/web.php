<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrarController;

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

// Auth::routes(['register' => false]);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// for Admin
Route::group(['middleware' => ['auth', 'role:admin']], function() { 
    Route::get('/dashboard/users', 'App\Http\Controllers\DashboardController@users')->name('dashboard.users');
    Route::delete('/dashboard/users/{id}', 'App\Http\Controllers\DashboardController@destroyUser')->name('dashboard.destroyUser');
});

// for roller
Route::group(['middleware' => ['auth', 'role:roller']], function() { 
    Route::get('/dashboard/cases', 'App\Http\Controllers\RollerController@cases')->name('dashboard.cases');
    Route::post('/dashboard/cases', 'App\Http\Controllers\RollerController@createCase')->name('dashboard.createCase');
    Route::put('/dashboard/cases', 'App\Http\Controllers\RollerController@Rows')->name('dashboard.rows');
    Route::patch('/dashboard/cases/{id}', 'App\Http\Controllers\RollerController@status')->name('dashboard.status');
    Route::put('/dashboard/cases/{id}', 'App\Http\Controllers\RollerController@suspend')->name('dashboard.suspend');

    Route::get('/dashboard/suspends', 'App\Http\Controllers\RollerController@suspendCases')->name('dashboard.suspendCases');
    Route::put('/dashboard/suspends', 'App\Http\Controllers\RollerController@suspendCasesRow')->name('dashboard.suspendCasesRow');
});


// for superadmin
Route::group(['middleware' => ['auth', 'role:superadmin']], function() { 
    Route::get('/dashboard/offersList', 'App\Http\Controllers\SuperadminController@offersList')->name('dashboard.offersList');
    Route::post('/dashboard/offersList', 'App\Http\Controllers\SuperadminController@addOffer')->name('dashboard.addOffer');
    
    Route::put('/dashboard/offersList', 'App\Http\Controllers\SuperadminController@changeRows')->name('dashboard.changeRows');
    Route::delete('/dashboard/offersList/{id}', 'App\Http\Controllers\SuperadminController@offerDestroy')->name('dashboard.offerDestroy');
    Route::patch('/dashboard/offersList/{id}', 'App\Http\Controllers\SuperadminController@offerEdit')->name('dashboard.offerEdit');
    Route::put('/dashboard/offersList/{id}', 'App\Http\Controllers\SuperadminController@offerStatus')->name('dashboard.offerStatus');
});

// for registrar
Route::group(['middleware' => ['auth', 'role:registrar']], function() { 
    Route::get('/dashboard/accountsList', [RegistrarController::class, 'accountsList'])->name('dashboard.accountsList');
    Route::post('/dashboard/accountsList', [RegistrarController::class, 'addAccount'])->name('dashboard.accountsListPost'); 
    Route::delete('/dashboard/accountsList/{id}', [RegistrarController::class, 'accountDestroy'])->name('dashboard.accountDestroy');
    Route::put('/dashboard/accountsList', [RegistrarController::class, 'numberOfRows'])->name('dashboard.numberOfRows');
    Route::put('/dashboard/accountsList/{id}', [RegistrarController::class, 'accountStatus'])->name('dashboard.accountStatus');
    Route::patch('/dashboard/accountsList/{id}', [RegistrarController::class, 'accountEdit'])->name('dashboard.accountEdit');
});

//auth route for both 
Route::group(['middleware' => ['auth']], function() { 
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});


require __DIR__.'/auth.php';
