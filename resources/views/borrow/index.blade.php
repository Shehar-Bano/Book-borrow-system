@include('head')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Create Borrow Request</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('borrow_requests.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- Student Name (readonly) --}}
                    <div class="form-group col-md-6">
                        <label for="user_name">Student</label>
                        <input type="text" id="user_name" class="form-control" value="{{ Auth::user()->name }}"
                            readonly>
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    </div>

                    {{-- Book Dropdown --}}
                    <div class="form-group col-md-6">
                        <label for="book_id">Book</label>
                        <select name="book_id" id="book_id" class="form-control" required>
                            <option value="">Select a book</option>
                            @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }} by {{ $book->author }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    {{-- Request Date --}}
                    <div class="form-group col-md-6">
                        <label for="request_date">Request Date</label>
                        <input type="date" name="request_date" id="request_date" class="form-control"
                            value="{{ date('Y-m-d') }}" required>
                    </div>

                    {{-- Expected Return Date --}}
                    <div class="form-group col-md-6">
                        <label for="return_date">Expected Return Date</label>
                        <input type="date" name="return_date" id="return_date" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-3">Submit Request</button>
            </form>
        </div>
    </div>



    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    </body>

    </html>
