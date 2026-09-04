<?php
$con = @mysqli_connect("localhost", "root", "", "client");
$result = $con ? $con->query("SELECT id, username, room_name, check_in,check_out, num_nights, total_amount FROM booking ORDER BY id DESC") : null;
?>
<h2>Bookings List</h2>
<table class="table table-striped table-hover align-middle mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Guest Username</th>
            <th>Room & Qty</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Nights</th>
            <th>Total (₹)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['room_name']); ?></td>
            <td><?php echo htmlspecialchars($row['check_in']); ?></td>
            <td><?php echo htmlspecialchars($row['check_out']); ?></td>
            <td><?php echo $row['num_nights']; ?></td>
            <td>₹<?php echo number_format($row['total_amount']); ?></td>
            <td>
                <a href="delete_booking.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } 
        } else { ?>
        <tr><td colspan="8" class="text-center">No bookings found.</td></tr>
        <?php } ?>
    </tbody>
</table>