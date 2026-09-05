<?php
session_start();
$session_username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest Traveler";

$con = @mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

// 1. FINAL ORDER CONFIRMATION PHASE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_order'])) {
    $selected_rooms = $_POST['rooms'] ?? [];
    $check_in = $_POST['check_in'] ?? '';
    $check_out = $_POST['check_out'] ?? '';
    $num_nights = intval($_POST['num_nights'] ?? 1);
    $payment_method = 'Pay on Arrival (At Front Desk)';

    foreach ($selected_rooms as $room_string) {
        $price = 0;
        $qty = 1;
        $r_num = '';

        if (preg_match('/(\d+)/', $room_string, $m)) {
            $r_num = $m[1];
            $qty = intval($_POST["qty_$r_num"] ?? 1);
        }

        // Fetch price from admin database
        $res = mysqli_query($con, "SELECT price FROM admin.rooms WHERE room_number = '$r_num'");
        if ($res && $row = mysqli_fetch_assoc($res)) {
            $price = $row['price'];
        }

        $subtotal = $price * $qty * $num_nights;
        $admin_room_record = $room_string . " (Qty: " . $qty . ")";

        $sql = "INSERT INTO booking (username, room_name, check_in, check_out, num_nights, payment_method, total_amount) 
                VALUES ('$session_username', '$admin_room_record', '$check_in', '$check_out', $num_nights, '$payment_method', $subtotal)";

        mysqli_query($con, $sql);
        $booking_id = mysqli_insert_id($con);
        $invoice_sql = "INSERT INTO admin.invoice (Booking_id, Total_amt, Payment_status) VALUES ($booking_id, $subtotal, 'Pending')";
        mysqli_query($con, $invoice_sql);
    }
    mysqli_close($con);

    echo "<script>alert('Order Placed Successfully! Welcome to Rest Inn, " . htmlspecialchars($session_username) . "'); window.location.href='index.php';</script>";
    exit;
}

// 2. INITIAL REVIEW PHASE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rooms'])) {
    $selected_rooms = $_POST['rooms'];
    $check_in = $_POST['check_in'] ?? '';
    $check_out = $_POST['check_out'] ?? '';

    $date1 = strtotime($check_in);
    $date2 = strtotime($check_out);
    $num_nights = round(($date2 - $date1) / (60 * 60 * 24));
    if ($num_nights < 1) {
        $num_nights = 1;
    }

    $final_grand_total = 0;
    $compiled_room_details_html = "";

    foreach ($selected_rooms as $room_name) {
        $price = 0;
        $qty = 1;
        $r_num = '';

        if (preg_match('/Room (\d+)/', $room_name, $m) || preg_match('/(\d+)/', $room_name, $m)) {
            $r_num = $m[1];
            $qty = intval($_POST["qty_$r_num"] ?? 1);
        }

        $res = mysqli_query($con, "SELECT price FROM admin.rooms WHERE room_number = '$r_num'");
        if ($res && $row = mysqli_fetch_assoc($res)) {
            $price = $row['price'];
        }

        $subtotal = $price * $qty * $num_nights;
        $final_grand_total += $subtotal;

        $compiled_room_details_html .= "<div class='detail-row'><strong>{$room_name} (x{$qty})</strong> <span>₹" . number_format($subtotal) . "</span></div>";
    }
    mysqli_close($con);
} else {
    echo "<script>alert('Please select at least one room.'); window.location.href='Roombooking.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST INN - Booking Summary Checkout</title>
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

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #edf2f7;
            font-size: 15px;
        }

        .detail-row strong {
            color: #4a5568;
            font-weight: 600;
        }

        .detail-row span {
            color: #1a202c;
        }

        .inner-summary-block {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }

        .total-highlight-card {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 20px;
        }

        .total-amount {
            font-size: 32px;
            font-weight: 800;
            color: #16a34a;
        }
    </style>
</head>

<body>
    <div class="container col-12 col-sm-11 col-md-11 col-lg-10 mt-2">
        <div class="wide-receipt-box">
            <div class="receipt-header">
                <h1 style="color: #0a182f; font-weight: 800; margin: 0;">REST INN</h1>
                <div
                    style="font-size: 12px; text-transform: uppercase; color: #718096; font-weight: bold; margin-top: 5px;">
                    Review & Confirm Your Reservation</div>
            </div>

            <form method="POST" action="" class="p-4 p-md-5">
                <input type="hidden" name="confirm_order" value="1">
                <input type="hidden" name="check_in" value="<?php echo htmlspecialchars($check_in); ?>">
                <input type="hidden" name="check_out" value="<?php echo htmlspecialchars($check_out); ?>">
                <input type="hidden" name="num_nights" value="<?php echo $num_nights; ?>">

                <?php foreach ($selected_rooms as $room):
                    preg_match('/Room (\d+)/', $room, $m);
                    $r_num = $m[1] ?? '';
                    ?>
                    <input type="hidden" name="rooms[]" value="<?php echo htmlspecialchars($room); ?>">
                <?php endforeach; ?>

                <div class="row g-4">
                    <div class="col-12 col-md-7">
                        <h4 class="fw-bold mb-3" style="color: #0a182f; font-size:18px;">📋 Selected Accommodations</h4>
                        <div class="mb-4"><?php echo $compiled_room_details_html; ?></div>
                    </div>
                    <div class="col-12 col-md-5 border-start ps-md-4">
                        <h4 class="fw-bold mb-3" style="color: #0a182f; font-size:18px;">⏱ Stay Parameters</h4>
                        <div class="inner-summary-block mb-4">
                            <div class="detail-row"><strong>Check-In:</strong>
                                <span><?php echo htmlspecialchars($check_in); ?></span>
                            </div>
                            <div class="detail-row"><strong>Check-Out:</strong>
                                <span><?php echo htmlspecialchars($check_out); ?></span>
                            </div>
                            <div class="detail-row"><strong>Duration:</strong> <span><?php echo $num_nights; ?>
                                    Night(s)</span></div>
                            <div class="detail-row" style="border:none;"><strong>Payment:</strong> <span
                                    class="text-warning fw-bold">Pay at Desk</span></div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <div class="total-highlight-card text-center mb-4">
                        <span class="small fw-bold text-muted d-block mb-1">GRAND TOTAL PAYABLE</span>
                        <div class="total-amount">₹<?php echo number_format($final_grand_total); ?></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success w-100 fw-bold text-uppercase"
                                style="height: 52px; background: #16a34a; border-radius: 10px;">Place Order</button>
                        </div>
                        <div class="col-12">
                            <a href="Roombooking.php"
                                class="btn btn-outline-secondary w-100 fw-bold text-uppercase d-flex align-items-center justify-content-center"
                                style="height: 52px; border-radius: 10px; text-decoration: none;">← Modify Items</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>