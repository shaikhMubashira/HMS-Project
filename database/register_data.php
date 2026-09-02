<?php
$conn = mysqli_connect("localhost", "root", "", "registerdatabase", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$first_name = $_POST['first_name'] ?? '';
$last_name  = $_POST['last_name'] ?? '';
$email      = $_POST['email'] ?? '';
$mobile     = $_POST['mobile'] ?? '';
$password   = $_POST['password'] ?? '';

// Check if critical inputs are completely empty spaces
if (empty($first_name) || empty($email) || empty($password)) {
    die("ERROR: Please fill out the registration form first!");
}

$sql = "INSERT INTO register (first_name, last_name, email, mobile, password) VALUES ('$first_name', '$last_name', '$email', '$mobile', '$password')";

if (mysqli_query($conn, $sql)) {
     header("Location: ../about.php");
    exit();
} else {
    echo "ERROR: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
