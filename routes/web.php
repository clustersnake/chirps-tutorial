<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Chirp;

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

Route::view('/', 'welcome')->name('welcome');


Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::view(
        '/chirps',
        'chirps.index'
    )->name('chirps.index');
    Route::post('/chirps', function () {
        $message = request('message');

        Chirp::create([
            'message' => $message,
            'user_id' => auth()->id(),
        ]);

        // session()->flash('status', 'The chirp was created successfully!');

        return to_route('chirps.index')
            ->with('status', __('The chirp was created successfully!'));
    })->name('chirps');
});

require __DIR__ . '/auth.php';
