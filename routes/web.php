<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PhotoCommentController;

Route::get('/max-length', function () {
    $maxLength = DB::table('information_schema.COLUMNS')
        ->where('TABLE_SCHEMA', env('DB_DATABASE'))
        ->where('TABLE_NAME', 'users')
        ->where('COLUMN_NAME', 'name')
        ->value('CHARACTER_MAXIMUM_LENGTH');

    return "The maximum number of characters for the 'name' column is: " . $maxLength;
});


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
    Schema::table('users', function (Blueprint $table) {
        $table->index('state');
    });
});

Route::get('/user-test', function () {
    $user = User::withoutEvents(function () {
    User::findOrFail(14)->delete();
    });
});

Route::get('/user/{id}', [UserController::class, 'show']);

Route::apiResource('photos', PhotoController::class)
        ->missing(function ($request) {
            return Redirect::route('photos.index');
        })->withTrashed(['show']);

        
Route::resource('photos', PhotoController::class);

Route::resource('photos.comments', PhotoCommentController::class);

require __DIR__.'/auth.php';
