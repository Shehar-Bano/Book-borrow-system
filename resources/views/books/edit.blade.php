@include('head')
<!-- Main content -->
<div class="container">
    <h1>Edit Book</h1>

    <form action="{{ url('books/update/' . $book->id) }}" method="POST">
        @csrf


        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}"
                required>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ $book->category }}"
                required>
        </div>

        <div class="form-group">
            <label for="copies_available">Copies Available</label>
            <input type="number" name="copies_available" id="copies_available" class="form-control" min="1"
                value="{{ $book->copies_available }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $book->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Available
                </option>
                <option value="unavailable" {{ $book->status == 'unavailable' ? 'selected' : '' }}>Unavailable
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Book</button>
    </form>
</div>




</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
