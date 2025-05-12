<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;

class BorrowRequestController extends Controller
{
    // Shared index (can filter by role if needed)
    public function index()
    {
        $user = auth()->user();
        $books = Book::where('status', 'available')->get();

        if ($user->role === 'admin') {
            $requests = BorrowRequest::with('book', 'user')->latest()->get();
        } else {
            $requests = $user->borrowRequests()->with('book')->latest()->get();
        }

        return view('borrow.index', compact('requests', 'books'));
    }

    // Student: request a book
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'return_date' => 'required'
        ]);

        $book = Book::find($request->book_id);

        if ($book->status === 'borrowed') {
            return back()->with('error', 'Book is already borrowed.');
        }

        BorrowRequest::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Request submitted!');
    }



}