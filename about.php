<!DOCTYPE html>

<?php

session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['weather'])){
  $page="LoggedIn.php";
}
else if(isset($_SESSION['weather_ad'])){
  $page="admin/AdIn.php";
}
else{
  $page="Index.php";
}

?>

<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
  <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  
  <style>
	  body, html {
	    height: 100%;
		margin: 0;
		overflow-x: hidden;
		scroll-behavior: smooth;
    background:  linear-gradient(to right, #ccc, #ddd, #fff, #ddd);
	  }

	  .nv :hover, .nv :focus{
		color: #ff6600;
	  }

	  .nav-link{
	  	color: #888;
	  }
  </style>	  
	  
</head>

<body>
  <nav style="background: #455668;">
    <div class="nav justify-content-end mb-2 mr-2 mr-sm-3">
    <!--<img src="">-->
	<span class="text-white-50"><a class="text-white-50" href="#!"></a></span>
	</div>
	<div class="w-100 justify-content-sm-left nav" style="background: #eee;" id="navbarSupportedContent">
	  <div style="background:white; height: 100px; width: 100px; margin: 10px;"><img src="imgs/logo.jpg" height="100px" width="100px"></div>
	  <div class="ml-2">
	  <div class="row align-items-start">
	  <div class="col" style="background: #eee; margin-left: 15px !important; margin-top: 15px !important; padding-left: 0 !important;">
	    <h2 class="text-dark text-left" style="margin-right: auto;">Company</h2>
	  </div>
	  </div>
	  <div class="row align-items-start" style="margin-top: 10px;">
	  <div class="col"  style="margin-left: 0 !important;">
      <ul class="nav justify-content-left"  style="margin-left: -15px !important; padding-left: 0 !important;">
		<li class="nav-item nv">
          <a class="nav-link" href="<?php echo $page; ?>">HOME</a>
		</li>
		<li class="nav-item nv">
		  <a class="nav-link" style="color: #ff6600;">ABOUT</a>
		</li>
		<li class="nav-item nv">
		  <a class="nav-link" href="contact.php" target="blank">CONTACT US</a>
		</li>
	  </ul>
	  </div>
	  </div>
	  </div>
	</div>
  </nav>

  <div class="container my-5">
    <div class="row">
      <div class="col-md-6" style="text-align: center;">
        <img src="imgs/logo.jpg" height="270px" width="270px" style="margin: auto;">
      </div>
      <div class="spc"></div>
      <div class="col-md-6 mt-5" style="align-items: center;">
        <p>Comapany is designed to help the user get a weather forecast of a desired location. The forecast is available for upto 5 days of every three hours. All the user has to do is input a deisred location. We search for that location in an onlne and trusted database and give the user the option to choose a date and time. The weather data including temperature, clouds, humidity, winspeed and pressure ca be viewed for the given date and time. It is as simple as that.</p>
      </div>
    </div>
  </div>
  <br>


  <footer class="page-footer font-small pt-2" id="cnt" style="background-color: #455668;">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

      <!-- Footer links -->
      <div class="row text-center text-md-left mt-3 pb-3 align-items-center">
      	<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-0">
          <a href="<?php echo $page; ?>" style="color: #fff;">Home</a>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-0">
          <a href="about.php" style="color: #fff;">About</a>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-0">
          <a href="contact.php" target="blank" style="color: #fff;">Contact Us</a>
        </div>
      </div>
      <!-- Footer links -->

      <hr>

      <!-- Grid row -->
      <div class="row d-flex align-items-center">

        <!-- Grid column -->
        <div class="col-md-7 col-lg-8">

          <!--Copyright-->
          <p class="text-center text-md-left text-white">© 2019 Copyright:
            <a class="text-white" href="#!">
              <strong>BlackThunder Corp.</strong>
            </a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-5 col-lg-4 ml-lg-0">

          <!-- Social buttons -->
          <div class="text-center text-md-right">
            <ul class="list-unstyled list-inline">
              <li class="list-inline-item">
                <a href="https://www.facebook.com/ISTE.VIT/" target="blank" class="btn-floating btn rgba-white-slight mx-1">
                  <i class="fab fa-facebook fa-lg" style="color: #3B5998; background:#fff; width: 80%;"></i>
                </a>
              </li>
              <li class="list-inline-item" >
                <a href="https://www.instagram.com/iste_vit_vellore/" class="btn-floating btn rgba-white-slight mx-1">
                  <i class="fab fa-instagram fa-lg text-center" style="color: #fff; background: linear-gradient(60deg, #ffdc7d, #f46f30, #c32aa3, #7232bd);"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.linkedin.com/company/indian-society-for-technical-education/" target="blank" class="btn-floating btn rgba-white-slight mx-1">
                  <i class="fab fa-linkedin fa-lg" style="color: #0077B5; background:#fff; width: 80%;"></i>
                </a>
              </li>
            </ul>
          </div>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

  </footer>


  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="js/bootstrap.js"></script>

</body>

</html>