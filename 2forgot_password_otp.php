<?php
// session_start();
// // Agar session mein email hai toh theek, nahi toh pichli file ke POST se utha lo
// if (isset($_POST['email']) && !empty($_POST['email'])) {
//     $_SESSION['reset_email'] = $_POST['email'];
// }
// $email = $_SESSION['reset_email'] ?? '';
// $security_question = $_SESSION['security_question']??'';
?>
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "client");
$email = $_SESSION['reset_email'] ?? '';

// 1. Fetch exact database columns: 'Question' and 'Answer'
$sql = "SELECT Question, Answer FROM registerr WHERE email='$email'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

// 2. Match the database column name 'Question'
$security_question = $row['Question'] ?? 'Question not found';

$error = "";

// Jab user answer daal kar submit kare
if (isset($_POST['verify_answer'])) {
    $user_answer = trim($_POST['security_answer'] ?? '');
    
    // 3. Match using the correct column name 'Answer'
    if ($row && strtolower($row['Answer']) == strtolower($user_answer)) {
        $_SESSION['answer_verified'] = true;
        header("Location: 3forgot_password.php"); // Naya password set karne wala page
        exit();
    } else {
        $error = "Wrong answer try again";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SECURITY QUESTION VERIFICATION</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forgotpassword.css">
    <script src="css/jquery-3.7.1.min.js"></script>
</head>
<body style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    
    <!-- Using the same wide sizing classes to match your clean, non-cramped signup layout -->
    <div class="container py-2"> 
        <div class="row justify-content-start p-1 w-100">            
            <div class="col-12 col-sm-11 col-md-11 col-lg-9 col-xl-8"> 
                
                <div class="rounded-4 shadow-lg p-4 glass-card"> 
                    <div class="row align-items-center"> 
                        <div class="col">                            
                            
                            <h1 class="text-center mb-1">IDENTITY VERIFICATION</h1>
                            <p class="text-center subtitle mb-4">ANSWER YOUR SECURITY QUESTION TO RESET YOUR PASSWORD.</p>
                            
                            <form action="" method="POST">

                                <!-- DISPLAY ONLY FIELD: Shows the user's custom question (Simulated with placeholder text) -->
                                <div class="form-floating mb-3"> 
                                    <input type="text" id="security_question" class="form-control text-white" 
                                    value="<?php echo $security_question; ?>"
                                        readonly style="background-color: rgba(255,255,255,0.05); font-weight: bold;">
                                    <label class="text-white-50" for="security_question">YOUR SECURITY QUESTION</label>                                    
                                </div>
                                
                                <!-- INPUT FIELD: Where the user types their answer -->
                                <div class="form-floating mb-4"> 
                                    <input type="text" id="security_answer" name="security_answer" class="form-control" 
                                        placeholder="Enter Your Answer" required autocomplete="off">
                                    <label class="text-white-50" for="security_answer">ENTER YOUR ANSWER</label>                                    
                                </div>
                                <?php if (!empty($error)) { echo "<div class='text-danger mb-3 text-center fw-bold'>$error</div>"; } ?>
                                <!-- Button submits the answer -->
                                <button type="submit" name="verify_answer" class="btn w-100 custom-login-btn py-2">VERIFY & CONTINUE</button>
                            </form>

                        </div>
                    </div>
                </div> 
                
            </div>
        </div>
    </div>

</body>
</html>