<?php
$link = mysqli_connect('localhost', 'root', '', 'admin') or die('error');

if (isset($_POST['query'])) {
    $search = trim($_POST['query']);
    // Added wildcards on both sides so it searches anywhere in the room type or number
    $qry = "SELECT room_number, type, price, status, image_src FROM rooms WHERE type LIKE '%$search%' OR room_number LIKE '%$search%' ORDER BY room_number ASC";
    
    $res = mysqli_query($link, $qry);
    $output = "";

    if (mysqli_num_rows($res) > 0) {
        $current_floor = "";

        while ($row = mysqli_fetch_assoc($res)) {
            $r_num = $row['room_number'];
            $floor_no = substr($r_num, 0, 1);

            if ($current_floor != $floor_no) {
                if ($current_floor != "") {
                    $output .= "</div>";
                }
                $current_floor = $floor_no;
                $output .= '<div class="floor-heading">FLOOR ' . $current_floor . ' LEVEL</div>';
                $output .= '<div class="row g-3 mb-4">';
            }

            $r_type = $row['type'];
            $r_price = $row['price'];
            $status = $row['status'];
            $img_src = !empty($row['image_src']) ? $row['image_src'] : 'image/room3.png';

            $isAvailable = ($status == 'Available') ? '' : 'disabled';
            $cardStyle = ($status != 'Available') ? 'opacity: 0.5; background-color: #f8f9fa;' : '';
            $unavailableText = ($status != 'Available') ? ' <span style="color:red; font-size:11px;">[Unavailable]</span>' : '';

            $output .= '
            <div class="col-lg-6">
                <div class="room-strip-card" style="' . $cardStyle . '">
                    <div class="row align-items-center g-3">
                        <div class="col-4">
                            <img src="' . htmlspecialchars($img_src) . '" alt="Room Image" class="room-img-box">
                        </div>
                        <div class="col-6">
                            <span class="room-badge bg-suite">Room ' . $r_num . '</span>
                            <h5 class="fw-bold my-1" style="font-size: 15px; color:#0a182f;">
                                ' . htmlspecialchars($r_type) . '   ' . $unavailableText . '
                            </h5>
                            <span class="price-text">₹' . number_format($r_price) . '<small style="font-size:11px; color:#777;">/night</small></span>
                        </div>
                        <div class="col-2 text-center border-start">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" name="rooms[]"
                                    value="' . $r_num . '" ' . $isAvailable . '>
                            </div>
                            <label class="small text-muted d-block mt-1">Book</label>
                        </div>
                    </div>
                </div>
            </div>';
        }
        if ($current_floor != "") {
            $output .= "</div>";
        }
    } else {
        $output = '<p class="text-center text-white-50 my-3">No rooms found matching your search.</p>';
    }

    echo $output;
}
mysqli_close($link);
?>