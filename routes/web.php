<?php

use App\Jobs\HighPriorityClient;
use App\Jobs\ReconcileAccount;
use Illuminate\Support\Facades\Route;

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
Route::get('/log', function () {
    $user = App\Models\User::first();

    //dispatch(new ReconcileAccount($user));
    ReconcileAccount::dispatch($user)->onQueue('default');
    return 'Finished';
});
Route::get('/log/high', function () {
    $user = App\Models\User::first();

    //dispatch(new ReconcileAccount($user));
    HighPriorityClient::dispatch($user)->onQueue('high');
    return 'Finished';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
