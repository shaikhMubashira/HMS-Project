<?php
include 'db.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'overview';

// Fetching quick stats for overview
$total_bookings = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'] ?? 0;
$active_guests = $conn->query("SELECT COUNT(*) as count FROM guests WHERE status='checked-in'")->fetch_assoc()['count'] ?? 0;
$total_rooms = $conn->query("SELECT COUNT(*) as count FROM rooms")->fetch_assoc()['count'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar text-white p-3 vh-100">
                <h2>Hotel Admin</h2>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item mb-2"><a href="dashboard.php?page=overview" class="nav-link text-white">Dashboard</a></li>
                    <li class="nav-item mb-2"><a href="dashboard.php?page=rooms" class="nav-link text-white">Manage Rooms</a></li>
                    <li class="nav-item mb-2"><a href="dashboard.php?page=bookings" class="nav-link text-white">Bookings</a></li>
                    <li class="nav-item mb-2"><a href="dashboard.php?page=guests" class="nav-link text-white">Guests</a></li>
                </ul>
            </nav>

            <!-- Main Dynamic Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <?php
                if ($page == 'overview') {
                    echo "<h2>Dashboard Overview</h2>";
                    echo '<div class="row mt-4">
                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Bookings</h5>
                                        <p class="card-text fs-4">' . $total_bookings . '</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Active Guests</h5>
                                        <p class="card-text fs-4">' . $active_guests . '</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-warning mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Rooms</h5>
                                        <p class="card-text fs-4">' . $total_rooms . '</p>
                                    </div>
                                </div>
                            </div>
                          </div>';
                } elseif ($page == 'rooms') {
                    include 'rooms_content.php';
                } elseif ($page == 'bookings') {
                    include 'bookings_content.php';
                } elseif ($page == 'guests') {
                    include 'guests_content.php';
                }
                ?>
            </main>
        </div>
    </div>
</body>
</html>