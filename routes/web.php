<?php

use App\Models\Book;
use App\Models\User;
use App\Models\BorrowRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BorrowRequestController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Shared Authenticated Routes (both student and admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard - show different views based on role
    Route::get('/dashboard', function () {

        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('dashboard', [
                'totalBooks' => Book::where('status', 'available')->count(),
                'totalStudents' => User::where('role', 'student')->count(),
                'pendingRequests' => BorrowRequest::where('status', 'pending')->count()
            ]);
        } elseif ($user->role === 'student') {
            return view('student-dashboard', [
                'availableBooks' => Book::where('status', 'available')->count(),
                'totalRequests' => BorrowRequest::where('user_id', $user->id)->count(),
                'pendingRequests' => BorrowRequest::where('user_id', $user->id)->where('status', 'pending')->count()
            ]);
        }

        abort(403); // Forbidden for undefined roles
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Student-only Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/borrow-requests', [BorrowRequestController::class, 'index'])->name('borrow_requests.index');

    // Create a new borrow request
    Route::post('/borrow-requests/store', [BorrowRequestController::class, 'store'])->name('borrow_requests.store');

    // Check borrow request status (this might need a separate view or controller method)
    Route::get('/borrow-requests/status', [BorrowRequestController::class, 'status'])->name('borrow_requests.status');
});

/*
|--------------------------------------------------------------------------
| Admin-only Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Book management
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('books.index');
        Route::post('/store', [BookController::class, 'store']);
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::post('/update/{id}', [BookController::class, 'update']);
        Route::delete('/destroy/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    });

    // Borrow request handling
    Route::prefix('borrow-requests')->group(function () {
        Route::get('/accept/{id}', [BorrowRequestController::class, 'accept'])->name('borrow_requests.accept');
        Route::get('/reject/{id}', [BorrowRequestController::class, 'reject'])->name('borrow_requests.reject');
        Route::get('/returned/{id}', [BorrowRequestController::class, 'markAsReturned'])->name('borrow_requests.returned');
    });
    Route::get('/students', [BookController::class, 'student'])->name('students.index');
    Route::get('/borrow-requests', [BorrowRequestController::class, 'index'])->name('borrow_requests.index');

});

require __DIR__ . '/auth.php';