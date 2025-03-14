<x-site-layout>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>

        <!-- Success Message -->
        <div class="alert alert-success">
            Appointment has been successfully scheduled!
        </div>

        <!-- Table for Managing Appointments -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Hospital</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- Demo Data for Appointments -->
            <tr>
                <td>John Doe</td>
                <td>Dr. Smith</td>
                <td>City Hospital</td>
                <td>Mar 15, 2025 10:00 AM</td>
                <td><span class="badge bg-warning">Scheduled</span></td>
                <td>
                    <button type="button" class="btn btn-success">Approve</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </td>
            </tr>

            <tr>
                <td>Alice Green</td>
                <td>Dr. Johnson</td>
                <td>Greenwood Clinic</td>
                <td>Mar 16, 2025 02:00 PM</td>
                <td><span class="badge bg-success">Approved</span></td>
                <td>
                    <span class="badge bg-success">Approved</span>
                </td>
            </tr>

            <tr>
                <td>Michael Brown</td>
                <td>Dr. Williams</td>
                <td>Springfield Health Center</td>
                <td>Mar 17, 2025 09:30 AM</td>
                <td><span class="badge bg-danger">Canceled</span></td>
                <td>
                    <span class="badge bg-danger">Canceled</span>
                </td>
            </tr>

            <tr>
                <td>Sarah White</td>
                <td>Dr. Adams</td>
                <td>Maplewood Medical</td>
                <td>Mar 18, 2025 11:30 AM</td>
                <td><span class="badge bg-warning">Scheduled</span></td>
                <td>
                    <button type="button" class="btn btn-success">Approve</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </td>
            </tr>

            <tr>
                <td>James Black</td>
                <td>Dr. Lewis</td>
                <td>Pine Valley Hospital</td>
                <td>Mar 19, 2025 01:00 PM</td>
                <td><span class="badge bg-warning">Scheduled</span></td>
                <td>
                    <button type="button" class="btn btn-success">Approve</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</x-site-layout>
