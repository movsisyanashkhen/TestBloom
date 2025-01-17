<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
// use App\Http\Controllers\ContractController;

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
    return redirect()->route('contracts.index');
});

// Route::get('/check-role', function () {
//     $user = User::find(1); 
//     dd($user->roles);
// });


Route::resource('contracts', ContractController::class);

Route::get('/contracts/export', [ContractController::class, 'exportToCSV'])->name('contracts.export');
