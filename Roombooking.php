<?php
session_start();
$session_username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest Traveler";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_rooms = $_POST['rooms'] ?? [];
    
    $pricing = [
        'Room 305' => 5500, 'Room 306' => 5500,
        'Room 401' => 2500, 'Room 402' => 2500,
        'Room 403' => 1800, 'Room 404' => 1800,
        'Room 405' => 4000, 'Room 406' => 4000,
        'Room 501' => 5500, 'Room 502' => 5500, 'Room 503' => 5500,
        'Room 504' => 5500, 'Room 505' => 2500, 'Room 506' => 2500
    ];

    $total_bill = 0;
    echo "<div style='font-family: Arial, sans-serif; padding: 30px; background: #0a182f; color: #fff; max-width: 600px; margin: 40px auto; border-radius: 10px;'>";
    echo "<h2 style='color: #d4af37;'>Final Bill Summary</h2>";
    echo "<ul style='line-height: 1.8;'>";

    if (empty($selected_rooms)) {
        echo "<li>No rooms selected. Please go back and select at least one room.</li>";
    } else {
        foreach ($selected_rooms as $room_str) {
            preg_match('/Room (\d+)/', $room_str, $matches);
            $room_num = $matches[1] ?? '';
            $qty = intval($_POST["qty_$room_num"] ?? 1);
            $rate = $pricing["Room $room_num"] ?? 0;
            $subtotal = $rate * $qty;
            $total_bill += $subtotal;

            echo "<li>{$room_str} - Quantity: {$qty} @ ₹{$rate}/night = <strong>₹{$subtotal}</strong></li>";
        }
    }

    echo "</ul>";
    echo "<h3 style='color: #d4af37; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 10px;'>Total Amount Due: ₹{$total_bill}</h3>";
    echo "<p><em>Payment Policy: Pay on arrival at the front desk.</em></p>";
    echo "<br><a href='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' style='color: #d4af37; text-decoration: underline;'>← Back to Booking</a>";
    echo "</div>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST INN - Select Your Room Floor Layout</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(rgba(10, 24, 47, 0.7), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: #fff;
            padding-bottom: 100px;
        }
        .floor-heading {
            color: #d4af37;
            font-weight: bold;
            border-bottom: 2px dashed rgba(212, 175, 55, 0.3);
            padding-bottom: 8px;
            margin-top: 30px;
            text-transform: uppercase;
            font-size: 20px;
            letter-spacing: 1px;
        }
        .room-strip-card {
            background: #ffffff;
            border-radius: 12px;
            color: #2b2b2b;
            padding: 15px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.2);
            margin-bottom: 15px;
            transition: transform 0.2s;
        }
        .room-strip-card:hover {
            transform: scale(1.02);
        }
        .room-img-box {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: 8px;
        }
        .price-text {
            color: #24b6e6;
            font-weight: 800;
            font-size: 18px;
        }
        .room-badge {
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .bg-economy { background-color: #e2e8f0; color: #4a5568; }
        .bg-single { background-color: #e0f2fe; color: #0369a1; }
        .bg-double { background-color: #dcfce7; color: #15803d; }
        .bg-suite { background-color: #fef3c7; color: #b45309; }
        .global-checkout-bar {
            background: rgba(10, 24, 47, 0.95);
            border-top: 2px solid #d4af37;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

    <!-- Header Navigation Section -->
    <div class="container py-3">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Left Side: Text Branding Logo Link -->
            <a href="index.php" style="font-weight: bold; color: #fff; font-size: 24px; text-decoration: none; letter-spacing: 1px;">REST INN</a>
            
            <!-- Right Side: User Greeting & Back to Home Action Button -->
            <div class="d-flex align-items-center">
                <span class="text-white-50 me-3 d-none d-sm-inline">Welcome, <strong><?php echo htmlspecialchars($session_username); ?></strong></span>
                <a href="index.php" class="btn btn-sm btn-outline-light px-3 fw-bold" style="border-radius: 20px; font-size: 13px; letter-spacing: 0.5px;">Back to Home</a>
            </div>
        </div>
    </div>


    <!-- MAIN HOTEL CONTAINER BUILD -->
    <div class="container my-3">
        <div class="text-center mb-4">
            <h1 style="color: #d4af37; font-weight: 800;">Hotel Room Map Layout</h1>
            <p class="text-white-50 small">Browse available accommodations arranged by their real physical floors</p>
        </div>

        <!-- GLOBAL DUAL CALENDAR DATE SELECTION FORM -->
        <form method="POST" action="roombookingconfirm.php">
            
            <div class="row g-3 justify-content-center mb-4">
                <div class="col-md-4 col-sm-6">
                    <div class="p-3 rounded-3 text-center" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);">
                        <label class="small fw-bold text-white-50 mb-1 d-block">CHECK-IN ARRIVAL</label>
                        <input type="date" name="check_in" class="form-control text-center" required>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="p-3 rounded-3 text-center" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);">
                        <label class="small fw-bold text-white-50 mb-1 d-block">CHECK-OUT DEPARTURE</label>
                        <input type="date" name="check_out" class="form-control text-center" required>
                    </div>
                </div>
            </div>

                              <!-- ================= FLOOR 1: ECONOMY HUB ================= -->
            <div class="floor-heading">🏢 Floor 1 - Standard Economy Level</div>
            <div class="row mt-3">
                
                <!-- Room 101: Economy Double -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room4.png" alt="Economy Double" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-economy">Room 101</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Economy Double</h5>
                                <span class="price-text">₹1,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <!-- Added Qty Box Field -->
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_101" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Economy Double Room [Room 101]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 102: Economy Double -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room4.png" alt="Economy Double" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-economy">Room 102</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Economy Double</h5>
                                <span class="price-text">₹1,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_102" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Economy Double Room [Room 102]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 103: Economy Double -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room4.png" alt="Economy Double" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-economy">Room 103</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Economy Double</h5>
                                <span class="price-text">₹1,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_103" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Economy Double Room [Room 103]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 104: Single Economy -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room4.png" alt="Single Economy" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-economy">Room 104</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Economy</h5>
                                <span class="price-text">₹1,000<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_104" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Economy Room [Room 104]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 105: Single Economy -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room4.png" alt="Single Economy" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-economy">Room 105</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Economy</h5>
                                <span class="price-text">₹1,000<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_105" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Economy Room [Room 105]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 106: Single Economy -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room4.png" alt="Single Economy" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-economy">Room 106</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Economy</h5>
                                <span class="price-text">₹1,000<small style="font-size:11px; color:#777;">/night</small></span>
                                                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_106" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Economy Room [Room 106]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
  
            </div> <!-- Closes the row container for Floor 1 -->

            <!-- ================= FLOOR 2: SINGLE DELUXE LEVEL ================= -->
            <div class="floor-heading">🏢 Floor 2 - Premium Suites & Family Level</div>
            
            <!-- SUB-SECTION: SINGLE DELUXE ROOMS (201 & 202) -->
            <div class="text-white-50 small mt-2 mb-2">▶ Single Deluxe Rooms (₹1,800/night)</div>
            <div class="row">
                <!-- Room 201 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room2.png" alt="Single Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-single">Room 201</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Deluxe</h5>
                                <span class="price-text">₹1,800<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_201" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Deluxe Room [Room 201]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 202 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room2.png" alt="Single Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-single">Room 202</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Deluxe</h5>
                                <span class="price-text">₹1,800<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_202" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Deluxe Room [Room 202]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION: DOUBLE DELUXE ROOMS (203 & 204) -->
            <div class="text-white-50 small mt-3 mb-2">▶ Double Deluxe Rooms (₹2,500/night)</div>
            <div class="row">
                <!-- Room 203 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 203</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_203" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 203]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 204 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 204</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_204" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 204]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION: LUXURY FAMILY SUITES (205 & 206) -->
            <div class="text-white-50 small mt-3 mb-2">▶ Luxury Family Suites (₹4,000/night)</div>
            <div class="row">
                <!-- Room 205 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Luxury Family Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 205</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Family Suite</h5>
                                <span class="price-text">₹4,000<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_205" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Luxury Family Suite [Room 205]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 206 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Luxury Family Suite" class="room-img-box">
                            </div>
                                                        <div class="col-5">
                                <span class="room-badge bg-suite">Room 206</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Family Suite</h5>
                                <span class="price-text">₹4,000<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_206" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Luxury Family Suite [Room 206]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Closes the row container for Floor 2 -->

                        <!-- ================= FLOOR 3: DOUBLE DELUXE COMFORT LEVEL ================= -->
            <div class="floor-heading">🏢 Floor 3 - Executive Double Comfort Level</div>
            
            <!-- SUB-SECTION: DOUBLE DELUXE ROOMS (301 & 302) -->
            <div class="text-white-50 small mt-2 mb-2">▶ Double Deluxe Rooms (₹2,500/night)</div>
            <div class="row">
                <!-- Room 301 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe Room" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 301</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_301" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 301]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 302 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe Room" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 302</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_302" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 302]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION: SINGLE DELUXE ROOMS (303 & 304) -->
            <div class="text-white-50 small mt-3 mb-2">▶ Single Deluxe Rooms (₹1,800/night)</div>
            <div class="row">
                <!-- Room 303 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room2.png" alt="Single Deluxe Room" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-single">Room 303</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Deluxe</h5>
                                <span class="price-text">₹1,800<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_303" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Deluxe Room [Room 303]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 304 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room2.png" alt="Single Deluxe Room" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-single">Room 304</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Deluxe</h5>
                                <span class="price-text">₹1,800<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_304" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Deluxe Room [Room 304]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION: EXECUTIVE SUITES (305 & 306) -->
            <div class="text-white-50 small mt-3 mb-2">▶ Executive Suites (₹5,500/night)</div>
            <div class="row">
                <!-- Room 305 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Executive Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 305</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Executive Suite</h5>
                                <span class="price-text">₹5,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_305" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Executive Suite [Room 305]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 306 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Executive Suite" class="room-img-box">
                                                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 306</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Executive Suite</h5>
                                <span class="price-text">₹5,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_306" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Executive Suite [Room 306]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Closes the row container for Floor 3 -->

                        <!-- ================= FLOOR 4: MIXED PREMIUM ACCOMMODATIONS ================= -->
            <div class="floor-heading">🏢 Floor 4 - Mixed Premium Accommodations</div>
            
            <!-- SUB-SECTION: DOUBLE DELUXE ROOMS (401 & 402) -->
            <div class="text-white-50 small mt-2 mb-2">▶ Double Deluxe Rooms (₹2,500/night)</div>
            <div class="row">
                <!-- Room 401 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 401</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_401" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 401]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 402 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 402</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_402" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 402]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION: SINGLE DELUXE ROOMS (403 & 404) -->
            <div class="text-white-50 small mt-3 mb-2">▶ Single Deluxe Rooms (₹1,800/night)</div>
            <div class="row">
                <!-- Room 403 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room2.png" alt="Single Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-single">Room 403</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Deluxe</h5>
                                <span class="price-text">₹1,800<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_403" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Deluxe Room [Room 403]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 404 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room2.png" alt="Single Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-single">Room 404</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Single Deluxe</h5>
                                <span class="price-text">₹1,800<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_404" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Single Deluxe Room [Room 404]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION: LUXURY FAMILY SUITES (405 & 406) -->
            <div class="text-white-50 small mt-3 mb-2">▶ Luxury Family Suites (₹4,000/night)</div>
            <div class="row">
                <!-- Room 405 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Luxury Family Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 405</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Family Suite</h5>
                                <span class="price-text">₹4,000<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_405" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Luxury Family Suite [Room 405]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Room 406 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Luxury Family Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 406</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Family Suite</h5>
                                <span class="price-text">₹4,000<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_406" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Luxury Family Suite [Room 406]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Closes the row container for Floor 4 -->

                        <!-- ================= FLOOR 5: PENTHOUSE LUXURY SUITES ================= -->
            <div class="floor-heading">🏢 Floor 5 - Penthouse Executive Suites Level</div>
            
            <!-- SUB-SECTION: PENTHOUSE EXECUTIVE SUITES (501 to 504) -->
            <div class="text-white-50 small mt-2 mb-2">▶ Executive Penthouse Suites (₹5,500/night)</div>
            <div class="row">
                <!-- Room 501 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Executive Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 501</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Executive Suite</h5>
                                <span class="price-text">₹5,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_501" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Executive Suite [Room 501]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 502 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Executive Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 502</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Executive Suite</h5>
                                <span class="price-text">₹5,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_502" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Executive Suite [Room 502]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 503 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Executive Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 503</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Executive Suite</h5>
                                <span class="price-text">₹5,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_503" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Executive Suite [Room 503]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 504 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room3.png" alt="Executive Suite" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-suite">Room 504</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Executive Suite</h5>
                                <span class="price-text">₹5,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_504" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Executive Suite [Room 504]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION: PENTHOUSE DOUBLE DELUXE ROOMS (505 & 506) -->
            <div class="text-white-50 small mt-3 mb-2">▶ Double Deluxe Penthouse Rooms (₹2,500/night)</div>
            <div class="row">
                <!-- Room 505 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 505</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_505" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 505]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room 506 -->
                <div class="col-lg-6">
                    <div class="room-strip-card">
                        <div class="row align-items-center g-3">
                            <div class="col-4">
                                <img src="image/room1.png" alt="Double Deluxe" class="room-img-box">
                            </div>
                            <div class="col-5">
                                <span class="room-badge bg-double">Room 506</span>
                                <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">Double Deluxe</h5>
                                <span class="price-text">₹2,500<small style="font-size:11px; color:#777;">/night</small></span>
                                <div class="mt-2 d-flex align-items-center">
                                    <label class="small text-muted me-2 mb-0" style="font-size:11px;">Qty:</label>
                                    <input type="number" name="qty_506" class="form-control form-control-sm text-center fw-bold" value="1" min="1" max="5" style="width: 60px; height: 26px; border: 1px solid #ced4da;">
                                </div>
                            </div>
                            <div class="col-3 text-center border-start">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="rooms[]" value="Double Deluxe Room [Room 506]">
                                </div>
                                <label class="small text-muted d-block mt-1">Book</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Closes the row container for Floor 5 -->

             <!-- PAY ON ARRIVAL STYLISH DESIGN NOTE -->
                <div class="mb-4 p-3 rounded-3 text-center" style="background: rgba(255, 255, 255, 0.05); border: 1px dashed rgba(212, 175, 55, 0.4);">
                    <h6 class="m-0" style="color: #d4af37; font-weight: bold; font-size: 14px; letter-spacing: 0.5px;">
                        📌 Reservation Policy: Pay on Arrival at Front Desk
                    </h6>
                    <small class="text-white-50" style="font-size: 11px;">No online payment required. Pay when you check in to receive your room keys.</small>
                </div>

            <!-- ================= THE GLOBAL STICKY CHECKOUT FOOTER BAR ================= -->
            <div class="fixed-bottom global-checkout-bar py-3 text-center">
                <div class="container d-flex justify-content-between align-items-center">
                    <span class="small text-white-50 d-none d-sm-inline">Check any rooms on any floor and click right to confirm</span>
                    <button type="submit" class="btn btn-warning px-5 py-2 fw-bold text-uppercase border-0 shadow" style="background:#d4af37; color:#0a182f; border-radius:30px; font-size:14px;">Generate Final Bill</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
