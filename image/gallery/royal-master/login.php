<?php
// Session must be at the very top line
session_start();

$con = mysqli_connect("localhost", "root", "", "client");

if (!$con) {
    die("connection failed:" . mysqli_connect_errno());
}
$userror = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['uname'] ?? '';
    $pass = $_POST['pwd'] ?? '';
    if (isset($_POST['LogIn'])) {
        $errmsg = "";
        if (empty($_POST['uname'])) {
            $errmsg = "<br>Please enter user name. <hr>";
        }
        if ($_POST['pwd'] == "") {
            $errmsg .= "<br>Please enter Password...<hr>";
        }
        if (!empty($errmsg)) {
            // Handled inside the body below
        } else {
            $sql = "SELECT * FROM registerr WHERE username = '$user' AND password = '$pass'";
            $res = mysqli_query($con, $sql);
            if (isset($pass) && !empty($pass)) {
                if (mysqli_num_rows($res) > 0) {
                    // Set session variables so other pages know who logged in
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['username'] = $user;
                    
                    // Keeps your exact original redirect
                    header("Location: about.php");
                    exit;
                } else {
                    $userror = "Your Credential is Incorrect!";
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
    <title>HOTEL LOGIN PAGE</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="./css/loginout.css">
</head>

<body style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div class="container py-2">
        <div class="row justify-content-start">
            <div class="col-11 col-sm-10 col-md-8 col-lg-5">

                <div class="rounded-4 shadow-lg p-4 glass-card">
                    <div class="row align-items-center">
                        <div class="col">

                            <h1 class="text-center">LOG IN</h1>
                            <p class="text-center subtitle">WELCOME BACK! PLEASE LOG IN</p>

                            <!-- Simple Student-Level Error Display Block -->
                            <?php if (!empty($errmsg) || !empty($userror)): ?>
                                <div style="color: red; text-align: center; font-size: 14px; margin-bottom: 15px;">
                                    <?php echo $errmsg . $userror; ?>
                                </div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="form-floating mb-3">
                                    <input type="text" id="uname" name="uname" class="form-control" placeholder="User Name" autocomplete="off" value="<?php echo isset($user) ? htmlspecialchars($user) : ''; ?>">
                                    <label for="uname">USER NAME</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" id="password" name="pwd" class="form-control" placeholder="Password">
                                    <label for="password">PASSWORD</label>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember" style="color: rgba(255, 255, 255, 0.7); font-size: 14px;">Remember me</label>
                                    </div>
                                    <a href="#" style="color: #d4af37; text-decoration: none; font-size: 14px;">Forgot password?</a>
                                </div>

                                <button type="submit" name="LogIn" class="btn w-100 mt-2 custom-login-btn">Log In</button>
                            </form>

                            <div style="margin-top: 20px; text-align: center;">
                                <p style="color: rgba(255, 255, 255, 0.6); font-size: 14px; margin-bottom: 0;">Don't have an Account? <a href="register.php" style="color: #d4af37; font-weight: bold; text-decoration: none;">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
