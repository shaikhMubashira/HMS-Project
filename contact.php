<?php
    session_start()
?>

<!doctype html>
<html lang="en">
        <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Hotel REST INN</title>
        
        <!-- Core Layout Engine Framework -->
        <link rel="stylesheet" href="css/bootstrap.css">
        
        <!-- Typographic Icon Framework Vector Sheets -->
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        
        <!-- Interactive Interface Widget Plugins -->
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        
        <!-- Customized Project Branding Theme Rules -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>

<body>
    <!--================Header Area =================-->
    <header class="header_area">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- Image branding for MTF INN -->
                <a class="navbar-brand logo_h" href="index.php">
                    <img src="image/logo1.png" alt="MTF INN Logo" style="height: 75px; width: 150px; max-height: 100%;">
                </a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> 
                        <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item active"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="Roombooking.php">Room booking</a></li>
                        <li class="nav-item"><a class="nav-link" href="MyBooking.php">My Booking</a></li>
                        <!-- DYNAMIC PROFILE LINK -->
                        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                            <li class="nav-item"><a class="nav-link" href="profile.php">My Profile</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">LogOut</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Area =================-->
        
    <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Contact Us</h2>
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">Contact Us</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
            
            <!-- India Location Maps Frame -->
            <!-- Functional, Clean Mumbai, India Location Maps Frame -->
            <!-- Functional, Clean Location Maps Frame using text query -->
            <!-- Functional, Clean Location Maps Frame -->
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d491713.50350883417!2d73.10053068906248!3d15.670967400000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfeefa3ea65a85%3A0x1ece1eb7bedaffe8!2sRiva%20Beach%20Resort!5e0!3m2!1sen!2sin!4v1788547314599!5m2!1sen!2sin" 
                width="100%" 
                height="450" 
                style="border:0; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="strict-origin-when-cross-origin">
            </iframe>



        
            <div class="row mt-5">
            <!--================ Contact Grid Layout =================-->
            <section class="pinterest-style-wrapper" style="background: #f8fafc; padding: 70px 0; width: 100% !important; max-width: 100% !important; display: block; clear: both;">
                <!-- Wide Fluid container breaks out of your old layout grid limits -->
                <div class="container-fluid" style="width: 90% !important; max-width: 1200px !important; margin: 0 auto !important; padding: 0 !important;">
                    
                    <!-- Top Minimalist Text Headers -->
                    <div class="text-center" style="margin-bottom: 45px !important; width: 100% !important; display: block;">
                        <h2 style="color: #0a182f; font-weight: 800; font-size: 32px !important; margin-bottom: 12px !important; letter-spacing: 0.5px;">Need help with your online booking?</h2>
                        <p class="text-muted" style="font-size: 16px !important; max-width: 650px; margin: 0 auto !important; line-height: 1.6;">Have a question or need more information? Just drop us a line and our desk team will reply shortly.</p>
                    </div>

                    <!-- Master Split Card Container Grid Wrapper -->
                    <div class="row g-0 rounded-4 overflow-hidden shadow-lg mx-0" style="background: #ffffff; border-radius: 16px !important; box-shadow: 0 15px 40px rgba(0,0,0,0.1) !important; display: flex !important; flex-wrap: wrap !important; width: 100% !important;">
                        
                        <!-- LEFT HALF: Minimalist User Input Form Fields (7/12 Parts of Screen Width) -->
                        <div class="col-12 col-md-7 p-4 p-md-5" style="background: #ffffff; padding: 45px !important; flex: 0 0 58.333333%; max-width: 58.333333%;">
                            <h4 class="fw-bold" style="color: #0a182f; font-size: 20px !important; font-weight: 700 !important; margin-bottom: 30px !important; letter-spacing: 0.5px;">Fill up the form if you have any questions</h4>
                            
                            <form class="contact_form" action="" method="post" id="contactForm" style="width: 100% !important;">
                                <div class="form-group" style="margin-bottom: 20px !important;">
                                    <label class="small text-muted fw-bold" style="font-size: 13px !important; display: block; margin-bottom: 6px !important; color: #4a5568 !important;">Your Name*</label>
                                    <input type="text" class="form-control px-3" id="name" name="name" required style="border: 1px solid #cbd5e0 !important; border-radius: 6px !important; height: 48px !important; background: #fafafa !important; font-size: 14px !important; width: 100% !important; color: #2d3748 !important;">
                                </div>
                                <div class="form-group" style="margin-bottom: 20px !important;">
                                    <label class="small text-muted fw-bold" style="font-size: 13px !important; display: block; margin-bottom: 6px !important; color: #4a5568 !important;">Your Mail*</label>
                                    <input type="email" class="form-control px-3" id="email" name="email" required style="border: 1px solid #cbd5e0 !important; border-radius: 6px !important; height: 48px !important; background: #fafafa !important; font-size: 14px !important; width: 100% !important; color: #2d3748 !important;">
                                </div>
                                <div class="form-group" style="margin-bottom: 20px !important;">
                                    <label class="small text-muted fw-bold" style="font-size: 13px !important; display: block; margin-bottom: 6px !important; color: #4a5568 !important;">Your Subject*</label>
                                    <input type="text" class="form-control px-3" id="subject" name="subject" required style="border: 1px solid #cbd5e0 !important; border-radius: 6px !important; height: 48px !important; background: #fafafa !important; font-size: 14px !important; width: 100% !important; color: #2d3748 !important;">
                                </div>
                                <div class="form-group" style="margin-bottom: 25px !important;">
                                    <label class="small text-muted fw-bold" style="font-size: 13px !important; display: block; margin-bottom: 6px !important; color: #4a5568 !important;">Write Message*</label>
                                    <textarea class="form-control p-3" name="message" id="message" rows="5" required style="border: 1px solid #cbd5e0 !important; border-radius: 6px !important; background: #fafafa !important; font-size: 14px !important; width: 100% !important; color: #2d3748 !important; resize: none; height: 120px !important; line-height: 1.5;"></textarea>
                                </div>
                                
                                <button type="submit" name="submit_msg" class="btn btn-dark fw-bold text-uppercase px-4 shadow-sm" style="background-color: #0a182f !important; color: #ffffff !important; border: none !important; border-radius: 6px !important; height: 50px !important; font-size: 14px !important; letter-spacing: 1px !important; padding: 0 30px !important;">
                                    Send a Message
                                </button>
                            </form>
                        </div>

                        <!-- RIGHT HALF: Solid Dark Blue Information Box Block (5/12 Parts of Screen Width) -->
                        <div class="col-12 col-md-5 p-4 p-md-5 d-flex flex-column justify-content-center text-center text-md-start" style="background: #0a182f !important; color: #ffffff !important; padding: 45px !important; flex: 0 0 41.666667%; max-width: 41.666667%;">
                            
                            <!-- Location Info Group -->
                            <div style="margin-bottom: 35px !important; text-align: left !important;">
                                <h6 style="color: #d4af37 !important; font-weight: 800 !important; font-size: 13px !important; letter-spacing: 2px !important; text-transform: uppercase; margin-bottom: 10px !important;">Location</h6>
                                <p style="color: rgba(255,255,255,0.85) !important; font-size: 15px !important; line-height: 1.6; margin: 0 !important;">
                                    123 Luxury Road, Worli,<br>
                                    Mumbai, Maharashtra<br>
                                    400018, India
                                </p>
                            </div>

                            <!-- Contact Info Group -->
                            <div style="margin-bottom: 35px !important; text-align: left !important;">
                                <h6 style="color: #d4af37 !important; font-weight: 800 !important; font-size: 13px !important; letter-spacing: 2px !important; text-transform: uppercase; margin-bottom: 10px !important;">Contact</h6>
                                <p style="color: rgba(255,255,255,0.85) !important; font-size: 15px !important; margin: 0 !important; line-height: 1.6;">
                                    +91 98765 43210<br>
                                    <a href="mailto:support@mtfinn.com" style="color: rgba(255,255,255,0.85) !important; text-decoration: none !important;">support@mtfinn.com</a>
                                </p>
                            </div>

                            <!-- Social Links Info Group -->
                            <div style="text-align: left !important;">
                                <h6 style="color: #d4af37 !important; font-weight: 800 !important; font-size: 13px !important; letter-spacing: 2px !important; text-transform: uppercase; margin-bottom: 15px !important;">Social</h6>
                                <div style="display: flex !important; gap: 20px !important;">
                                    <a href="#" style="color: rgba(255,255,255,0.6) !important; font-size: 18px !important; text-decoration: none !important;"><i class="fa fa-facebook"></i></a>
                                    <a href="#" style="color: rgba(255,255,255,0.6) !important; font-size: 18px !important; text-decoration: none !important;"><i class="fa fa-twitter"></i></a>
                                    <a href="#" style="color: rgba(255,255,255,0.6) !important; font-size: 18px !important; text-decoration: none !important;"><i class="fa fa-instagram"></i></a>
                                </div><!-- Close left form column -->
                            </div><!-- Close master card split grid row -->
                        </div><!-- Close content inner container-fluid -->
                    </section><!-- Close pinterest style section wrapper -->
                </div><!-- Close map/row grid inner container -->
            </section><!-- Close contact_area wrapper section entirely -->
        </div>
    <!--================ Contact Area End =================-->

    <!--================ start footer Area  =================-->	
    <footer class="footer-area section_gap" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="container">
            <div class="row">
                <!-- Column 1: About MTF INN -->
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="single-footer-widget">
                        <h6 class="footer_title" style="color: #d4af37; font-weight: bold; text-transform: uppercase; margin-bottom: 20px;">About MTF INN</h6>
                        <p style="color: rgba(255,255,255,0.7); font-size: 14px; line-height: 1.6;">Experience absolute luxury, premium room accommodations, and seamless hospitality. MTF INN offers top-tier amenities to ensure a comfortable staying experience for corporate and holiday travelers alike.</p>
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="single-footer-widget">
                        <h6 class="footer_title" style="color: #d4af37; font-weight: bold; text-transform: uppercase; margin-bottom: 20px;">Quick Links</h6>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list_style" style="list-style: none; padding-left: 0; line-height: 2;">
                                    <li><a href="index.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Home</a></li>
                                    <li><a href="about.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">About Us</a></li>
                                    <li><a href="gallery.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Gallery</a></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list_style" style="list-style: none; padding-left: 0; line-height: 2;">
                                    <li><a href="contact.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Contact</a></li>
                                    <li><a href="Roombooking.php" style="color: rgba(255,255,255,0.7); text-decoration: none;">Book Room</a></li>
                                </ul>
                            </div>										
                        </div>							
                    </div>
                </div>							
                
                <!-- Column 3: Contact Details -->
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="single-footer-widget">
                        <h6 class="footer_title" style="color: #d4af37; font-weight: bold; text-transform: uppercase; margin-bottom: 20px;">Contact Info</h6>
                        <p style="color: rgba(255,255,255,0.7); font-size: 14px; line-height: 1.8;">
                            <i class="fa fa-map-marker" style="color: #d4af37; margin-right: 10px;"></i> 123 Luxury Road, Mumbai, India<br>
                            <i class="fa fa-phone" style="color: #d4af37; margin-right: 10px;"></i> +91 98765 43210<br>
                            <i class="fa fa-envelope" style="color: #d4af37; margin-right: 10px;"></i> support@mtfinn.com
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="border_line" style="background: rgba(255,255,255,0.1); height: 1px; margin: 30px 0;"></div>
            
            <div class="row footer-bottom d-flex justify-content-between align-items-center">
                <p class="col-lg-8 col-sm-12 footer-text m-0" style="color: rgba(255,255,255,0.5); font-size: 13px;">
                    Copyright &copy;2026 All rights reserved | <strong>MTF INN Hotel Management System</strong>
                </p>
                <div class="col-lg-4 col-sm-12 footer-social text-md-end mt-3 mt-lg-0">
                    <a href="#" style="color: rgba(255,255,255,0.5); margin-left: 15px; font-size: 16px;"><i class="fa fa-facebook"></i></a>
                    <a href="#" style="color: rgba(255,255,255,0.5); margin-left: 15px; font-size: 16px;"><i class="fa fa-twitter"></i></a>
                    <a href="#" style="color: rgba(255,255,255,0.5); margin-left: 15px; font-size: 16px;"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->
        
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.js"></script>
<script src="js/stellar.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
