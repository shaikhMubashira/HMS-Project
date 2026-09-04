<?php
$con = mysqli_connect("localhost", "root", "", "admin");
if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

$query = "SELECT i.*, b.username, b.room_name, b.num_nights, b.payment_method 
          FROM admin.invoice i 
          JOIN client.booking b ON i.Booking_id = b.id 
          ORDER BY i.Booking_id DESC";
$result = mysqli_query($con, $query);
?>

<div class="container-fluid px-0">
    <h2 class="mb-4 fw-bold text-dark">Customer Invoices & Bills</h2>
    
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Invoice / Booking ID</th>
                            <th>Customer Username</th>
                            <th>Room Details</th>
                            <th>Nights</th>
                            <th>Total Amt (₹)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td>#<?php echo $row['Booking_id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                                    <td><?php echo $row['num_nights']; ?></td>
                                    <td class="fw-bold text-success">₹<?php echo number_format($row['Total_amt'], 2); ?></td>
                                    <td><span class="badge bg-warning text-dark px-2 py-1"><?php echo $row['Payment_status']; ?></span></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center text-muted py-4">No invoices found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php mysqli_close($con); ?>