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
                        <li class="nav-item active"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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
            <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="page-cover text-center">
                    <h2 class="page-cover-tittle">Gallery</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Gallery</li>
                    </ol>
                </div>
            </div>
        </section>
        <!--================Breadcrumb Area =================-->
        
        <!--================ Gallery Area =================-->
        <section class="gallery_area section_gap">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">MTF INN Visual Showcase</h2>
                    <p>Take a visual tour of our premium room suites, fine interiors, and luxury resort facilities.</p>
                </div>
                
                <!-- UNIFIED SINGLE ROW GRID WRAPPER (Fixes the overlapping container crash) -->
                <div class="row imageGallery1" id="gallery">
                    <!-- Image 1 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/1.png" class="img-fluid" alt="Luxury Room">
                            <div class="hover">
                                <a class="light" href="image/gallery/1.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 2 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/2.png" class="img-fluid" alt="Premium Suite">
                            <div class="hover">
                                <a class="light" href="image/gallery/2.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 3 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/13.png" class="img-fluid" alt="Lounge Area">
                            <div class="hover">
                                <a class="light" href="image/gallery/13.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 4 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/4.png" class="img-fluid" alt="Deluxe Room">
                            <div class="hover">
                                <a class="light" href="image/gallery/4.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 5 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/15.png" class="img-fluid" alt="Hotel Amenities">
                            <div class="hover">
                                <a class="light" href="image/gallery/15.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 6 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/6.png" class="img-fluid" alt="Executive Room">
                            <div class="hover">
                                <a class="light" href="image/gallery/6.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 7 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/17.png" class="img-fluid" alt="Resort View">
                            <div class="hover">
                                <a class="light" href="image/gallery/17.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 8 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/8.png" class="img-fluid" alt="Dining Hall">
                            <div class="hover">
                                <a class="light" href="image/gallery/8.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 9 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/19.png" class="img-fluid" alt="Interior Space">
                            <div class="hover">
                                <a class="light" href="image/gallery/19.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 10 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/10.png" class="img-fluid" alt="Comfort Suite">
                            <div class="hover">
                                <a class="light" href="image/gallery/10.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 11 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/11.png" class="img-fluid" alt="Luxury Hall">
                            <div class="hover">
                                <a class="light" href="image/gallery/11.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 12 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/12.png" class="img-fluid" alt="Suite Balcony">
                            <div class="hover">
                                <a class="light" href="image/gallery/12.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 13 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/3.png" class="img-fluid" alt="Bed Design">
                            <div class="hover">
                                <a class="light" href="image/gallery/3.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 14 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/14.png" class="img-fluid" alt="Premium Space">
                            <div class="hover">
                                <a class="light" href="image/gallery/14.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 15 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/5.png" class="img-fluid" alt="Cozy Interior">
                            <div class="hover">
                                <a class="light" href="image/gallery/5.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Image 16 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/16.png" class="img-fluid" alt="Reception Hall">
                            <div class="hover">
                                <a class="light" href="image/gallery/16.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>
                                        <!-- Image 17 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/7.png" class="img-fluid" alt="Exquisite Bar">
                            <div class="hover">
                                <a class="light" href="image/gallery/7.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Image 18 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/18.png" class="img-fluid" alt="Lounge Interior">
                            <div class="hover">
                                <a class="light" href="image/gallery/18.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Image 19 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/9.png" class="img-fluid" alt="Deluxe Bathroom">
                            <div class="hover">
                                <a class="light" href="image/gallery/9.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Image 20 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/20.png" class="img-fluid" alt="Hotel Balcony">
                            <div class="hover">
                                <a class="light" href="image/gallery/20.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Image 21 -->
                    <div class="col-md-4 col-sm-6 gallery_item mb-4">
                        <div class="gallery_img">
                            <img src="image/gallery/21.png" class="img-fluid" alt="Luxury Hallway">
                            <div class="hover">
                                <a class="light" href="image/gallery/21.png"><i class="fa fa-expand"></i></a>
                            </div>
                        </div>
                    </div>

                </div> <!-- Closes the unified master row grid perfectly -->
            </div>
        </section>
        <!--================ Gallery Area End =================-->

        
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
    <script src="jquery-3.7.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope-min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
