<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

$msg = "";
$email = $_SESSION['reset_email'] ?? $_GET['email'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';
    $email = $_POST['email'] ?? $email;

    if (empty($password) || empty($cpassword)) {
        $msg = "<div class='alert alert-danger text-center'>All fields are required!</div>";
    } elseif (strlen($password) < 6) {
        $msg = "<div class='alert alert-danger text-center'>Password must be at least 6 characters long!</div>";
    } elseif ($password !== $cpassword) {
        $msg = "<div class='alert alert-danger text-center'>Passwords do not match!</div>";
    } else {
        if (empty($email)) {
            $msg = "<div class='alert alert-danger text-center'>Email session expired! Please go back and enter your email again.</div>";
        } else {
            $sql = "UPDATE registerr SET password='$password' WHERE email='$email'";
            if (mysqli_query($con, $sql)) {
                if (mysqli_affected_rows($con) > 0) {
                    header("Location: login.php");
                    exit();
                } else {
                    $msg = "<div class='alert alert-danger text-center'>Email database mein match nahi hui!</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger text-center'>Error: " . mysqli_error($con) . "</div>";
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
    <title>CHANGE PASSWORD PAGE</title>
    <link rel="stylesheet" href="css/bootstrap.min.css?v=2">
    <link rel="stylesheet" href="css/forgotpassword.css?v=2">
    <script src="css/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#showPasswordCheckbox').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#password, #cpassword').attr('type', 'text');
                } else {
                    $('#password, #cpassword').attr('type', 'password');
                }
            });
        });
    </script>
</head>

<body
    style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div class="container">
        <div class="row justify-content-start">
            <div class="col-12 col-md-7">
                <div class="rounded-4 shadow-lg p-4 glass-card">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="text-center">CHANGE PASSWORD</h1>
                            <p class="text-center subtitle">SET Your New Password</p>

                            <?php echo $msg; ?>

                            <form action="" method="POST">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

                                <div class="form-floating mb-3">
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Password" required>
                                    <label class="text-white-50" for="password">NEW PASSWORD</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" id="cpassword" name="cpassword" class="form-control"
                                        placeholder="Confirm Password" required>
                                    <label class="text-white-50" for="cpassword">CONFIRM PASSWORD</label>
                                </div>

                                <div class="form-check mb-3 mt-2 text-start">
                                    <input class="form-check-input" type="checkbox" id="showPasswordCheckbox">
                                    <label class="form-check-label text-white-50" style="cursor: pointer;"
                                        for="showPasswordCheckbox">
                                        Show Passwords
                                    </label>
                                </div>

                                <button type="submit" class="btn w-100 mt-2 custom-login-btn">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>