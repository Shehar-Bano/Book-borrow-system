@include('head')
<!-- Main content -->
<main class="container-fluid p-4 flex-grow-1">
    <div class="row">
        <div class="col-md-9">
            <h1 class="h2 font-weight-bold text-dark mb-4">Dashboard Overview</h1>

            <div class="container mt-4">
                <h2 class="mb-4">Welcome, {{ Auth::user()->name }} 👋</h2>

                <!-- Stats Cards -->
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

                    <!-- Total Available Books -->
                    <div class="col">
                        <div class="card shadow-sm border-info">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="h6 text-muted">📚 Available Books</h2>
                                        <p class="display-6 text-info fw-bold mb-0">
                                            {{ $availableBooks }}
                                        </p>
                                    </div>
                                    <div class="icon-shape bg-info text-white rounded-circle p-3">
                                        <i class="fas fa-book-open fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- My Requests -->
                    <div class="col">
                        <div class="card shadow-sm border-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="h6 text-muted">📦 My Requests</h2>
                                        <p class="display-6 text-primary fw-bold mb-0">
                                            {{ $totalRequests }}
                                        </p>
                                    </div>
                                    <div class="icon-shape bg-primary text-white rounded-circle p-3">
                                        <i class="fas fa-clipboard-list fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests -->
                    <div class="col">
                        <div class="card shadow-sm border-warning">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="h6 text-muted">⏳ Pending</h2>
                                        <p class="display-6 text-warning fw-bold mb-0">
                                            {{ $pendingRequests }}
                                        </p>
                                    </div>
                                    <div class="icon-shape bg-warning text-white rounded-circle p-3">
                                        <i class="fas fa-hourglass-half fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Quick Actions (keep existing) -->
        </div>

        <!-- User Profile Sidebar (keep existing) -->
    </div>

</main>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
