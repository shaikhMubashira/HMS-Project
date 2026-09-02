<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHANGE PASSWORD PAGE</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/forgotpassword.css">
    <script src="css/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showPasswordCheckbox').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#password, #cpassword').attr('type', 'text');
                } else {                    
                    $('#password, #cpassword').attr('type', 'password');
                }
            });
        });
    </script>
</head>
<body style="background: linear-gradient(rgba(10, 24, 47, 0.6), rgba(10, 24, 47, 0.8)), url('./image/login/hotel-bg.png') no-repeat center center fixed; background-size: cover; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    
    <div class="container"> 
        <div class="row justify-content-start">            
            <div class="col-12 col-md-7"> 
                
                <div class="rounded-4 shadow-lg p-4 glass-card"> 
                    <div class="row align-items-center"> 
                        <div class="col">                            
                            
                            <h1 class="text-center">CHANGE PASSWORD</h1>
                            <p class="text-center subtitle">SET Your New Password</p>
                            
                            <form action="./index.php" method="POST">

                                <!-- New Password Field -->
                                <div class="form-floating mb-3">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                    <label class="text-white-50" for="password">NEW PASSWORD</label>
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="form-floating mb-3">
                                    <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Confirm Password" required>
                                    <label class="text-white-50" for="cpassword">CONFIRM PASSWORD</label>
                                </div>

                                <!--Show Password Checkbox -->
                                <div class="form-check mb-3 mt-2 text-start">
                                    <input class="form-check-input" type="checkbox" id="showPasswordCheckbox">
                                    <label class="form-check-label text-white-50" style="cursor: pointer;" for="showPasswordCheckbox">
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
