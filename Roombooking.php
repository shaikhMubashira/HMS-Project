<?php
session_start();
$session_username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest Traveler";
?>
<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            var query = $(this).val();

            // Agar search box khali hai toh default PHP loop wala layout dikhao, warna AJAX result
            if (query.trim() !== "") {
                $.ajax({
                    url: 'fetch.php',
                    method: 'POST',
                    data: { query: query },
                    success: function (data) {
                        $('.default-room-layout').hide();
                        $('#result').html(data);
                    }
                });
            } else {
                $('#result').html('');
                $('.default-room-layout').show();
            }
        });
    });
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTF INN - Select Your Room Floor Layout</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(rgba(10, 24, 47, 0.75), rgba(10, 24, 47, 0.85)), url('./image/login/hotel-bg.png') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            color: #fff;
            padding-bottom: 100px;
        }

        /* 1. This makes the text you type inside the search bar clear white */
        #search {
            color: #ffffff ;
        }

        /* 2. This makes the placeholder text ("Search by room type...") a highly visible soft light grey */
        #search::placeholder {
            color: rgba(255, 255, 255, 0.65) ;
            opacity: 1; 
        }

        /* Sleek background wrapper styling for our input interface box */
        .search-glass-container {
            background: rgba(236, 226, 226, 0.08); 
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 50px;
            padding: 8px 16px;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .search-glass-container:focus-within {
            border-color: #d4af37;
            box-shadow: 0 8px 32px rgba(212, 175, 55, 0.25);
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
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
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

        .bg-suite {
            background-color: #fef3c7;
            color: #b45309;
        }

        .global-checkout-bar {
            background: rgba(10, 24, 47, 0.95);
            border-top: 2px solid #d4af37;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <!-- Header Navigation Section -->
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <!-- 2. Branding text updated to MTF INN here -->
            <a href="index.php" style="font-weight: bold; color: #fff; font-size: 24px; text-decoration: none; letter-spacing: 1px;">MTF INN</a>
            <div class="d-flex align-items-center">
                <span class="text-white-50 me-3 d-none d-sm-inline">Welcome, <strong><?php echo htmlspecialchars($session_username); ?></strong></span>
                <a href="index.php" class="btn btn-sm btn-outline-light px-3 fw-bold" style="border-radius: 20px; font-size: 13px; letter-spacing: 0.5px;">Back to Home</a>
            </div>
        </div>

        <!-- Title Block -->
        <div class="text-center mb-4">
            <h1 style="color: #d4af37; font-weight: 800; font-size: 36px; letter-spacing: 0.5px;">Hotel Room Map Layout</h1>
            <p class="text-white-50 small" style="font-size: 15px;">Browse available accommodations arranged by their real physical floors</p>
        </div>

        <!-- 3. NEW SEARCH BAR DESIGN LAYER: Constrained inside row/col layout boundaries -->
        <div class="row justify-content-center mb-5">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="search-glass-container d-flex align-items-center">
                    <i class="fa fa-search ms-2 me-3" style="color: rgba(255, 255, 255, 0.5); font-size: 16px;"></i>
                    <input type="text" placeholder="Search by room type, floor, or status..." class="form-control" id="search" 
                           style="background: transparent; border: none; color: #fff; box-shadow: none; padding-left: 0; font-size: 15px;">
                </div>
            </div>
        </div>


    <!-- MAIN HOTEL CONTAINER BUILD -->
    <div class="container my-3">
        <form method="POST" action="roombookingconfirm.php">
            <div class="row g-3 justify-content-center mb-4">
                <div class="col-md-4 col-sm-6">
                    <div class="p-3 rounded-3 text-center"
                        style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);">
                        <label class="small fw-bold text-white-50 mb-1 d-block">CHECK-IN ARRIVAL</label>
                        <input type="date" name="check_in" class="form-control text-center" required
                            min="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="p-3 rounded-3 text-center"
                        style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);">
                        <label class="small fw-bold text-white-50 mb-1 d-block">CHECK-OUT DEPARTURE</label>
                        <input type="date" name="check_out" class="form-control text-center" required
                            min="<?= date($check_in) ?>">
                    </div>
                </div>
            </div>
            <div id="result"></div>
            <div class="default-room-layout">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "admin");
                $result = mysqli_query($conn, "SELECT * FROM rooms ORDER BY room_number ASC");

                $current_floor = "";

                while ($row = mysqli_fetch_assoc($result)) {
                    $r_num = $row['room_number'];
                    $floor_no = substr($r_num, 0, 1);

                    if ($current_floor != $floor_no) {
                        if ($current_floor != "") {
                            echo "</div>";
                        }
                        $current_floor = $floor_no;
                        echo '<div class="floor-heading">FLOOR ' . $current_floor . ' LEVEL</div>';
                        echo '<div class="row g-3 mb-4">';
                    }

                    $r_type = $row['type'];
                    $r_price = $row['price'];
                    $status = $row['status'];
                    $img_src = !empty($row['image_src']) ? $row['image_src'] : 'image/room3.png';

                    $isAvailable = ($status == 'Available') ? '' : 'disabled';
                    $cardStyle = ($status != 'Available') ? 'opacity: 0.5; background-color: #f8f9fa;' : '';
                    $unavailableText = ($status != 'Available') ? ' <span style="color:red; font-size:11px;">[Unavailable]</span>' : '';
                    ?>
                    <!-- Room Card Start -->
                    <div class="col-lg-6">
                        <div class="room-strip-card" style="<?php echo $cardStyle; ?>">
                            <div class="row align-items-center g-3">
                                <div class="col-4">
                                    <img src="<?php echo htmlspecialchars($img_src); ?>" alt="Room Image"
                                        class="room-img-box">
                                </div>
                                <div class="col-6">
                                    <span class="room-badge bg-suite">Room <?php echo $r_num; ?></span>
                                    <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">
                                        <?php echo htmlspecialchars($r_type); ?>     <?php echo $unavailableText; ?>
                                    </h5>
                                    <span class="price-text">₹<?php echo number_format($r_price); ?><small
                                            style="font-size:11px; color:#777;">/night</small></span>
                                </div>
                                <div class="col-2 text-center border-start">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" name="rooms[]"
                                            value="<?php echo $r_num; ?>" <?php echo $isAvailable; ?>>
                                    </div>
                                    <label class="small text-muted d-block mt-1">Book</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Room Card End -->
                    <?php
                }
                if ($current_floor != "") {
                    echo "</div>";
                }
                mysqli_close($conn);
                ?>
            </div>
            <!-- RESERVATION POLICY -->
            <div class="mb-4 p-3 rounded-3 text-center"
                style="background: rgba(255, 255, 255, 0.05); border: 1px dashed rgba(212, 175, 55, 0.4);">
                <h6 class="m-0" style="color: #d4af37; font-weight: bold; font-size: 14px; letter-spacing: 0.5px;">
                    📌 Reservation Policy: Pay on Arrival at Front Desk
                </h6>
                <small class="text-white-50" style="font-size: 11px;">No online payment required. Pay when you check in
                    to receive your room keys.</small>
            </div>

            <!-- GLOBAL STICKY CHECKOUT FOOTER BAR -->
            <div class="fixed-bottom global-checkout-bar py-3 text-center">
                <div class="container d-flex justify-content-between align-items-center">
                    <span class="small text-white-50 d-none d-sm-inline">Check any rooms on any floor and click right to
                        confirm</span>
                    <button type="submit" class="btn btn-warning px-5 py-2 fw-bold text-uppercase border-0 shadow"
                        style="background:#d4af37; color:#0a182f; border-radius:30px; font-size:14px;">Generate Final
                        Bill</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
