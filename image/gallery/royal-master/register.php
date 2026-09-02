    <?php
$conn = mysqli_connect("localhost", "root", "", "client");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$errMsg = "";
if (isset($_POST['register'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $uname = $_POST['uname'] ?? '';
    $mobile = $_POST['mno'] ?? '';
    $password = $_POST['password'] ?? '';
    $cpassword = $_POST['cpassword'] ?? '';
    if (empty($name) || empty($email) || empty($password) || empty($cpassword)) {
        $errMsg .= "<li>Please fill the form first.</li>";
    }
    if (empty($_POST['name']))
        $errMsg .= "<li>You forgot to enter first name.</li>";
    if (empty($_POST['email']))
        $errMsg .= "<li>Please enter email id.</li>";
    if (empty($_POST['mno']))
        $errMsg .= "<li>Please enter mobile number.</li>";
    if (empty($_POST['uname']))
        $errMsg .= "<li>Please enter username.</li>";
    if (empty($_POST['password']))
        $errMsg .= "<li>Please enter password.</li>";
    if (empty($_POST['cpassword']))
        $errMsg .= "<li>Please enter confirm password.</li>";
    if (strlen($password) < 8) {
        $errMsg .= "<li>Password must be at least 8 characters long.</li>";
    }
    elseif (!preg_match('/[^A-Za-z0-9]/', $password)) {
        $errMsg .= "<li>Password must contain at least one special character.</li>";
    } 
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errMsg .= "<li>Invalid email format.</li>";
    }
    if ($password !== $cpassword) {
        $errMsg .= "<li>Password and Confirm Password didn't match.</li>";
    }
    if (empty($errMsg)) {

        $sql = "INSERT INTO registerr (cname,  email ,username , mobile, password) VALUES ('$name', '$email', '$uname', '$mobile', '$password')";

        if (mysqli_query($conn, $sql)) {
            header("Location: about.php");
            exit();
        } else {
            echo "ERROR: " . mysqli_error($conn);
        }
    }
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOTEL REGISTER PAGE</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="./css/loginout.css">
</head>

<body
    style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="container py-2">
        <!-- Changed back to justify-content-start to anchor it to the left side -->
        <div class="row justify-content-start p-1 w-100">
            <!-- Increased width tracking: col-md-9 to col-md-11, col-lg-7 to col-lg-9, col-xl-6 to col-xl-8 -->
            <div class="col-12 col-sm-11 col-md-11 col-lg-9 col-xl-8">

                <div class="rounded-4 shadow-lg p-4 glass-card">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="text-center mb-1">SIGN UP</h1>
                            <p class="text-center subtitle mb-3">CREATE YOUR RESERVATION ACCOUNT.</p>

                            <form method="POST">

                                <!-- Row 1: Name and Email side by side -->
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Name" autocomplete="off">
                                            <label for="name">NAME</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Email ID" autocomplete="off">
                                            <label for="email">EMAIL ID</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Username and Mobile Number side by side -->
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" id="uname" name="uname" class="form-control"
                                                placeholder="" autocomplete="off">
                                            <label for="uname">USERNAME</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" id="tel" name="mno" class="form-control"
                                                placeholder="Mobile no." maxlength="10" pattern="[0-9]{10}"
                                                autocomplete="off">
                                            <label for="tel">MOBILE NUMBER</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Password and Confirm Password side by side -->
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Password">
                                            <label for="password">PASSWORD</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="password" id="cpassword" name="cpassword" class="form-control"
                                                placeholder="Confirm Password">
                                            <label for="cpassword">CONFIRM PASSWORD</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 4: Custom Security Question and Answer side by side -->
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" id="security_question" name="security_question" class="form-control"
                                                placeholder="Write your own security question" autocomplete="off" required>
                                            <label for="security_question">YOUR SECURITY QUESTION</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" id="security_answer" name="security_answer" class="form-control"
                                                placeholder="Your Answer" autocomplete="off" required>
                                            <label for="security_answer">SECURITY ANSWER</label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="register" class="btn w-100 custom-login-btn py-2">Sign Up</button>
                            </form>

                            <div style="margin-top: 12px; text-align: center;">
                                <p style="color: rgba(255, 255, 255, 0.6); font-size: 14px; margin-bottom: 0;">Already
                                    have an Account? <a href="login.php"
                                        style="color: #d4af37; font-weight: bold; text-decoration: none;">Log In</a></p>
                            </div>
                            
                            <?php if (!empty($errMsg)): ?>
                                <p class="text-center mb-0 mt-2" style="color: red; font-size: 14px;">
                                    <?php echo $errMsg; ?>
                                </p>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
