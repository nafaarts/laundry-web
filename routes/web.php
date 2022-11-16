<?php

use App\Models\Laundry;
use Illuminate\Support\Facades\Auth;
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
    return redirect('/dashboard');
});

Auth::routes([
    'verify' => false,
    'reset' => false,
    'register' => false,
]);


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class)->except('show');
    Route::resource('laundry', \App\Http\Controllers\LaundryController::class);
    Route::resource('service', \App\Http\Controllers\LaundryServiceController::class)->except('index', 'show');
    Route::resource('transactions', \App\Http\Controllers\OrderController::class)->names('orders');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

Route::get('explore', function () {
    return view('explore');
});

Route::get('open-explore', function () {
    $id = request('id') or abort(404);
    $laundry = Laundry::findOrFail($id);
    echo "redirect to mobile...";
    echo "<br>";
    echo "<small>$laundry->name</small>";
})->name('open.explore');
