<?php

use App\Models\Book;
use App\Models\User;
use App\Models\BorrowRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BorrowRequestController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalBooks' => Book::where('status', 'available')->count(),
        'totalStudents' => User::where('role', 'student')->count(),
        'pendingRequests' => BorrowRequest::where('status', 'pending')->count()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {

    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::post('books/store', [BookController::class, 'store']);
    Route::get('books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
    Route::post('books/update/{id}', [BookController::class, 'update']);
    Route::delete('books/destroy/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/borrow-requests', [BorrowRequestController::class, 'index']);
    Route::post('/borrow-requests', [BorrowRequestController::class, 'store'])->name('borrow_requests.store'); // for students
    Route::get('/students', [BookController::class, 'student'])->name('students.index');

});


require __DIR__ . '/auth.php';
