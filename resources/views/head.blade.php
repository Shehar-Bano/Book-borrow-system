<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="d-flex h-screen">
        <!-- Sidebar (keep same as before) -->
        <aside class="d-flex flex-column bg-white shadow-md p-3" style="width: 250px;">
            <div class="p-4 text-xl font-weight-bold border-bottom">
                📚 Book Borrowing
            </div>
            <nav class="mt-4 flex-grow-1">
                <ul class="list-unstyled text-gray-700">
                    <li>
                        <a href="{{ url('/dashboard') }}"
                            class="d-flex align-items-center px-4 py-2 text-dark text-decoration-none hover:bg-gray-100">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    @if (auth()->user()->role !== 'student')
                        <li>
                            <!-- Check if the role is not student -->

                            <a href="{{ url('books') }}"
                                class="d-flex align-items-center px-4 py-2 text-dark text-decoration-none hover:bg-gray-100">
                                <i class="bi bi-book me-2"></i> Books
                            </a>

                        </li>
                    @endif
                    <li>
                        <a href="{{ route('borrow_requests.index') }}"
                            class="d-flex align-items-center px-4 py-2 text-dark text-decoration-none hover:bg-gray-100">
                            <i class="bi bi-journal-check me-2"></i> Borrow Requests
                        </a>
                    </li>
                    @if (auth()->user()->role !== 'student')
                        <li>

                            <a href="{{ url('/students') }}"
                                class="d-flex align-items-center px-4 py-2 text-dark text-decoration-none hover:bg-gray-100">
                                <i class="bi bi-people me-2"></i> Students
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>


            <!-- User Dropdown -->
            <div class="dropdown mt-auto">
                <a class="btn btn-link w-100 text-decoration-none text-dark dropdown-toggle d-flex align-items-center"
                    href="#" role="button" id="userDropdown" data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="ms-2 text-start">
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                        <small class="text-muted">{{ auth()->user()->role ?? 'User' }}</small>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end w-100" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-edit me-2"></i> Edit Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </aside>
