<?php

use App\Http\Controllers\ProfileController;
use App\Models\Flight;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Collection;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-flight', function () {
    Flight::where('title', 'Traveling to Portugal')->chunk(2, function (Collection $flights) {
        foreach ($flights as $flight) {
            echo $flight->id . ' ' . $flight->title . '<br>';
        }
    });
});

require __DIR__.'/auth.php';
