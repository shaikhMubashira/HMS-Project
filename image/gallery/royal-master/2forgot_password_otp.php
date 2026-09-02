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
                            
                            <form action="./3forgot_password.php" method="POST">

                                <!-- DISPLAY ONLY FIELD: Shows the user's custom question (Simulated with placeholder text) -->
                                <div class="form-floating mb-3"> 
                                    <input type="text" id="security_question" class="form-control text-white" 
                                        value="What is your favorite hotel?" 
                                        readonly style="background-color: rgba(255,255,255,0.05); font-weight: bold;">
                                    <label class="text-white-50" for="security_question">YOUR SECURITY QUESTION</label>                                    
                                </div>

                                <!-- INPUT FIELD: Where the user types their answer -->
                                <div class="form-floating mb-4"> 
                                    <input type="text" id="security_answer" name="security_answer" class="form-control" 
                                        placeholder="Enter Your Answer" required autocomplete="off">
                                    <label class="text-white-50" for="security_answer">ENTER YOUR ANSWER</label>                                    
                                </div>

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
