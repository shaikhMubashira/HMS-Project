<?php
session_start()
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel MTF INN</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
    </head>
    <body>
    
    <!--================Header Area =================-->
    <header class="header_area">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- Text branding for REST INN -->
                <a class="navbar-brand logo_h" href="index.php" style="font-weight: bold; color: #0a182f; font-size: 24px; text-decoration: none;">REST INN</a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item "><a class="nav-link" href="index.php">Home</a></li> 
                        <li class="nav-item active"><a class="nav-link" href="about.php">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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
                    <h2 class="page-cover-tittle">About Us</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">About</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================ About History Area  =================-->
        <section class="about_history_area section_gap">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d_flex align-items-center">
                        <div class="about_content ">
                            <h2 class="title title_color">About Us <br>Our History<br>Mission & Vision</h2>
                            <p>Welcome to MTF INN, where comfort meets classic hospitality. Established with a vision to redefine luxury accommodation, our mission is to provide an elite, relaxing stay experience with premier customer support and modern facilities for travelers worldwide.</p>
                            <a href="Roombooking.php" class="button_hover theme_btn_two">Book Your Stay Now</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid" src="image/about_bg.jpg" alt="img">
                    </div>
                </div>
            </div>
        </section>
        <!--================ About History Area  =================-->
                        
        <!--================ Facilities Area  =================-->
        <section class="facilities_area section_gap">
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">  
            </div>
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_w">MTF INN Luxury Facilities</h2>
                    <p>Experience world-class hospitality with our 9 premier amenities designed for your ultimate comfort.</p>
                </div>
                <div class="row mb_30">
                    <!-- Facility 1: Restaurant -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>Fine Dining Restaurant</h4>
                            <p>Savor gourmet Indian and international cuisines crafted by expert chefs in our main dining hall.</p>
                        </div>
                    </div>
                    <!-- Facility 2: Sports Club -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-bicycle"></i>Sports & Recreation</h4>
                            <p>Stay active with access to premium badminton courts, indoor sports zones, and cycling tracks.</p>
                        </div>
                    </div>
                    <!-- Facility 3: Swimming Pool -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-shirt"></i>Infinity Swimming Pool</h4>
                            <p>Relax and refresh inside our pristine, temperature-controlled outdoor pool and deck lounge area.</p>
                        </div>
                    </div>
                    <!-- Facility 4: Rent a Car -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-car"></i>Luxury Car Rentals</h4>
                            <p>Explore city destinations effortlessly with premium chauffeur-driven sedans available on demand.</p>
                        </div>
                    </div>
                    <!-- Facility 5: Gymnasium -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-construction"></i>Fitness Gymnasium</h4>
                            <p>Maintain your workout regime using our state-of-the-art strength and cardio training machinery.</p>
                        </div>
                    </div>
                    <!-- Facility 6: Bar -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-coffee-cup"></i>Executive Lounge & Bar</h4>
                            <p>Wind down your evening with premium handcrafted mocktails, cocktails, and freshly brewed blends.</p>
                        </div>
                    </div>
                    <!-- Facility 7: High Speed Wi-Fi (NEW) -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-laptop"></i>High-Speed Wi-Fi</h4>
                            <p>Stay seamlessly connected across the entire premises with complimentary ultra-fast internet network lines.</p>
                        </div>
                    </div>
                    <!-- Facility 8: Laundry Service (NEW) -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-picture"></i>Express Laundry Service</h4>
                            <p>Enjoy prompt and professional dry cleaning and same-day apparel pressing assistance.</p>
                        </div>
                    </div>
                    <!-- Facility 9: 24/7 Room Service (NEW) -->
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-alarm"></i>24/7 Concierge Support</h4>
                            <p>Experience custom hospitality with dedicated around-the-clock room service and assistance at your doorstep.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================ Facilities Area  =================-->

        
        <!--================ Static Common Guest Reviews Area =================-->
            <section class="testimonial_area section_gap" style="background: rgba(10, 24, 47, 0.03);">
                <div class="container">
                    <!-- Section Title Block -->
                    <div class="section_title text-center">
                        <h2 class="title_color">Stories from Our Guests</h2>
                        <p>Real feedback highlights shared by individual travelers, couples, and families who stayed with us.</p>
                    </div>            
                    <div class="row g-4">                
                        <!-- Review 1: Column 1, Row 1 -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                                    <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="Vikram Mehta" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37; border-radius: 50%;">
                                </div>
                                <div>
                                    <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Vikram Mehta</h4>
                                    <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Solo Traveler</p>
                                    <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"The high-speed internet connection and comfortable room setup were perfect for my travel schedule. The front desk staff was incredibly warm and made my stay seamless."</p>
                                </div>
                            </div>
                        </div>                   
                        <!-- Review 2: Column 2, Row 1 -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                                    <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="Neha Sharma" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37; border-radius: 50%;">
                                </div>
                                <div>
                                    <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Neha Sharma</h4>
                                    <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Family Vacation</p>
                                    <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"A wonderful environment to unwind with family. The clean room design and excellent hospitality standards here make MTF INN my absolute favorite option in the city."</p>
                                </div>
                            </div>
                        </div>
                        <!-- Review 3: Column 1, Row 2 -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                                    <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="Rohan Malhotra" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37; border-radius: 50%;">
                                </div>
                                <div>
                                    <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Rohan Malhotra</h4>
                                    <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Backpacker</p>
                                    <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"MTF INN delivers a fantastic combination of a premium look and very reasonable pricing. The 24/7 room assistance is a huge plus. Highly recommended!"</p>
                                </div>
                            </div>
                        </div>            
                        <!-- Review 4: Column 2, Row 2 -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                                    <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="Saira Sheikh" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37; border-radius: 50%;">
                                </div>
                                <div>
                                    <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Saira Sheikh</h4>
                                    <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Weekend Getaway</p>
                                    <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"The overall cozy ambiance and fast room service are spectacular. The breakfast selections at the restaurant were outstanding. A totally flawless experience."</p>
                                </div>
                            </div>
                        </div>
                        <!-- Review 5: Column 1, Row 3 (NEW) -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                                    <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="Kabir Verma" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37; border-radius: 50%;">
                                </div>
                                <div>
                                    <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Kabir Verma</h4>
                                    <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Business Trip</p>
                                    <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"Excellent value for an executive stay. The room was perfectly quiet, the workspace setup was highly functional, and the gym facilities were top-notch. Finding such a clean setup is rare."</p>
                                </div>
                            </div>
                        </div>            
                        <!-- Review 6: Column 2, Row 3 (NEW) -->
                        <div class="col-md-6 mb-4">
                            <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                                    <img class="rounded-circle" src="image/testtimonial-1.jpg" alt="Meera Nair" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37; border-radius: 50%;">
                                </div>
                                <div>
                                    <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Meera Nair</h4>
                                    <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Couple Holiday</p>
                                    <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"We spent three nights in a Double Deluxe room. The interior design looked premium, the restaurant food was amazing, and everything felt completely welcoming. Highly recommended for couples!"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!--================ Static Common Guest Reviews Area =================-->
    
    <!--================ start footer Area  =================-->	
    <footer class="footer-area section_gap" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="container">
            <div class="row">
                <!-- Column 1: About Rest Inn -->
                <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="single-footer-widget">
                        <h6 class="footer_title" style="color: #d4af37; font-weight: bold; text-transform: uppercase; margin-bottom: 20px;">About Rest Inn</h6>
                        <p style="color: rgba(255,255,255,0.7); font-size: 14px; line-height: 1.6;">Experience absolute luxury, premium room accommodations, and seamless hospitality. Rest Inn offers top-tier amenities to ensure a comfortable staying experience for corporate and holiday travelers alike.</p>
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
                            <i class="fa fa-envelope" style="color: #d4af37; margin-right: 10px;"></i> support@restinn.com
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="border_line" style="background: rgba(255,255,255,0.1); height: 1px; margin: 30px 0;"></div>
            
            <div class="row footer-bottom d-flex justify-content-between align-items-center">
                <p class="col-lg-8 col-sm-12 footer-text m-0" style="color: rgba(255,255,255,0.5); font-size: 13px;">
                    Copyright &copy;2026 All rights reserved | <strong>Rest Inn Hotel Management System</strong>
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
