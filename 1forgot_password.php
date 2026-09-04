<?php
// Session must be at the very top line
session_start();

$con = mysqli_connect("localhost", "root", "", "client");

if (!$con) {
    die("connection failed:" . mysqli_connect_errno());
}
$userror = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    if (isset($_POST['send_otp'])) {
        $errmsg = "";
        if (empty($_POST['email'])) {
            $errmsg = "<br>Please enter email. <hr>";
        }
        if (!empty($errmsg)) {
            // Handled inside the body below
        } else {
            $sql = "SELECT * FROM registerr WHERE email='$email'";
            $res = mysqli_query($con, $sql);
            if (!empty($email)) {
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res); // Yahan row fetch karni zaroori hai!
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['reset_email'] = $email; // Email bhi session mein daal di

                    header("Location: 2forgot_password_otp.php");
                    exit;
                } else {
                    $userror = "Your email is Incorrect!";
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORGOT PASSWORD PAGE</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forgotpassword.css">
    <script src="css/jquery-3.7.1.min.js"></script>
</head>

<body
    style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div class="container">
        <div class="row justify-content-start">
            <div class="col-12 col-md-7">

                <div class="rounded-4 shadow-lg p-4 glass-card">
                    <div class="row align-items-center">
                        <div class="col">

                            <h1 class="text-center">FORGOT PASSWORD</h1>
                            <p class="text-center subtitle">To Change your Password we have to check some info.</p>

                            <!-- Action links directly to the second page -->
                            <form id="emailForm" action="" method="POST">

                                <!-- Email ID Field -->
                                <div class="form-floating mb-3">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Email ID" required autocomplete="off">
                                    <label class="text-white-50" for="email">EMAIL ID</label>
                                </div>
                                <?php
                                if (!empty($userror)) {
                                    echo "<div class='text-danger mb-3 text-center fw-bold'>$userror</div>";
                                }
                                ?>
                                <!-- Button submits directly to File 2 -->
                                <button type="submit" name="send_otp" class="btn w-100 mt-2 custom-login-btn">SEND
                                    OTP</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>