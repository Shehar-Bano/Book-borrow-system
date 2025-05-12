@include('head')
<!-- Main content -->
<div class="container mt-5">
    <h2>Create Borrow Request</h2>

    <form action="{{ route('borrow_requests.store') }}" method="POST">
        @csrf

        <!-- Show logged-in user's name (read-only) -->
        <div class="form-group">
            <label for="user_name">Student</label>
            <input type="text" id="user_name" class="form-control" value="{{ Auth::user()->name }}" readonly>
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        </div>

        <div class="form-group">
            <label for="book_id">Book</label>
            <select name="book_id" id="book_id" class="form-control" required>
                <option value="">Select a book</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }} by {{ $book->author }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="request_date">Request Date</label>
            <input type="date" name="request_date" id="request_date" class="form-control" value="{{ date('Y-m-d') }}"
                required>
        </div>

        <div class="form-group">
            <label for="return_date">Expected Return Date</label>
            <input type="date" name="return_date" id="return_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Submit Request</button>
    </form>
</div>




</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
