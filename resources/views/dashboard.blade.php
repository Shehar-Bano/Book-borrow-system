@include('head');
<!-- Main content -->
<main class="container-fluid p-4 flex-grow-1">
    <div class="row">
        <div class="col-md-9">
            <h1 class="h2 font-weight-bold text-dark mb-4">Dashboard Overview</h1>

            <!-- Stats Cards -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <!-- Total Books Card -->
                <div class="col">
                    <div class="card shadow-sm border-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="h5 font-weight-semibold text-muted">📚 Total Books</h2>
                                    <p class="display-4 font-weight-bold text-primary mb-0">
                                        {{ $totalBooks }}
                                    </p>
                                </div>
                                <div class="icon-shape bg-primary text-white rounded-circle p-3">
                                    <i class="fas fa-book fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Students Card -->
                <div class="col">
                    <div class="card shadow-sm border-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="h5 font-weight-semibold text-muted">👥 Total Students</h2>
                                    <p class="display-4 font-weight-bold text-success mb-0">
                                        {{ $totalStudents }}
                                    </p>
                                </div>
                                <div class="icon-shape bg-success text-white rounded-circle p-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card -->
                <div class="col">
                    <div class="card shadow-sm border-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="h5 font-weight-semibold text-muted">📬 Pending Requests</h2>
                                    <p class="display-4 font-weight-bold text-warning mb-0">
                                        {{ $pendingRequests }}
                                    </p>
                                </div>
                                <div class="icon-shape bg-warning text-white rounded-circle p-3">
                                    <i class="fas fa-envelope fa-2x"></i>
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
