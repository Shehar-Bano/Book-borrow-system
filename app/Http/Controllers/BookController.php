<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display a listing of the books
    public function index()
    {
        $books = Book::where('status', 'available')->get();
        return view('books.index', compact('books'));
    }


    // Store a newly created book in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'copies_available' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
        ]);

        Book::create($validatedData);

        return redirect()->route('books.index')->with('success', 'Book added successfully');
    }

    // Display the specified book


    // Show the form for editing the specified book
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Update the specified book in storage
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'copies_available' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    // Remove the specified book from storage
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->status = 'unavailable';
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }

    public function student()
    {
        $students = User::where('role', 'student')->with('borrowRequests.book')->get(); // Filter by role if applicable
        return view('student', compact('students'));
    }
}