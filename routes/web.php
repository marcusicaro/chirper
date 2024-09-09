<?php

use App\Http\Controllers\ProfileController;
use App\Models\Flight;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Destination;

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

    $firstFlight = Flight::where(['departure' => 'São Paulo', 'destination' => 'Portugal'])->first();

    echo $firstFlight->price;

    $flight = Flight::updateOrCreate(
        ['departure' => 'Bahia', 'destination' => 'Portugal'],
        ['price' => 120.00, 'name' => 'Flight Bahia']
    );

    echo $flight->departure;
});

Route::get('/user-test', function () {
     
    $user = User::find(1);
 
    $user->name; // John
    $user->email; // john@example.com
     
    $user->fill(['name' => "a1s2d3"]);
    echo $user->name . '<br>'; // Jack
     
    echo $user->getOriginal('name') . '<br>'; // John

    $user->save();

    echo 'changed' . '<br>';

    echo $user->getOriginal('name') . '<br>'; // John

});



require __DIR__.'/auth.php';
