<?php
// session_start();

// $session_username = isset($_SESSION['Username']) ? $_SESSION['Username'] : "Guest Traveler";

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rooms'])) {
    
//     $selected_rooms  = $_POST['rooms']; 
//     $check_in        = $_POST['check_in'] ?? '';
//     $check_out       = $_POST['check_out'] ?? '';
//     $payment_method  = 'Pay on Arrival (At Front Desk)';
    
//     // Process Date Differences Math
//     $date1 = date_create($check_in);
//     $date2 = date_create($check_out);
//     $diff  = date_diff($date1, $date2);
//     $num_nights = intval($diff->format("%r%a"));
//     if ($num_nights < 1) { $num_nights = 1; }

//     $compiled_room_details_html = "";
//     $final_grand_total = 0;

//     // DEFAULT PORT CONNECTION
//     $con = @mysqli_connect("localhost", "root", "", "client");
//     $database_saved = $con ? true : false;

//     // Prepare statement beforehand for security (Prepared Statement)
//     $stmt = null;
//     if ($database_saved) {
//         $sql = "INSERT INTO bookings (username, room_name, check_in, num_nights, payment_method, total_amount) VALUES (?, ?, ?, ?, ?, ?)";
//         $stmt = mysqli_prepare($con, $sql);
//     }

//     foreach ($selected_rooms as $room_string) {
//         $price = 0; $qty = 1; 

//         if (strpos($room_string, "Room 101") !== false) { $price = 1500; $qty = intval($_POST['qty_101'] ?? 1); }
//         else if (strpos($room_string, "Room 102") !== false) { $price = 1500; $qty = intval($_POST['qty_102'] ?? 1); }
//         else if (strpos($room_string, "Room 103") !== false) { $price = 1500; $qty = intval($_POST['qty_103'] ?? 1); }
//         else if (strpos($room_string, "Room 104") !== false) { $price = 1000; $qty = intval($_POST['qty_104'] ?? 1); }
//         else if (strpos($room_string, "Room 105") !== false) { $price = 1000; $qty = intval($_POST['qty_105'] ?? 1); }
//         else if (strpos($room_string, "Room 106") !== false) { $price = 1000; $qty = intval($_POST['qty_106'] ?? 1); }
        
//         else if (strpos($room_string, "Room 201") !== false) { $price = 1800; $qty = intval($_POST['qty_201'] ?? 1); }
//         else if (strpos($room_string, "Room 202") !== false) { $price = 1800; $qty = intval($_POST['qty_202'] ?? 1); }
//         else if (strpos($room_string, "Room 203") !== false) { $price = 2500; $qty = intval($_POST['qty_203'] ?? 1); }
//         else if (strpos($room_string, "Room 204") !== false) { $price = 2500; $qty = intval($_POST['qty_204'] ?? 1); }
//         else if (strpos($room_string, "Room 205") !== false) { $price = 4000; $qty = intval($_POST['qty_205'] ?? 1); }
//         else if (strpos($room_string, "Room 206") !== false) { $price = 4000; $qty = intval($_POST['qty_206'] ?? 1); }
        
//         else if (strpos($room_string, "Room 301") !== false) { $price = 2500; $qty = intval($_POST['qty_301'] ?? 1); }
//         else if (strpos($room_string, "Room 302") !== false) { $price = 2500; $qty = intval($_POST['qty_302'] ?? 1); }
//         else if (strpos($room_string, "Room 303") !== false) { $price = 1800; $qty = intval($_POST['qty_303'] ?? 1); }
//         else if (strpos($room_string, "Room 304") !== false) { $price = 1800; $qty = intval($_POST['qty_304'] ?? 1); }
//         else if (strpos($room_string, "Room 305") !== false) { $price = 5500; $qty = intval($_POST['qty_305'] ?? 1); }
//         else if (strpos($room_string, "Room 306") !== false) { $price = 5500; $qty = intval($_POST['qty_306'] ?? 1); }

//         else if (strpos($room_string, "Room 401") !== false) { $price = 2500; $qty = intval($_POST['qty_401'] ?? 1); }
//         else if (strpos($room_string, "Room 402") !== false) { $price = 2500; $qty = intval($_POST['qty_402'] ?? 1); }
//         else if (strpos($room_string, "Room 403") !== false) { $price = 1800; $qty = intval($_POST['qty_403'] ?? 1); }
//         else if (strpos($room_string, "Room 404") !== false) { $price = 1800; $qty = intval($_POST['qty_404'] ?? 1); }
//         else if (strpos($room_string, "Room 405") !== false) { $price = 4000; $qty = intval($_POST['qty_405'] ?? 1); }
//         else if (strpos($room_string, "Room 406") !== false) { $price = 4000; $qty = intval($_POST['qty_406'] ?? 1); }

//         else if (strpos($room_string, "Room 501") !== false) { $price = 5500; $qty = intval($_POST['qty_501'] ?? 1); }
//         else if (strpos($room_string, "Room 502") !== false) { $price = 5500; $qty = intval($_POST['qty_502'] ?? 1); }
//         else if (strpos($room_string, "Room 503") !== false) { $price = 5500; $qty = intval($_POST['qty_503'] ?? 1); }
//         else if (strpos($room_string, "Room 504") !== false) { $price = 5500; $qty = intval($_POST['qty_504'] ?? 1); }
//         else if (strpos($room_string, "Room 505") !== false) { $price = 2500; $qty = intval($_POST['qty_505'] ?? 1); }
//         else if (strpos($room_string, "Room 506") !== false) { $price = 2500; $qty = intval($_POST['qty_506'] ?? 1); }

//         $subtotal = $price * $qty * $num_nights;
//         $final_grand_total += $subtotal;

//         $compiled_room_details_html .= "
//             <div class='detail-row'>
//                 <strong style='color:#0a182f;'>{$room_string} (x{$qty})</strong>
//                 <span class='fw-bold text-dark'>₹" . number_format($price * $qty) . " / night</span>
//             </div>";

//         if ($database_saved && $stmt) {
//             $admin_room_record = $room_string . " (Qty: " . $qty . ")";
//             mysqli_stmt_bind_param($stmt, "sssisi", $session_username, $admin_room_record, $check_in, $num_nights, $payment_method, $subtotal);
//             mysqli_stmt_execute($stmt);
//         }
//     }
    
//     if ($stmt) { mysqli_stmt_close($stmt); }
//     if ($database_saved) { mysqli_close($con); }
// } else {
//     echo "<script>alert('Please select at least one room checkbox option before continuing.'); window.location.href='Roombooking.php';</script>";
//     exit;
// }
 ?>
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
    $check_in       = $_POST['check_in'] ?? '';
    $check_out      = $_POST['check_out'] ?? '';
    $num_nights     = intval($_POST['num_nights'] ?? 1);
    $payment_method = 'Pay on Arrival (At Front Desk)';
    
    foreach ($selected_rooms as $room_string) {
        $price = 0; $qty = 1;
        if (preg_match('/Room (\d+)/', $room_string, $m)) {
            $r_num = $m[1];
            $qty = intval($_POST["qty_$r_num"] ?? 1);
            
            if (in_array($r_num, [101,102,103])) $price = 1500;
            elseif (in_array($r_num, [104,105,106])) $price = 1000;
            elseif (in_array($r_num, [201,202])) $price = 1800;
            elseif (in_array($r_num, [203,204])) $price = 2500;
            elseif (in_array($r_num, [205,206,405,406])) $price = 4000;
            elseif (in_array($r_num, [301,302,401,402,505,506])) $price = 2500;
            elseif (in_array($r_num, [303,304,403,404])) $price = 1800;
            elseif (in_array($r_num, [305,306,501,502,503,504])) $price = 5500;
        }
        $subtotal = $price * $qty * $num_nights;
        $admin_room_record = $room_string . " (Qty: " . $qty . ")";

        $sql = "INSERT INTO booking (username, room_name, check_in, check_out, num_nights, payment_method, total_amount) 
                VALUES ('$session_username', '$admin_room_record', '$check_in', '$check_out', $num_nights, '$payment_method', $subtotal)";
        
        mysqli_query($con, $sql);
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
    if ($num_nights < 1) { $num_nights = 1; }

    $final_grand_total = 0; // Changed to match your page variable
    $compiled_room_details_html = "";

    foreach ($selected_rooms as $room_name) {
        $price = 0;
        $qty = 1;
        
        if (preg_match('/Room (\d+)/', $room_name, $m)) {
            $room_num = $m[1];
            $qty = intval($_POST["qty_$room_num"] ?? 1);

            if (in_array($room_num, ['101','102','103'])) $price = 1500;
            elseif (in_array($room_num, ['104','105','106'])) $price = 1000;
            elseif (in_array($room_num, ['201','202'])) $price = 1800;
            elseif (in_array($room_num, ['203','204'])) $price = 2500;
            elseif (in_array($room_num, ['205','206','405','406'])) $price = 4000;
            elseif (in_array($room_num, ['301','302','401','402'])) $price = 2500;
            elseif (in_array($room_num, ['303','304','403','404'])) $price = 1800;
            elseif (in_array($room_num, ['305','306','501','502','503','504'])) $price = 5500;
            elseif (in_array($room_num, ['505','506'])) $price = 2500;
        }

        $subtotal = $price * $qty * $num_nights;
        $final_grand_total += $subtotal; // Updated accumulator

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

        .detail-row strong { color: #4a5568; font-weight: 600; }
        .detail-row span { color: #1a202c; }

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
    <div class="container col-12 col-sm-11 col-md-11 col-lg-10 mt-2">
        <div class="wide-receipt-box">
            <div class="receipt-header">
                <h1 style="color: #0a182f; font-weight: 800; margin: 0;">REST INN</h1>
                <div style="font-size: 12px; text-transform: uppercase; color: #718096; font-weight: bold; margin-top: 5px;">Review & Confirm Your Reservation</div>
            </div>
            
            <form method="POST" action="" class="p-4 p-md-5">
                <!-- Hidden inputs to pass data safely to the final insertion trigger -->
                <input type="hidden" name="confirm_order" value="1">
                <input type="hidden" name="check_in" value="<?php echo htmlspecialchars($check_in); ?>">
                <input type="hidden" name="check_out" value="<?php echo htmlspecialchars($check_out); ?>">
                <input type="hidden" name="num_nights" value="<?php echo $num_nights; ?>">

                <?php foreach ($selected_rooms as $room): 
                    preg_match('/Room (\d+)/', $room, $m);
                    $r_num = $m[1] ?? '';
                ?>
                    <input type="hidden" name="rooms[]" value="<?php echo htmlspecialchars($room); ?>">
                    <input type="hidden" name="qty_<?php echo $r_num; ?>" value="<?php echo intval($_POST["qty_$r_num"] ?? 1); ?>">
                <?php endforeach; ?>

                <div class="row g-4">
                    <div class="col-12 col-md-7">
                        <h4 class="fw-bold mb-3" style="color: #0a182f; font-size:18px;">📋 Selected Accommodations</h4>
                        <div class="mb-4"><?php echo $compiled_room_details_html; ?></div>
                    </div>
                    <div class="col-12 col-md-5 border-start ps-md-4">
                        <h4 class="fw-bold mb-3" style="color: #0a182f; font-size:18px;">⏱ Stay Parameters</h4>
                        <div class="inner-summary-block mb-4">
                            <div class="detail-row"><strong>Check-In:</strong> <span><?php echo htmlspecialchars($check_in); ?></span></div>
                            <div class="detail-row"><strong>Check-Out:</strong> <span><?php echo htmlspecialchars($check_out); ?></span></div>
                            <div class="detail-row"><strong>Duration:</strong> <span><?php echo $num_nights; ?> Night(s)</span></div>
                            <div class="detail-row" style="border:none;"><strong>Payment:</strong> <span class="text-warning fw-bold">Pay at Desk</span></div>
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
                            <button type="submit" class="btn btn-success w-100 fw-bold text-uppercase" style="height: 52px; background: #16a34a; border-radius: 10px;">Place Order</button>
                        </div>
                        <div class="col-12">
                            <a href="Roombooking.php" class="btn btn-outline-secondary w-100 fw-bold text-uppercase d-flex align-items-center justify-content-center" style="height: 52px; border-radius: 10px; text-decoration: none;">← Modify Items</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>