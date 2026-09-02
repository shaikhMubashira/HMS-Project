<?php
session_start();

$session_username = isset($_SESSION['Username']) ? $_SESSION['Username'] : "Guest Traveler";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rooms'])) {
    
    $selected_rooms  = $_POST['rooms']; 
    $check_in        = $_POST['check_in'] ?? '';
    $check_out       = $_POST['check_out'] ?? '';
    $payment_method  = 'Pay on Arrival (At Front Desk)';
    
    // Process Date Differences Math
    $date1 = date_create($check_in);
    $date2 = date_create($check_out);
    $diff  = date_diff($date1, $date2);
    $num_nights = intval($diff->format("%r%a"));
    if ($num_nights < 1) { $num_nights = 1; }

    $compiled_room_details_html = "";
    $final_grand_total = 0;

    // DESIGNER MODE SAFETY CONNECTION TRICK
    $con = @mysqli_connect("localhost", "root", "", "client", 3307);
    if (!$con) { $con = @mysqli_connect("localhost", "root", "", "client"); }
    $database_saved = $con ? true : false;

    foreach ($selected_rooms as $room_string) {
        $price = 0; $qty = 1; 

        if (strpos($room_string, "Room 101") !== false) { $price = 1500; $qty = intval($_POST['qty_101'] ?? 1); }
        else if (strpos($room_string, "Room 102") !== false) { $price = 1500; $qty = intval($_POST['qty_102'] ?? 1); }
        else if (strpos($room_string, "Room 103") !== false) { $price = 1500; $qty = intval($_POST['qty_103'] ?? 1); }
        else if (strpos($room_string, "Room 104") !== false) { $price = 1000; $qty = intval($_POST['qty_104'] ?? 1); }
        else if (strpos($room_string, "Room 105") !== false) { $price = 1000; $qty = intval($_POST['qty_105'] ?? 1); }
        else if (strpos($room_string, "Room 106") !== false) { $price = 1000; $qty = intval($_POST['qty_106'] ?? 1); }
        
        else if (strpos($room_string, "Room 201") !== false) { $price = 1800; $qty = intval($_POST['qty_201'] ?? 1); }
        else if (strpos($room_string, "Room 202") !== false) { $price = 1800; $qty = intval($_POST['qty_202'] ?? 1); }
        else if (strpos($room_string, "Room 203") !== false) { $price = 2500; $qty = intval($_POST['qty_203'] ?? 1); }
        else if (strpos($room_string, "Room 204") !== false) { $price = 2500; $qty = intval($_POST['qty_204'] ?? 1); }
        else if (strpos($room_string, "Room 205") !== false) { $price = 4000; $qty = intval($_POST['qty_205'] ?? 1); }
        else if (strpos($room_string, "Room 206") !== false) { $price = 4000; $qty = intval($_POST['qty_206'] ?? 1); }
        
        else if (strpos($room_string, "Room 301") !== false) { $price = 2500; $qty = intval($_POST['qty_301'] ?? 1); }
        else if (strpos($room_string, "Room 302") !== false) { $price = 2500; $qty = intval($_POST['qty_302'] ?? 1); }
        else if (strpos($room_string, "Room 303") !== false) { $price = 1800; $qty = intval($_POST['qty_303'] ?? 1); }
        else if (strpos($room_string, "Room 304") !== false) { $price = 1800; $qty = intval($_POST['qty_304'] ?? 1); }
        else if (strpos($room_string, "Room 305") !== false) { $price = 5500; $qty = intval($_POST['qty_305'] ?? 1); }
        else if (strpos($room_string, "Room 306") !== false) { $price = 5500; $qty = intval($_POST['qty_306'] ?? 1); }

        else if (strpos($room_string, "Room 401") !== false) { $price = 2500; $qty = intval($_POST['qty_401'] ?? 1); }
        else if (strpos($room_string, "Room 402") !== false) { $price = 2500; $qty = intval($_POST['qty_402'] ?? 1); }
        else if (strpos($room_string, "Room 403") !== false) { $price = 1800; $qty = intval($_POST['qty_403'] ?? 1); }
        else if (strpos($room_string, "Room 404") !== false) { $price = 1800; $qty = intval($_POST['qty_404'] ?? 1); }
        else if (strpos($room_string, "Room 405") !== false) { $price = 4000; $qty = intval($_POST['qty_405'] ?? 1); }
        else if (strpos($room_string, "Room 406") !== false) { $price = 4000; $qty = intval($_POST['qty_406'] ?? 1); }

        else if (strpos($room_string, "Room 501") !== false) { $price = 5500; $qty = intval($_POST['qty_501'] ?? 1); }
        else if (strpos($room_string, "Room 502") !== false) { $price = 5500; $qty = intval($_POST['qty_502'] ?? 1); }
        else if (strpos($room_string, "Room 503") !== false) { $price = 5500; $qty = intval($_POST['qty_503'] ?? 1); }
        else if (strpos($room_string, "Room 504") !== false) { $price = 5500; $qty = intval($_POST['qty_504'] ?? 1); }
        else if (strpos($room_string, "Room 505") !== false) { $price = 2500; $qty = intval($_POST['qty_505'] ?? 1); }
        else if (strpos($room_string, "Room 506") !== false) { $price = 2500; $qty = intval($_POST['qty_506'] ?? 1); }

        $subtotal = $price * $qty * $num_nights;
        $final_grand_total += $subtotal;

        $compiled_room_details_html .= "
            <div class='detail-row'>
                <strong style='color:#0a182f;'>{$room_string} (x{$qty})</strong>
                <span class='fw-bold text-dark'>₹" . number_format($price * $qty) . " / night</span>
            </div>";

        if ($database_saved) {
            $admin_room_record = $room_string . " (Qty: " . $qty . ")";
            $sql = "INSERT INTO bookings (username, room_name, check_in, num_nights, payment_method, total_amount) 
                    VALUES ('$session_username', '$admin_room_record', '$check_in', '$num_nights', '$payment_method', '$subtotal')";
            mysqli_query($con, $sql);
        }
    }
    if ($database_saved) { mysqli_close($con); }
} else {
    echo "<script>alert('Please select at least one room checkbox option before continuing.'); window.location.href='Roombooking.php';</script>";
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
        
        /* Large solid white paper receipt card */
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

        .detail-row strong { color: #4a5568; font-weight: 600; }
        .detail-row span { color: #1a202c; }

        /* Left Content Sub-Boxes */
        .inner-summary-block {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }

        /* Right Summary Total Box Accent */
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

        /* Input field customizations */
        .custom-textarea {
            background-color: #f8fafc !important;
            border: 1px solid #cbd5e0 !important;
            color: #333 !important;
            border-radius: 8px;
            resize: none;
            font-size: 14px;
        }
        .custom-textarea:focus {
            box-shadow: 0 0 8px rgba(36, 182, 230, 0.3);
            border-color: #24b6e6 !important;
        }
    </style>
</head>
<body>

    <!-- Main Container sets up a wide layout -->
    <div class="container col-12 col-sm-11 col-md-11 col-lg-10 mt-2">
        <div class="wide-receipt-box" style="background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3); color: #2b2b2b;">
            
            <!-- Unified Top Receipt Banner Segment -->
            <div class="receipt-header" style="text-align: center; border-bottom: 2px dashed #e2e8f0; padding: 30px; background: #f8fafc;">
                <h1 style="color: #0a182f; font-weight: 800; margin: 0; letter-spacing: 1px;">REST INN</h1>
                <div style="font-size: 12px; text-transform: uppercase; letter-spacing: 3px; color: #718096; font-weight: bold; margin-top: 5px;">Review & Confirm Your Reservation</div>
            </div>
            
            <!-- Side-by-Side Double Column Form Grid Structure -->
            <form method="POST" action="" class="p-4 p-md-5">
                
                <!-- TOP REGION: Side-by-Side Content Grid -->
                <div class="row g-4">
                    
                    <!-- LEFT COLUMN (7/12 parts) -->
                    <div class="col-12 col-md-7">
                        <h4 class="fw-bold mb-3" style="color: #0a182f; font-size:18px;">📋 Selected Accommodations</h4>
                        <div class="mb-4">
                            <!-- Injected Dynamic Room Selection Array Lines -->
                            <?php echo $compiled_room_details_html; ?>
                        </div>

                        <!-- REQUEST MESSAGE TEXTAREA BOX -->
                        <div class="mt-4 pt-2">
                            <h4 class="fw-bold mb-2" style="color: #0a182f; font-size:18px;">💡 Special Requests / Extra Facilities (Optional)</h4>
                            <p class="text-muted small mb-2">Let us know if you require early check-in, airport pickup, wheelchair access, food allergies, or room surprise arrangements.</p>
                            <textarea name="special_requests" class="form-control custom-textarea" rows="4" placeholder="Type your special instructions or requests here..."></textarea>
                        </div>
                    </div>

                    <!-- RIGHT COLUMN (5/12 parts) -->
                    <div class="col-12 col-md-5 border-start ps-md-4" style="border-color: #edf2f7 !important;">
                        <h4 class="fw-bold mb-3" style="color: #0a182f; font-size:18px;">⏱ Stay Parameters</h4>
                        <div class="inner-summary-block mb-4" style="background: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0;">
                            <div class="detail-row"><strong>Check-In:</strong> <span class="fw-bold"><?php echo htmlspecialchars($check_in); ?></span></div>
                            <div class="detail-row"><strong>Check-Out:</strong> <span class="fw-bold"><?php echo htmlspecialchars($check_out); ?></span></div>
                            <div class="detail-row"><strong>Duration:</strong> <span class="fw-bold text-dark" style="font-size: 14px;"><?php echo $num_nights; ?> Night(s)</span></div>
                            <div class="detail-row" style="border:none;"><strong>Payment Method:</strong> <span class="text-muted fw-bold">Pay at Desk</span></div>
                            <div class="detail-row" style="border:none; padding-bottom:0;">
                                <strong>Payment Status:</strong> 
                                <span class="text-warning fw-bold" style="font-size:13px;">⚠️ DUE AT CHECK-IN</span>
                            </div>
                        </div>
                    </div>

                </div> <!-- Closes the side-by-side row split grid -->

                <!-- ======================================================== -->
                <!-- BOTTOM REGION: MOVED HERE TO SPAN FULL WIDTH ACROSS BOTH SIDES -->
                <!-- ======================================================== -->
                <div class="mt-5 pt-4 border-top" style="border-color: #edf2f7 !important;">
                    
                    <!-- 1. Full-Width Grand Billing Highlight Card -->
                    <div class="total-highlight-card text-center mb-4" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px;">
                        <span class="small uppercase fw-bold text-muted d-block mb-1" style="letter-spacing:1px; font-size:11px;">GRAND TOTAL PAYABLE</span>
                        <div class="total-amount" style="font-size: 32px; font-weight: 800; color: #16a34a;">
                            ₹<?php echo number_format($final_grand_total); ?>
                        </div>
                        <small class="text-success fw-bold d-block mt-1">Local taxes & service fees included</small>
                    </div>

                    <!-- 2. Full-Width Order & Modification Action Buttons with Equal Height -->
                    <div class="row g-2">
                        <div class="col-12">
                            <button type="button" onclick="alert('Order Dispatched! Your selection has been logged onto the hotel database system. Welcome to Rest Inn!'); window.location.href='index.php';" class="btn btn-success w-100 fw-bold text-uppercase d-flex align-items-center justify-content-center" style="height: 52px; background: #16a34a; border: none; border-radius: 10px; font-size: 14px; letter-spacing: 0.5px;">
                                Place Order
                            </button>
                        </div>
                        <div class="col-12">
                            <a href="Roombooking.php" class="btn btn-outline-secondary w-100 fw-bold text-uppercase d-flex align-items-center justify-content-center" style="height: 52px; border-radius: 10px; font-size: 14px; letter-spacing: 0.5px; text-decoration: none;">
                                ← Modify Items
                            </a>
                        </div>
                    </div>

                </div>

            </form>
        </div> 
    </div> 
</body>
</html>
