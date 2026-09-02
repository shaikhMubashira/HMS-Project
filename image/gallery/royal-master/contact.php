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
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li> 
                        <li class="nav-item"><a class="nav-link" href="about.php">About us</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item active"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="Roombooking.php">Room booking</a></li>
                        
                        <!-- DYNAMIC PROFILE LINK -->
                        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                            <li class="nav-item"><a class="nav-link" href="profile.php" style="color: #d4af37; font-weight: bold;">My Profile</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="login.php" style="color: #d4af37; font-weight: bold;">Log In</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Area =================-->
        
       <!--================Breadcrumb Area =================-->
    <section class="breadcrumb_area">
        <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background="">
        </div>
        <div class="container">
            <div class="page-cover text-center">
                <h2 class="page-cover-tittle">Contact Us</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Contact Us</li>
                </ol>
            </div>
        </div>
    </section>
    <!--================Breadcrumb Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
            <!--================Contact Area =================-->

            <section class="contact_area section_gap">
                <div class="container">
                    <!-- Google Map -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3934.712098866427!2d100.06447737502516!3d9.533722790549179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3054f4309dfa9f6b%3A0xc00f8a139732550a!2sDara%20Samui%20Beach%20Resort!5e0!3m2!1sen!2sin!4v1788152254208!5m2!1sen!2sin"
                        width="1110" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    <div class="row">
                        <!-- Contact Information -->
                        <div class="row">
                            <!-- Contact Information -->
                            <div class="col-md-3">
                                <div class="contact_info">
                                    <div class="info_item">
                                        <i class="lnr lnr-home"></i>
                                        <h6>Dara Samui Beach Resort</h6>
                                        <p>
                                            162/2 Moo 2 Chaweng Beach,<br>
                                            Bophud, Koh Samui,<br>
                                            Suratthani 84320, Thailand
                                        </p>
                                    </div>
                                    <div class="info_item">
                                        <i class="lnr lnr-phone-handset"></i>
                                        <h6>
                                            <a href="tel:+6677231323">
                                                +66 (0) 77 231 323
                                            </a>
                                        </h6>
                                        <p>Reservation & Hotel Service</p>
                                    </div>
                                    <div class="info_item">
                                        <i class="lnr lnr-envelope"></i>
                                        <h6>
                                            <a href="mailto:reservations@darasamui.com">
                                                reservations@darasamui.com
                                            </a>
                                        </h6>
                                        <p>Send us your query anytime!</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact Form -->
                            <div class="col-md-9">
                                <form class="row contact_form" action="contact_process.php" method="post"
                                    id="contactForm" novalidate="novalidate">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter your name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Enter email address">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="subject" name="subject"
                                                placeholder="Enter Subject">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="1"
                                                placeholder="Enter Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" value="submit" class="btn theme_btn button_hover">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!--================Contact Area =================-->

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
