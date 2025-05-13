<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Request Status Update</title>
</head>

<body>
    @php
        $userName = $borrowRequest->user->name ?? 'User';
    @endphp

    <h2>Dear {{ $userName }}</h2>

    <p>We wanted to inform you about the status of your borrow request for the book
        <strong>{{ $borrowRequest->book->title }}</strong>.
    </p>

    @if ($status == 'accepted')
        <p>Your request has been approved! You may pick up the book.</p>
    @elseif($status == 'rejected')
        <p>We regret to inform you that your borrow request has been rejected.</p>
    @else
        <p>Your borrowed book has been returned.</p>
    @endif

    <p>Thank you for using our library system.</p>
</body>

</html>
