<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

// Contact routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Apply the CheckAge middleware to the homepage
Route::get('/', function () {
    return view('welcome');
})->middleware('check.age');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['check.age', 'auth', 'verified'])->name('dashboard');  // Only logged-in users can access

// Other routes that need to be accessed by authenticated users
Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth'])->name('profile');


// Define the 'not-allowed' route
Route::get('/not-allowed', function () {
    return "You are not allowed to access this website.";
});

// // Other routes
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
