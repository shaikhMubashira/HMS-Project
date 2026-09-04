<?php
    session_start()
?>
<!doctype html>
<html lang="en">
       <head>
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Hotel REST INN</title>
        
       
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
                        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li> 
                        <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
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
    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center" style="min-height: 100vh;">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center mt-6">
                    <h6>Away from monotonous life</h6>
                    <h2>Relax Your Mind</h2>
                    <p class="mb-4">Welcome to Rest Inn. Experience luxury, premium accommodations, and seamless hospitality.</p>
                    
                    <!-- Simplified button pointing cleanly to your future dedicated booking file -->
                    <a href="booking.php" class="btn theme_btn button_hover btn-lg" style="background: #d4af37; color: #fff; padding: 12px 35px; border-radius: 4px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">Book Your Room Now</a>
                </div>
            </div>
        </div>
    </section>
    <!--================Banner Area =================-->

    <!--================ Rooms Section =================-->
    <section class="accomodation_area section_gap">
        <div class="container">
            <!-- Simplified Title to match Rest Inn branding -->
            <div class="section_title text-center">
                <h2 class="title_color">Our Featured Rooms</h2>
                <p>Explore our selection of premium spaces designed for ultimate relaxation and comfort.</p>
            </div>
            
            <!-- flex row forces uniform boundary box stretching -->
            <div class="row  d-flex align-items-stretch">
                
                <!-- Room 1: Double Deluxe -->
                <div class="col-lg-3 col-sm-6 mb-4 d-flex">
                    <div class="accomodation_item text-center w-100 d-flex flex-column justify-content-between" style="background: transparent; border: none; padding: 0;">
                        <div>
                            <div class="hotel_img" style="position: relative; overflow: hidden; border-radius: 8px; width: 100%;">
                                <!-- Updated extension to .png with strict image normalization sizing rules -->
                                <img src="image/room1.png" alt="Double Deluxe Room" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover; display: block; transition: all 0.3s ease;">
                                <a href="booking.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="booking.php" style="text-decoration: none;"><h4 class="sec_h4 mt-3" style="min-height: 48px; display: flex; align-items: center; justify-content: center; margin-bottom: 0;">Double Deluxe Room</h4></a>
                        </div>
                        <!-- Unified color scheme assignment layout -->
                        <h5 class="mt-2" style="color: #24b6e6; font-weight: bold; font-size: 20px; margin-top: 10px;">₹2,500<small style="color: #666; font-size: 14px;">/night</small></h5>
                    </div>
                </div>
                
                <!-- Room 2: Single Deluxe -->
                <div class="col-lg-3 col-sm-6 mb-4 d-flex">
                    <div class="accomodation_item text-center w-100 d-flex flex-column justify-content-between" style="background: transparent; border: none; padding: 0;">
                        <div>
                            <div class="hotel_img" style="position: relative; overflow: hidden; border-radius: 8px; width: 100%;">
                                <img src="image/room2.png" alt="Single Deluxe Room" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover; display: block; transition: all 0.3s ease;">
                                <a href="Roombooking.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="booking.php" style="text-decoration: none;"><h4 class="sec_h4 mt-3" style="min-height: 48px; display: flex; align-items: center; justify-content: center; margin-bottom: 0;">Single Deluxe Room</h4></a>
                        </div>
                        <h5 class="mt-2" style="color: #24b6e6; font-weight: bold; font-size: 20px; margin-top: 10px;">₹1,800<small style="color: #666; font-size: 14px;">/night</small></h5>
                    </div>
                </div>
                
                <!-- Room 3: Executive Suite -->
                <div class="col-lg-3 col-sm-6 mb-4 d-flex">
                    <div class="accomodation_item text-center w-100 d-flex flex-column justify-content-between" style="background: transparent; border: none; padding: 0;">
                        <div>
                            <div class="hotel_img" style="position: relative; overflow: hidden; border-radius: 8px; width: 100%;">
                                <img src="image/room3.png" alt="Executive Suite" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover; display: block; transition: all 0.3s ease;">
                                <a href="booking.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="booking.php" style="text-decoration: none;"><h4 class="sec_h4 mt-3" style="min-height: 48px; display: flex; align-items: center; justify-content: center; margin-bottom: 0;">Executive Suite</h4></a>
                        </div>
                        <h5 class="mt-2" style="color: #24b6e6; font-weight: bold; font-size: 20px; margin-top: 10px;">₹5,500<small style="color: #666; font-size: 14px;">/night</small></h5>
                    </div>
                </div>
                
                <!-- Room 4: Economy Double -->
                <div class="col-lg-3 col-sm-6 mb-4 d-flex">
                    <div class="accomodation_item text-center w-100 d-flex flex-column justify-content-between" style="background: transparent; border: none; padding: 0;">
                        <div>
                            <div class="hotel_img" style="position: relative; overflow: hidden; border-radius: 8px; width: 100%;">
                                <img src="image/room4.png" alt="Economy Double Room" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover; display: block; transition: all 0.3s ease;">
                                <a href="booking.php" class="btn theme_btn button_hover">Book Now</a>
                            </div>
                            <a href="booking.php" style="text-decoration: none;"><h4 class="sec_h4 mt-3" style="min-height: 48px; display: flex; align-items: center; justify-content: center; margin-bottom: 0;">Economy Double</h4></a>
                        </div>
                        <h5 class="mt-2" style="color: #24b6e6; font-weight: bold; font-size: 20px; margin-top: 10px;">₹1,500<small style="color: #666; font-size: 14px;">/night</small></h5>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--================ Rooms Section =================-->



    <!--================ Facilities Area  =================-->
    <section class="facilities_area section_gap">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <!-- Updated Title to match Rest Inn branding -->
            <div class="section_title text-center">
                <h2 class="title_w">Our Premium Facilities</h2>
                <p>Enjoy world-class amenities designed to make your stay unforgettable.</p>
            </div>
            
            <div class="row mb_30">
                <!-- Facility 1: Restaurant -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-dinner"></i>In-House Restaurant</h4>
                        <p>Savour delicious local Indian dishes and international cuisines prepared by our expert chefs.</p>
                    </div>
                </div>
                
                <!-- Facility 2: Sports Club -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-bicycle"></i>Sports & Recreation</h4>
                        <p>Stay active during your vacation with indoor games, cycling tracks, and recreational activities.</p>
                    </div>
                </div>
                
                <!-- Facility 3: Swimming Pool -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-drop"></i>Swimming Pool</h4>
                        <p>Take a refreshing dip or relax by the poolside with our beautifully designed outdoor swimming pool.</p>
                    </div>
                </div>
                
                <!-- Facility 4: Rent a Car -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-car"></i>Travel Desk & Car Rental</h4>
                        <p>Explore the local city attractions easily with our 24/7 dedicated car rental and travel assistance desk.</p>
                    </div>
                </div>
                
                <!-- Facility 5: Gymnasium -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-heart"></i>Modern Gymnasium</h4>
                        <p>Keep up with your fitness routine using our fully equipped gym with modern workout machines.</p>
                    </div>
                </div>
                
                <!-- Facility 6: Coffee Shop -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="facilities_item">
                        <h4 class="sec_h4"><i class="lnr lnr-coffee-cup"></i>24/7 Coffee Shop</h4>
                        <p>Enjoy premium coffee blends, refreshing beverages, and light snacks at any hour of the day.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Facilities Area  =================-->
        
    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <!-- Left Side Text Content -->
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content">
                        <h2 class="title title_color">About Us <br>Our Legacy &<br>Hospitality Vision</h2>
                        <p>Welcome to Rest Inn, where luxury meets comfortable living. Established with a vision to provide exceptional hospitality, we offer premium rooms, world-class amenities, and personalized services to make your stay feel like home. Whether you are traveling for business or a relaxing vacation, our dedicated team ensures your comfort is always our top priority.</p>
                        
                        <!-- Clean route action pointing directly to your room booking interface -->
                        <a href="Roombooking.php" class="button_hover theme_btn_two" style="text-decoration: none; padding: 12px 30px; display: inline-block; font-weight: bold; border-radius: 4px;">Book A Room Now</a>
                    </div>
                </div>
                
                <!-- Right Side Image Content -->
                <div class="col-md-6 mt-4 mt-md-0">
                    <img class="img-fluid" src="image/about_bg.jpg" alt="About Rest Inn" style="border-radius: 8px; shadow: 0 4px 15px rgba(0,0,0,0.1);">
                </div>
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->

    <!--================ Static VIP Reviews Area =================-->
    <section class="testimonial_area section_gap" style="background: rgba(10, 24, 47, 0.03);">
        <div class="container">
            <!-- Section Title Block -->
            <div class="section_title text-center">
                <h2 class="title_color">Guest Experiences</h2>
                <p>Words of appreciation from corporate leaders and corporate travelers who stayed with us.</p>
            </div>            
            <div class="row g-4">                
                <!-- Review 1: Column 1, Row 1 -->
                <div class="col-md-6 mb-4">
                    <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px;">
                        <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                            <img class="rounded-circle" src="image/home/vip1.png" alt="Vikram Mehta" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37;">
                        </div>
                        <div>
                            <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Vikram Mehta</h4>
                            <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Tech Consultant & Frequent Traveler</p>
                            <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"The high-speed internet layout and quiet desk setup in the room were perfect for my business schedule. The team went out of their way to ensure a seamless stay."</p>
                        </div>
                    </div>
                </div>                   
                <!-- Review 2: Column 2, Row 1 -->
                <div class="col-md-6 mb-4">
                    <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px;">
                        <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                            <img class="rounded-circle" src="image/home/vip2.png" alt="Dr. Neha Sharma" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37;">
                        </div>
                        <div>
                            <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Dr. Neha Sharma</h4>
                            <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Conference Delegate</p>
                            <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"A perfect environment to unwind after long hours. The clean room design and excellent hospitality standards here make Rest Inn my favorite option in the city."</p>
                        </div>
                    </div>
                </div>
                <!-- Review 3: Column 1, Row 2 -->
                <div class="col-md-6 mb-4">
                    <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px;">
                        <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                            <img class="rounded-circle" src="image/home/vip3.png" alt="Rohan Malhotra" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37;">
                        </div>
                        <div>
                            <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Rohan Malhotra</h4>
                            <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Independent Travel Blogger</p>
                            <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"Rest Inn delivers an impressive combination of premium look and reasonable pricing. The 24/7 coffee shop is a fantastic addition. Highly recommended code execution!"</p>
                        </div>
                    </div>
                </div>            
                <!-- Review 4: Column 2, Row 2 -->
                <div class="col-md-6 mb-4">
                    <div class="p-4 bg-white rounded-3 shadow-sm border-0 d-flex" style="height: 100%; min-height: 180px;">
                        <div class="me-3 flex-shrink-0" style="margin-right: 15px;">
                            <img class="rounded-circle" src="image/home/vip4.png" alt="Saira Sheikh" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid #d4af37;">
                        </div>
                        <div>
                            <h4 class="mb-1" style="color: #0a182f; font-size: 18px; font-weight: bold; margin-top: 0;">Saira Sheikh</h4>
                            <p class="text-muted small mb-2" style="color: #777; font-size: 13px; margin-top: 2px;">Corporate HR Manager</p>
                            <p style="color: #555; font-size: 14px; line-height: 1.5; font-style: italic; margin-top: 5px;">"The overall ambiance and fast room service are spectacular. The culinary selections at the in-house restaurant were outstanding. A flawless experience."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Static VIP Reviews Area =================-->

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
<!-- FIXED PATHWAY: Links to your active local workspace jquery core file cleanly -->
<script src="jquery-3.7.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.js"></script>
<script src="js/stellar.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
