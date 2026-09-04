<?php
session_start();

// Agar user login nahi hai, toh login page par bhej do
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$session_username = $_SESSION['username'];

$con = @mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Handle Cancellation Request
if (isset($_GET['cancel_id'])) {
    $cancel_id = intval($_GET['cancel_id']);
    
    // Sirf usi user ki booking delete hogi jo logged-in hai (Security check)
    $del_query = "DELETE FROM booking WHERE id = $cancel_id AND username = '$session_username'";
    mysqli_query($con, $del_query);
    
    // Admin database se bhi invoice hataane ke liye
    $admin_con = @mysqli_connect("localhost", "root", "", "admin");
    if ($admin_con) {
        mysqli_query($admin_con, "DELETE FROM invoice WHERE Booking_id = $cancel_id");
        mysqli_close($admin_con);
    }
    
    header("Location: MyBooking.php");
    exit();
}

// Fetch bookings for the logged-in user only
$query = "SELECT * FROM booking WHERE username = '$session_username' ORDER BY id DESC";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST INN - My Bookings</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(rgba(10, 24, 47, 0.5), rgba(10, 24, 47, 0.7)), url('./image/login/hotel-bg.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            padding: 30px 0;
            color: #fff;
        }

        .wide-receipt-box {
            background: #ffffff;
            border-radius: 20px;
            color: #2b2b2b;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .receipt-header {
            text-align: center;
            border-bottom: 2px dashed #e2e8f0;
            padding: 30px;
            background: #f8fafc;
        }

        .table th {
            background-color: #0a182f !important;
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 14px 16px;
        }

        .table td {
            padding: 14px 16px;
            vertical-align: middle;
            color: #2b2b2b;
        }
    </style>
</head>

<body>
    <div class="container col-12 col-sm-11 col-md-11 col-lg-10 mt-2">
        <div class="wide-receipt-box">
            <div class="receipt-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 style="color: #0a182f; font-weight: 800; margin: 0; text-align: left;">REST INN</h1>
                    <div style="font-size: 12px; text-transform: uppercase; color: #718096; font-weight: bold; margin-top: 5px; text-align: left;">
                        Welcome, <?php echo htmlspecialchars($session_username); ?> | My Bookings History
                    </div>
                </div>
                <div>
                    <a href="index.php" class="btn btn-outline-dark btn-sm fw-bold">Back to Home</a>
                </div>
            </div>

            <div class="p-4 p-md-5">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Room Details</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Nights</th>
                                <th>Total Amt</th>
                                <th>Payment</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><strong>#<?php echo $row['id']; ?></strong></td>
                                        <td><?php echo htmlspecialchars($row['room_name']); ?></td>
                                        <td><?php echo $row['check_in']; ?></td>
                                        <td><?php echo $row['check_out']; ?></td>
                                        <td><?php echo $row['num_nights']; ?>N</td>
                                        <td class="fw-bold text-success">₹<?php echo number_format($row['total_amount'], 2); ?></td>
                                        <td><span class="badge bg-warning text-dark"><?php echo $row['payment_method'] ?? 'Pay at Desk'; ?></span></td>
                                        <td class="text-center">
                                            <a href="MyBooking.php?cancel_id=<?php echo $row['id']; ?>" 
                                               class="btn btn-sm btn-danger fw-bold px-3" 
                                               onclick="return confirm('Are you sure you want to cancel this booking?');">
                                               Cancel
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5 fs-5">You haven't made any bookings yet.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-end">
                    <a href="Roombooking.php" class="btn btn-success fw-bold text-uppercase px-4 py-2" style="border-radius: 10px;">+ Book More Rooms</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($con); ?>