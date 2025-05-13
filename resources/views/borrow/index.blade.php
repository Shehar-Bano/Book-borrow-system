{{-- Check if the user is a student --}}
@if (Auth::user()->role === 'student')
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

        {{-- Student's Own Borrow Requests --}}
        <div class="card mt-5">
            <div class="card-header">
                <h4>Your Borrow Requests</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Book Title</th>
                            <th>Request Date</th>
                            <th>Expected Return Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->book->title }}</td>
                                <td>{{ $request->request_date }}</td>
                                <td>{{ $request->return_date }}</td>
                                <td>{{ ucfirst($request->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endif


{{-- Check if the user is an admin --}}
@if (Auth::user()->role === 'admin')
    @include('head')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>All Borrow Requests</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Book Title</th>
                            <th>Request Date</th>
                            <th>Expected Return Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->book->title }}</td>
                                <td>{{ $request->request_date }}</td>
                                <td>{{ $request->return_date }}</td>
                                <td>{{ ucfirst($request->status) }}</td>
                                <td>
                                    @if ($request->status == 'pending')
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm"
                                            onclick="confirmAction('{{ route('borrow_requests.accept', $request->id) }}', 'accept')">
                                            Accept
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                            onclick="confirmAction('{{ route('borrow_requests.reject', $request->id) }}', 'reject')">
                                            Reject
                                        </a>
                                    @elseif ($request->status == 'approved')
                                        <a href="javascript:void(0);" class="btn btn-warning btn-sm"
                                            onclick="confirmAction('{{ route('borrow_requests.returned', $request->id) }}', 'returned')">
                                            Mark as Returned
                                        </a>
                                    @else
                                        <span class="text-muted">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

{{-- SweetAlert and JavaScript --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Confirm action for accept, reject, or returned
    function confirmAction(url, action) {
        let actionText = '';
        let successMessage = '';

        if (action === 'accept') {
            actionText = 'accept this request';
            successMessage = 'Request accepted successfully!';
        } else if (action === 'reject') {
            actionText = 'reject this request';
            successMessage = 'Request rejected successfully!';
        } else if (action === 'returned') {
            actionText = 'mark this book as returned';
            successMessage = 'Book marked as returned!';
        }

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to ${actionText}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
                Swal.fire(
                    'Success!',
                    successMessage,
                    'success'
                );
            }
        });
    }
</script>

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
