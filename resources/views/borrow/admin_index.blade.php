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



</body>

</html>
