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
$msg = ""; // To hold success or error messages

// =========================================================================
// 3. IF THE FORM IS SUBMITTED, PROCESS TEXT FIELDS AND PROCESS IMAGE
// =========================================================================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    
    $first_name = $_POST['first_name'] ?? '';
    $last_name  = $_POST['last_name'] ?? '';
    $email      = $_POST['email'] ?? '';
    $mobile     = $_POST['mobile'] ?? '';
    $whatsapp   = $_POST['whatsapp'] ?? '';

    $profile_pic_path = ""; // Variable to hold path if image uploads successfully

    // ---------------- START OF PROFESSOR'S METHOD ----------------
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $errors = array();
        
        $file_name = $_FILES['profile_image']['name'];
        $file_size = $_FILES['profile_image']['size'];
        $file_tmp  = $_FILES['profile_image']['tmp_name'];
        $file_type = $_FILES['profile_image']['type'];
        
        // Extracting file extension
        $exploded = explode('.', $_FILES['profile_image']['name']);
        $file_ext = strtolower(end($exploded));
        
        $extensions = array("jpeg", "jpg", "png");
        
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }
        
        if (empty($errors) == true) {
            // Create the images folder at root level if it doesn't exist
            if (!is_dir("images")) {
                mkdir("images", 0777, true);
            }
            
            // Move uploaded image file to the images folder
            move_uploaded_file($file_tmp, "images/" . $file_name);
            
            // This path is saved directly to the database
            $profile_pic_path = "images/" . $file_name;
        } else {
            $errmsg = implode("<br>", $errors);
            $msg = "<div class='alert alert-danger text-center'>$errmsg</div>";
        }
    }
    // ----------------- END OF PROFESSOR'S METHOD -----------------

    // If there were no file errors, update the database record
    if (empty($errors)) {
        if (!empty($profile_pic_path)) {
            $sql = "UPDATE registerr SET 
                    first_name = '$first_name', 
                    last_name = '$last_name', 
                    email = '$email', 
                    mobile = '$mobile', 
                    whatsapp = '$whatsapp', 
                    profile_pic = '$profile_pic_path' 
                    WHERE username = '$session_username'";
        } else {
            $sql = "UPDATE registerr SET 
                    first_name = '$first_name', 
                    last_name = '$last_name', 
                    email = '$email', 
                    mobile = '$mobile', 
                    whatsapp = '$whatsapp' 
                    WHERE username = '$session_username'";
        }

        if (mysqli_query($con, $sql)) {
            $msg = "<div class='alert alert-success text-center'>Profile updated successfully!</div>";
        } else {
            $msg = "<div class='alert alert-danger text-center'>Error updating record: " . mysqli_error($con) . "</div>";
        }
    }
}

// =========================================================================
// 4. FETCH CURRENT LOGGED IN USER DATA TO DISPLAY IN FORM FIELDS
// =========================================================================
$sql = "SELECT * FROM registerr WHERE username = '$session_username'";
$res = mysqli_query($con, $sql);

if (mysqli_num_rows($res) > 0) {
    $user = mysqli_fetch_assoc($res);
    
    $first_name  = isset($user['first_name']) ? $user['first_name'] : "Tabassum";
    $last_name   = isset($user['last_name']) ? $user['last_name'] : "Khan";
    $email       = isset($user['email']) ? $user['email'] : "tabassum@example.com";
    $mobile      = isset($user['mobile']) ? $user['mobile'] : "9876543210";
    $username    = isset($user['username']) ? $user['username'] : "tabassum.khan";
    $whatsapp    = isset($user['whatsapp']) ? $user['whatsapp'] : "9876543210";
    
    // Display fallback image if database path is empty
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
    <script src="./jquery-3.7.1.min.js"></script>
</head>
<body style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">          
    
    <div class="container-fluid py-4" style="max-width: 1200px;"> 
        <div class="rounded-4 shadow-lg p-4 glass-card">          
            <div class="row mb-3 align-items-center">
                <div class="col-md-9">
                    <h2>ACCOUNT PROFILE</h2>
                    <p class="subtitle">Welcome back, <?php echo htmlspecialchars($first_name); ?>! Manage your account details here.</p>
                </div>
                <div class="col-md-3 text-md-end">
                    <a href="about.php" class="btn btn-sm btn-outline-light">Back to Home</a>
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
                        
                        <div class="image-preview-box mb-3" style="position: relative; width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; overflow: hidden;">
                            <button type="button" class="remove-img-btn" id="removeImgBtn" style="position: absolute; top: 5px; right: 5px; z-index: 10; display: none; background: rgba(255,0,0,0.7); border: none; color: white; border-radius: 50%; width: 25px; height: 25px;">&times;</button>
                            <img id="profileImageDisplay" src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Display" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>                       
                        
                        <div class="mb-4">
                            <input type="file" id="uploadPhoto" name="profile_image" class="form-control d-none" accept="image/*">
                            <button type="button" class="btn w-100 btn-outline-light" onclick="document.getElementById('uploadPhoto').click();">Upload Photo</button>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password">
                            <label class="text-white-50" for="old_password">OLD PASSWORD</label>
                        </div>                       
                        <div class="form-floating mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="New Password">
                            <label class="text-white-50" for="password">NEW PASSWORD</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Confirm Password">
                            <label class="text-white-50" for="cpassword">CONFIRM PASSWORD</label>
                        </div>

                        <div class="mt-4 pt-2">
                            <button type="submit" name="update_profile" class="btn w-100 custom-login-btn py-2">Save Profile Settings</button>
                        </div>
                    </div>
                    
                    <!-- ================= RIGHT SIDE COLUMN ================= -->
                    <div class="col-12 col-md-8">                       
                        <h3 class="section-title m-0 mb-2">PROFILE INFORMATION</h3>
                        <div class="row g-2 mb-4">
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" readonly style="background-color: rgba(255,255,255,0.1); color: #ccc;">
                                    <label class="text-white-50" for="username">USERNAME (CANNOT CHANGE)</label>
                                                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="Fname" name="first_name" class="form-control" placeholder="First Name" value="<?php echo htmlspecialchars($first_name); ?>" required>
                                    <label class="text-white-50" for="Fname">FIRST NAME</label>
                                </div>
                            </div>                         
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="Lname" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo htmlspecialchars($last_name); ?>" required>
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
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email ID" value="<?php echo htmlspecialchars($email); ?>" required>
                                    <label class="text-white-50" for="email">EMAIL ID (REQUIRED)</label>
                                </div>
                            </div>
                            
                            <!-- Mobile Number -->
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Mobile Number" value="<?php echo htmlspecialchars($mobile); ?>">
                                    <label class="text-white-50" for="mobile">MOBILE NUMBER</label>
                                </div>
                            </div>

                            <!-- WhatsApp Number -->
                            <div class="col-12">
                                <div class="form-floating mb-2">
                                    <input type="text" id="whatsapp" name="whatsapp" class="form-control" placeholder="WhatsApp Number" value="<?php echo htmlspecialchars($whatsapp); ?>">
                                    <label class="text-white-50" for="whatsapp">WHATSAPP NUMBER</label>
                                </div>
                            </div>
                        </div>

                        <!-- Global Submit Button for Profile Data -->
                        <div class="mt-4 pt-2">
                            <button type="submit" name="update_profile" class="btn w-100 custom-login-btn py-2">Update Profile Info</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Live Preview Script -->
    <script>
        $(document).ready(function() {
            var fallbackImage = "<?php echo $profile_pic; ?>";
            $('#uploadPhoto').on('change', function(e) {
                var file = e.target.files;
                if (file && file[0]) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $('#profileImageDisplay').attr('src', event.target.result);
                        $('#removeImgBtn').fadeIn();
                    };
                    reader.readAsDataURL(file[0]);
                }
            });
            $('#removeImgBtn').on('click', function() {
                $('#uploadPhoto').val('');
                $('#profileImageDisplay').attr('src', fallbackImage);
                $(this).fadeOut();
            });
        });
    </script>
</body>
</html>
