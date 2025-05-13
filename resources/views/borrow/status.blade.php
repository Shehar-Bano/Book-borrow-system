@include('head')
<!-- borrow_requests/status.blade.php -->
<h2>Your Borrow Requests</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Book Title</th>
            <th>Request Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($borrowRequests as $request)
            <tr>
                <td>{{ $request->book->title }}</td>
                <td>{{ $request->request_date->format('Y-m-d') }}</td>
                <td>{{ ucfirst($request->status) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
