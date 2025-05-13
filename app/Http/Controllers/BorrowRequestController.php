<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use App\Mail\BorrowRequestStatus;
use Illuminate\Support\Facades\Mail;

class BorrowRequestController extends Controller
{
    // Shared index (can filter by role if needed)
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'student') {
            $books = Book::where('status', 'available')->get();
            $borrowRequests = BorrowRequest::where('user_id', $user->id)->with('book')->get();

            return view('borrow.index', compact('books', 'borrowRequests'));
        }

        if ($user->role === 'admin') {
            $borrowRequests = BorrowRequest::with('book', 'user')->get();

            return view('borrow.admin_index', compact('borrowRequests'));
        }
    }
    // Student: request a book
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required|exists:books,id',
            'return_date' => 'required',
            'request_date' => 'required'
        ]);

        $book = Book::find($request->book_id);

        if ($book->status === 'borrowed') {
            return back()->with('error', 'Book is already borrowed.');
        }

        BorrowRequest::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'return_date' => $request->return_date,
            'request_date' => $request->request_date,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Request submitted!');
    }
    public function accept($id)
    {
        $request = BorrowRequest::with(['user', 'book'])->findOrFail($id);
        $request->status = 'approved';
        $request->save();

        // Send email to user
        Mail::to($request->user->email)->send(new BorrowRequestStatus($request, 'accepted'));

        return redirect()->route('borrow_requests.index')->with('success', 'Request accepted and user notified!');
    }

    public function reject($id)
    {
        $request = BorrowRequest::with(['user', 'book'])->findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        // Send email to user
        Mail::to($request->user->email)->send(new BorrowRequestStatus($request, 'rejected'));

        return redirect()->route('borrow_requests.index')->with('success', 'Request rejected and user notified!');
    }
    public function markAsReturned($id)
    {
        $request = BorrowRequest::with(['user', 'book'])->findOrFail($id);
        $request->status = 'returned'; // Update the status to 'returned'
        $request->save();
        Mail::to($request->user->email)->send(new BorrowRequestStatus($request, 'returned'));

        return redirect()->route('borrow_requests.index')->with('success', 'Book marked as returned.');
    }

    public function status()
    {
        $borrowRequests = BorrowRequest::where('user_id', auth()->id())->get();  // Get borrow requests for the logged-in student
        return view('borrow_requests.status', compact('borrowRequests'));
    }






}
