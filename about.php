<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: index.php");
	}

	$con = mysqli_connect('localhost','root','','grihini');
    
    if(isset($_SESSION['order_cart']))
	{
        $cartCount = count($_SESSION['order_cart']);

	}
	else
	{
		$cartCount = 0;
	}

    if(isset($_SESSION['user_name']))
    {
        $consumer_name = $_SESSION['user_name'];
         $q1 = "SELECT * FROM notifications WHERE consumer_user_name='$consumer_name' AND user='consumer'";
        $q2 = "SELECT * FROM notifications WHERE consumer_user_name='$consumer_name' AND user='consumer' AND read_n=1";
        $data = mysqli_query($con,$q1);
        $new_data = mysqli_query($con,$q2);
        $count = mysqli_num_rows($new_data);
    }
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>About</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
	<header class="header-area header-area2">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="index.php"><img src="assets/images/logo/grihini.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>  
                    <div class="main-menu main-menu2">
                        <ul>
                            <li class="active"><a href="index.php">home</a></li>
                            <li><a href="about.php">about</a></li>
                            <li><a href="menu.php">menu</a></li>
                            <li><a href="contact-us.php">contact</a></li>
                            <li>
                                <?php if (isset($_SESSION['user_name'])) {?>
							        <a id="user-name" href="#"> <strong style="color:green;"><?php echo $_SESSION['user_name']; ?></strong>  <i class="fas fa-user-circle"></i> </a>
							        <ul class="sub-menu">
                                        <li><a href="#">My Profile</a></li>
                                        <li><a href="index.php?logout='1'">Logout</a></li>
                                    </ul>

                                    <li class="dropdown">       
                                
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 5px;">
                                <i class="far fa-bell"></i><?php 
                                if($count > 0)
                                {   
                                    echo "(".$count.")";
                                }; ?>
                                </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 350px;">
                                    <?php
                                        foreach ($data as $value) {
                                    ?>

                                    <?php
                                        if($value['read_n']=='1'){
                                    ?>  <ul>
                                            <li style="font-weight: bold;"><?php echo $value['cook_user_name'].' '.$value['notification_details']; ?></li>
                                        </ul>
                                    <?php       
                                        }
                                        else
                                        {
                                    ?>
                                            <ul>
                                                <li><?php echo $value['cook_user_name'].' '.$value['notification_details']; ?>
                                                </li>
                                            </ul>

                                    <?php
                                        }
                                        }
                                    ?>
                                  </div>
                                
                             </li>
						        <?php }else{ ?>
                                    <a href="login.php">login / register</a>
                                    <ul class="sub-menu">
                                        <li><a href="login.php">Customer</a></li>
                                        <li><a href="cook_login.php">Cook</a></li>
                                    </ul>
                                    <?php }?>
                            </li>
                            <li><a href="cart.php"><i class="fas fa-cart-plus"></i> My Cart(<?php echo $cartCount; ?>) - ৳ <?php 
                                if(isset($_SESSION['total_cost']))
                                {
                                    echo number_format($_SESSION['total_cost'], 2);
                                }
                                else
                                {
                                    echo number_format(0,2);
                                }
                                ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i>About Us</i></h1>
                    <p class="pt-2"><i>we are providing our information to our customers</i></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Welcome Area Starts -->
    <section class="welcome-area section-padding2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <div class="welcome-img">
                        <img src="assets/images/welcome-bg.png" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="welcome-text mt-5 mt-md-0">
                        <h3><span class="style-change">welcome</span> <br>to grihini</h3>
                        <p class="pt-3"> grihini is a food delivery system of bangladesh. we have started our journey through this site from 2018. now our present user is 5000+ . we are 24/7 open. we deliver our food though our delivery team. anyone from bangladesh can get our service.</p>
                        
                        <a href="menu.php" class="template-btn mt-3">order now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome Area End -->
    
    <!-- Deshes Area Starts -->
    <div class="deshes-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top2 text-center">
                        <h3>Our <span>special</span> deshes</h3>
                        <p><i>Some of our special deshes are given below </i></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-6 align-self-center">
                    <h1>01.</h1>
                    <div class="deshes-text">
                        <h3><span>Garlic</span><br> green beans</h3>
                        <p class="pt-3"> Garlic green beans is our top special item. it's very much spicy and delicious food.we are using chicken, bread crumbs, onions, eggs, garlic, salt and ground black pepper, olive oil to make this Garlic green beans.</p>
                        <span class="style-change">৳ 120</span>
                        <a href="#" class="template-btn3 mt-3">order proposal <span><i class="fa fa-long-arrow-right"></i></span></a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center mt-4 mt-md-0">
                    <img src="assets/images/deshes1.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-5 col-md-6 align-self-center order-2 order-md-1 mt-4 mt-md-0">
                    <img src="assets/images/deshes2.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 offset-lg-2 col-md-6 align-self-center order-1 order-md-2">
                    <h1>02.</h1>
                    <div class="deshes-text">
                        <h3><span>Lemon</span><br> rosemary chicken</h3>
                        <p class="pt-3"> .</p>
                        <span class="style-change">৳ 200</span> 
                        <a href="#" class="template-btn3 mt-3">Lemon rosemary chicken is a top rated item in this site.this is a alltime selling item of us. we are using curcuma, garlic, chilis, deshi chicken, soybean oil, solts to make this lemon rosmery chicken.<span><i class="fa fa-long-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deshes Area End -->

    <!-- Testimonial Area Starts -->
     <section class="testimonial-area section-padding4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-top2 text-center">
                        <h3>Customer <span>says</span></h3>
                        <p><i>our customers are commenting on us</i></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-slider owl-carousel">
                        <div class="single-slide d-sm-flex">
                            <div class="customer-img mr-4 mb-4 mb-sm-0">
                                <img src="assets/images/tushar.jpg" alt="">
                            </div>
                            <div class="customer-text">
                                <h5>Md tushar</h5>
                                <span><i>Customer from banani, dhaka</i></span>
                                <p class="pt-3">Very good and timely service..i want to give 5 out of 5 rating to this site. thank you grihini.</p>
                            </div>
                        </div>
                        <div class="single-slide d-sm-flex">
                            <div class="customer-img mr-4 mb-4 mb-sm-0">
                                <img src="assets/images/jiku.jpg" alt="">
                            </div>
                            <div class="customer-text">
                                <h5>Jiku mollick</h5>
                                <span><i>Customer from rangamati, chittagong</i></span>
                                <p class="pt-3"> Very first service and food quality is good to. i wnat to give 4.8 out of 5 to this site.</p>
                            </div>
                        </div>
                        <div class="single-slide d-sm-flex">
                            <div class="customer-img mr-4 mb-4 mb-sm-0">
                                <img src="assets/images/joy.jpg" alt="">
                            </div>
                            <div class="customer-text">
                                <h5>Ahnaf sahriar chowdhury</h5>
                                <span><i>Customer from durgapur, Mymensing</i></span>
                                <p class="pt-3">In the end there is a good site in market to produce good quality food. thank you very much grihini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Area End -->

    <!-- Footer Area Starts -->
    <footer class="footer-area">
        <div class="footer-widget section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-widget single-widget1">
                            <a href="index.html"><img src="assets/images/logo/grihini.png" alt=""></a>
                            <p class="mt-3">Which morning fourth great won't is to fly bearing man. Called unto shall seed, deep, herb set seed land divide after over first creeping. First creature set upon stars deep male gathered said she'd an image spirit our</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-widget single-widget2 my-5 my-md-0">
                            <h5 class="mb-4">contact us</h5>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="info-text">
                                    <p>United city, Badda </p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="info-text">
                                    <p>+8801770353601</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="info-text">
                                    <p>support@grihini.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="social-icons">
                            <ul>
                                <li class="no-margin">Follow Us</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- Javascript -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="assets/js/vendor/bootstrap-4.1.3.min.js"></script>
    <script src="assets/js/vendor/wow.min.js"></script>
    <script src="assets/js/vendor/owl-carousel.min.js"></script>
    <script src="assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
