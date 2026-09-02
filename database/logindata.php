<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "registerdatabase", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['user_email'] = $email;
    echo "LOGIN SUCCESSFUL ...";
} else {
    echo "INVALID EMAIL OR PASSWORD!";
}

mysqli_close($conn);
?>
