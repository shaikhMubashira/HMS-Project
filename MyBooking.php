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
    <title>MTF INN - My Bookings</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(rgba(10, 24, 47, 0.75), rgba(10, 24, 47, 0.85)), url('./image/login/hotel-bg.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            padding: 40px 0;
            color: #fff;
        }

        .wide-receipt-box {
            background: #ffffff;
            border-radius: 20px;
            color: #2b2b2b;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .receipt-header {
            border-bottom: 2px dashed #cbd5e1;
            padding: 35px;
            background: #f8fafc;
        }

        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .table {
            margin-bottom: 0 !important;
        }

        .table th {
            background-color: #0a182f !important;
            color: #fff !important;
            font-weight: 600;
            border: none;
            padding: 18px 16px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .table td {
            padding: 18px 16px;
            vertical-align: middle;
            color: #334155;
            font-size: 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(248, 250, 252, 0.8) !important;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f1f5f9 !important;
            transition: background-color 0.2s ease;
        }

        /* Custom Premium Cancel Button style sheet */
        .btn-danger-custom {
            background-color: #ef4444;
            color: #ffffff !important;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-decoration: none !important;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
        }

        .btn-danger-custom:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(239, 68, 68, 0.3);
        }

        .badge-payment {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
    </style>
</head>

<body>
    <div class="container col-12 col-sm-11 col-md-11 col-lg-10 mt-2">
        <div class="wide-receipt-box">
            <div class="receipt-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    
                    <!-- Image Branding Logo  -->
                    <a href="index.php" style="text-decoration: none; display: inline-block;">
                        <img src="image/logo1.png" alt="MTF INN Logo" style="height: 60px; width: auto; max-height: 100%; display: block;">
                    </a>
                    
                    <!-- Subtle boundary separator line to keep it clean -->
                    <div style="width: 2px; height: 40px; background-color: #cbd5e1; opacity: 0.7;" class="d-none d-sm-block"></div>

                    <div style="font-size: 13px; text-transform: uppercase; color: #64748b; font-weight: 700;">
                        <i class="fa-solid fa-user me-1" style="color: #d4af37;"></i> Welcome, <?php echo htmlspecialchars($session_username); ?> | Booking History
                    </div>
                </div>
                <div>
                    <a href="index.php" class="btn btn-outline-dark btn-sm fw-bold px-3 py-2" style="border-radius: 8px; font-size: 13px; letter-spacing: 0.3px;">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Home
                    </a>
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
                                        <td><strong style="color: #64748b;">#<?php echo $row['id']; ?></strong></td>
                                        <td class="fw-semibold" style="color: #0a182f;"><?php echo htmlspecialchars($row['room_name']); ?></td>
                                        <td><i class="fa-regular fa-calendar-check me-1 text-muted"></i> <?php echo $row['check_in']; ?></td>
                                        <td><i class="fa-regular fa-calendar-xmark me-1 text-muted"></i> <?php echo $row['check_out']; ?></td>
                                        <td><span class="badge bg-secondary px-2 py-1" style="font-size: 12px; font-weight: 600;"><?php echo $row['num_nights']; ?>N</span></td>
                                        <td class="fw-bold text-success" style="font-size: 16px;">₹<?php echo number_format($row['total_amount'], 2); ?></td>
                                        <td><span class="badge bg-warning text-dark badge-payment"><i class="fa-solid fa-money-bill-wave me-1"></i> <?php echo $row['payment_method'] ?? 'Pay at Desk'; ?></span></td>
                                        <td class="text-center">
                                            <a href="MyBooking.php?cancel_id=<?php echo $row['id']; ?>" 
                                               class="btn-danger-custom d-inline-block" 
                                               onclick="return confirm('Are you sure you want to cancel this booking?');">
                                               Cancel
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-5 fs-5 fw-medium">
                                        <i class="fa-solid fa-hotel d-block mb-3 text-light-50" style="font-size: 40px; color: #cbd5e1;"></i>
                                        You haven't made any booking reservations yet.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 pt-2 text-end">
                    <a href="Roombooking.php" class="btn btn-success fw-bold text-uppercase px-4 py-2" style="border-radius: 8px; background-color: #10b981; border: none; font-size: 13px; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                        <i class="fa-solid fa-plus me-1"></i> Book More Rooms
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($con); ?>
