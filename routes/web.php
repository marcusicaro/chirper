<?php

use App\Http\Controllers\ProfileController;
use App\Models\Flight;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Scopes\AncientScope;


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

    $all_flights = Flight::withoutGlobalScopes()->withTrashed()->ofDestination('Portugal')->get();

    foreach ($all_flights as $flight) {
        echo $flight->is($all_flights[1]) ? 'true' : 'false';
    }

});

Route::get('/user-test', function () {
    $user = User::withoutEvents(function () {
    User::findOrFail(14)->delete();
    });
});



require __DIR__.'/auth.php';
