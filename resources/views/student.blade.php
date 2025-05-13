@include('head')
<div class="container mt-5">
    <h2 class="mb-4">All Students</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Students Table Card -->
    <div class="card">
        <div class="card-header">
            <strong>Student List</strong>

        </div>

        <div class="d-flex justify-content-end m-2">
            <button id="exportExcel" class="btn btn-success me-2">
                <i class="bi bi-file-earmark-excel"></i>
            </button>
            <button id="exportPDF" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i>
            </button>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered At</th>
                        <th>Book Name</th>
                        <th>Request Date</th>
                        <th>Returned Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        @foreach ($student->borrowRequests as $request)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->created_at->format('Y-m-d') }}</td>
                                <td>{{ $request->book->title }}</td> <!-- Display Book Name -->
                                <td>{{ $request->request_date }}</td> <!-- Display Request Date -->
                                <td>{{ $request->return_date }}
                                </td> <!-- Display Returned Date -->
                                <td>{{ ucfirst($request->status) }}</td> <!-- Display Status -->
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script>
    // Excel Export
    document.getElementById('exportExcel').addEventListener('click', function() {
        let table = document.querySelector("table");
        let workbook = XLSX.utils.table_to_book(table, {
            sheet: "Students"
        });
        XLSX.writeFile(workbook, 'students.xlsx');
    });

    // PDF Export
    document.getElementById('exportPDF').addEventListener('click', function() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF();

        doc.autoTable({
            html: 'table'
        });

        doc.save('students.pdf');
    });
</script>
