<?php
session_start();

// 1. CHECK IF USER IS LOGGED IN
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// 2. CONNECT TO DATABASE
$con = mysqli_connect("localhost", "root", "", "client");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$session_username = $_SESSION['username'];
$msg = "";

// 3. IF THE FORM IS SUBMITTED, PROCESS TEXT FIELDS, IMAGE & PASSWORD
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {

    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $cname = $first_name . ' ' . $last_name;
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';

    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['password'] ?? '';
    $confirm_password = $_POST['cpassword'] ?? '';

    $profile_pic_path = "";
    $errors = array();

    // 1. Profile Picture Upload Check
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0 && $_FILES['profile_image']['name'] != "") {
        $file_name = $_FILES['profile_image']['name'];
        $file_size = $_FILES['profile_image']['size'];
        $file_tmp = $_FILES['profile_image']['tmp_name'];

        $exploded = explode('.', $file_name);
        $file_ext = strtolower(end($exploded));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }

        if (empty($errors)) {
            if (!is_dir("images")) {
                mkdir("images", 0777, true);
            }
            move_uploaded_file($file_tmp, "images/" . $file_name);
            $profile_pic_path = "images/" . $file_name;
        }
    }

    // 2. Password Change Logic
    $password_sql_part = "";
    if (!empty($old_password) || !empty($new_password) || !empty($confirm_password)) {
        $pass_check_query = "SELECT password FROM registerr WHERE username = '$session_username'";
        $pass_res = mysqli_query($con, $pass_check_query);
        $pass_row = mysqli_fetch_assoc($pass_res);

        if ($old_password !== $pass_row['password']) {
            $errors[] = "Old password is incorrect!";
        } elseif ($new_password !== $confirm_password) {
            $errors[] = "New password and confirm password do not match!";
        } elseif (strlen($new_password) < 6) {
            $errors[] = "New password must be at least 6 characters long!";
        } else {
            $password_sql_part = ", password = '$new_password'";
        }
    }

    // 3. Database Update
    if (empty($errors)) {
        $pic_sql_part = "";
        if (!empty($profile_pic_path)) {
            $pic_sql_part = ", profile_pic = '$profile_pic_path'";
        }

        $sql = "UPDATE registerr SET cname='$cname', email='$email', mobile='$mobile' $pic_sql_part $password_sql_part WHERE username='$session_username'";

        if (mysqli_query($con, $sql)) {
            $msg = "<div class='alert alert-success text-center'>Profile and settings updated successfully!</div>";
        } else {
            $msg = "<div class='alert alert-danger text-center'>Error updating record: " . mysqli_error($con) . "</div>";
        }
    } else {
        $errmsg = implode("<br>", $errors);
        $msg = "<div class='alert alert-danger text-center'>$errmsg</div>";
    }
}

// 4. FETCH CURRENT LOGGED IN USER DATA TO DISPLAY IN FORM FIELDS
$sql = "SELECT * FROM registerr WHERE username = '$session_username'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $user = mysqli_fetch_assoc($res);
    $full_name = isset($user['cname']) ? trim($user['cname']) : "Tabassum Khan";
    $name_parts = explode(' ', $full_name, 2);

    $first_name = $name_parts[0] ?? "Tabassum";
    $last_name = $name_parts[1] ?? "Khan";
    $email = isset($user['email']) ? $user['email'] : "tabassum@example.com";
    $mobile = isset($user['mobile']) ? $user['mobile'] : "9876543210";
    $username = isset($user['username']) ? $user['username'] : "tabassum.khan";
    $profile_pic = !empty($user['profile_pic']) ? $user['profile_pic'] : "./image/login/hotel-bg.png";
} else {
    header("Location: login.php");
    exit;
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOTEL PROFILE PAGE</title>

    <link rel="stylesheet" href="css/bootstrap.min.css?v=1">
    <link rel="stylesheet" href="css/profile.css?v=1">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body
    style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div class="container-fluid py-4" style="max-width: 1200px;">
        <div class="rounded-4 shadow-lg p-4 glass-card">
            <div class="row mb-3 align-items-center">
                <div class="col-md-9">
                    <h2>ACCOUNT PROFILE</h2>
                    <p class="subtitle">Welcome back, <?php echo htmlspecialchars($first_name); ?>! Manage your account
                        details here.</p>
                </div>
                <div class="col-md-3 text-md-end">
                    <a href="index.php" class="btn btn-sm btn-outline-light">Back to Home</a>
                </div>
            </div>

            <!-- Display Status Messages Here -->
            <?php echo $msg; ?>

            <!-- FORM SUBMITS TO ITSELF (action is empty) -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row g-4">

                    <!-- ================= LEFT SIDE COLUMN ================= -->
                    <div class="col-12 col-md-4">
                        <h3 class="section-title m-0 mb-3">ACCOUNT MANAGEMENT</h3>

                        <div class="image-preview-box mb-3"
                            style="position: relative; width: 150px; height: 150px; margin: 0 auto; border-radius: 50%;">
                            <img id="profileImageDisplay" src="<?php echo htmlspecialchars($profile_pic); ?>"
                                alt="Profile Display"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        </div>

                        <div class="mb-4">
                            <input type="file" id="uploadPhoto" name="profile_image" class="form-control d-none"
                                accept="image/*" onchange="previewImage(event)">
                            <button type="button" class="btn w-100 btn-outline-light"
                                onclick="document.getElementById('uploadPhoto').click();">Upload Photo</button>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" id="old_password" name="old_password" class="form-control"
                                placeholder="Old Password">
                            <label class="text-white-50" for="old_password">OLD PASSWORD</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="New Password">
                            <label class="text-white-50" for="password">NEW PASSWORD</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="cpassword" name="cpassword" class="form-control"
                                placeholder="Confirm Password">
                            <label class="text-white-50" for="cpassword">CONFIRM PASSWORD</label>
                        </div>

                        <div class="mt-4 pt-2">
                            <button type="submit" name="update_profile" class="btn w-100 custom-login-btn py-2">Save
                                Profile Settings</button>
                        </div>
                    </div>

                    <!-- ================= RIGHT SIDE COLUMN ================= -->
                    <div class="col-12 col-md-8">
                        <h3 class="section-title m-0 mb-2">PROFILE INFORMATION</h3>
                        <div class="row g-2 mb-4">
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Username" value="<?php echo htmlspecialchars($username); ?>"
                                        readonly style="background-color: rgba(255,255,255,0.1); color: #ccc;">
                                    <label class="text-white-50" for="username">USERNAME (CANNOT CHANGE)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="Fname" name="first_name" class="form-control"
                                        placeholder="First Name" value="<?php echo htmlspecialchars($first_name); ?>"
                                        required>
                                    <label class="text-white-50" for="Fname">FIRST NAME</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="Lname" name="last_name" class="form-control"
                                        placeholder="Last Name" value="<?php echo htmlspecialchars($last_name); ?>"
                                        required>
                                    <label class="text-white-50" for="Lname">LAST NAME</label>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info Section -->
                        <h3 class="section-title mt-6">CONTACT INFO</h3>
                        <div class="row g-2 mt-1 mb-4">
                            <!-- Email ID -->
                            <div class="col-12 mb-1 mt-3">
                                <div class="form-floating mb-2">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Email ID" value="<?php echo htmlspecialchars($email); ?>" required>
                                    <label class="text-white-50" for="email">EMAIL ID (REQUIRED)</label>
                                </div>
                            </div>

                            <!-- Mobile Number -->
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="mobile" name="mobile" class="form-control"
                                        placeholder="Mobile Number" value="<?php echo htmlspecialchars($mobile); ?>">
                                    <label class="text-white-50" for="mobile">MOBILE NUMBER</label>
                                </div>
                            </div>
                        </div>

                        <!-- Global Submit Button for Profile Data -->
                        <div class="mt-4 pt-2">
                            <button type="submit" name="update_profile" class="btn w-100 custom-login-btn py-2">Update
                                Profile Info</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        var fallbackImage = "<?php echo htmlspecialchars($profile_pic); ?>";

        // 1. Photo select hone par live preview dikhane ke liye
        function previewImage(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profileImageDisplay').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>