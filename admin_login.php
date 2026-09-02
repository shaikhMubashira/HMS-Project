<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOTEL ADMIN LOGIN PAGE</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="./css/loginout.css">

</head>

<body
    style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div class="container py-2">
        <div class="row justify-content-start ms-md-5">
            <div class="col-sm-11 col-md-8 col-lg-5">

                <div class="rounded-4 shadow-lg p-4 glass-card">
                    <div class="row align-items-center">
                        <div class="col">

                            <h1 class="text-center">ADMIN PANEL</h1>
                            <p class="text-center subtitle">SECURE MANAGEMENT ACCESS</p>

                            <form method="POST">

                                <div class="form-floating mb-3">
                                    <input type="text" id="UserName" name="uname" class="form-control"
                                        placeholder="UserName" autocomplete="off">
                                    <label for="UserName">User Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="password" id="password" name="pwd" class="form-control"
                                        placeholder="Password">
                                    <label for="password">PASSWORD</label>
                                </div>

                                <button type="submit" name="LogIn" class="btn w-100 mt-2 custom-login-btn">Log In
                                    Now</button>

                                <div class="text-center mt-3">
                                    <a href="#" style="color: #d4af37; text-decoration: none; font-size: 14px;">Forgot
                                        password?</a>
                                </div>

                            </form>
                            <p align="center">
                                <?php
                                session_start();

                                $con = mysqli_connect("localhost", "root", "", "admin");

                                if (!$con) {
                                    die("Connection failed: " . mysqli_connect_errno());
                                }

                                $errmsg = "";

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['LogIn'])) {
                                    $user = $_POST['uname'] ?? '';
                                    $pass = $_POST['pwd'] ?? '';

                                    echo "<font color=red>";

                                    if (empty($_POST['uname'])) {
                                        $errmsg .= "<br>Please enter user name. <hr>";
                                    }
                                    if ($_POST['pwd'] == "") {
                                        $errmsg .= "<br>Please enter Password...<hr>";
                                    }
                                    if (!empty($errmsg)) {
                                        echo $errmsg;
                                    } else {
                                        $sql = "SELECT * FROM adminlogin WHERE Username = '$user' AND Password = '$pass'";
                                        $res = mysqli_query($con, $sql);

                                        if (mysqli_num_rows($res) > 0) {
                                            $_SESSION['Username'] = $user;
                                            header("Location: about.php");
                                            exit;
                                        } else {
                                            echo "Admin Credential is Incorrect!";
                                        }
                                    }
                                    echo "</font>";
                                }
                                ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>