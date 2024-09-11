<?php

use App\Http\Controllers\ProfileController;
use App\Models\Flight;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Schema\Blueprint;


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

    $flight = Flight::withTrashed()->find('9cf68147-7e82-4b2a-831e-06a05c07b14c');

    if ($flight->trashed()) {
        echo 'trasjed';
    }
});

Route::get('/user-test', function () {
     
    User::create([
        'name' => 'John Doe',
        'email' => 'johndoe@mail.com',
        'password' => bcrypt('password'),
    ]);

    $user = User::where('email', 'johndoe@mail.com')->first();

    echo $user->name . '</br>';

    User::upsert([
        ['name' => 'JohnJohn Doe', 'email' => 'johndoe@mail.com'],
        ['name' => 'Jane Doe', 'email' => 'janedoe@mail.com', 'password' => bcrypt('password')],
    ], uniqueBy: ['email'], update: ['name']);

    $updatedUser = User::where('email', 'johndoe@mail.com')->first();

    echo 'updated: ' . $updatedUser->name . '</br>';

});



require __DIR__.'/auth.php';
