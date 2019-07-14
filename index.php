<!DOCTYPE html>

<?php

  session_start();
  include_once 'dbconnect.php';

  $error = false;

  if( isset($_POST['submit']) ) {
    
    $error = false;

    $usrid = trim($_POST['usrid']);
    $usrid = strip_tags($usrid);
    $usrid = htmlspecialchars($usrid);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    if(empty($pass)){
      $error = true;
      $errMSG1 = "Please enter your password.";
    }
    else{
      $pass = hash('sha256', $pass); 
    }
    
    if(empty($usrid)){
      $error = true;
      $errMSG1 = "Please enter your user id address.";
    } 
    
    if (!$error) {

      $res=mysqli_query($conn,"SELECT usrid, password FROM login WHERE usrid='$usrid'");
      $row=mysqli_fetch_array($res);
      $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
      $resb=mysqli_query($conn,"SELECT block FROM blocked WHERE usrid='$usrid'");
      $rowb=mysqli_fetch_array($resb);

      if( $count == 1 && $row['password']==$pass && $rowb['block']==0) {
        $_SESSION['weather'] = $row['usrid'];
        header("Location: LoggedIn.php");
      } else {
        $errMSG1 = "Incorrect Credentials, Try again...";
        //echo $res;
      }

    }
  }


  if ( isset($_POST['action']) ) {

    // clean user inputs to prevent sql injections
    $f_name = trim($_POST['f_name']);
    $f_name = strip_tags($f_name);
    $f_name = htmlspecialchars($f_name);

    $l_name = trim($_POST['l_name']);
    $l_name = strip_tags($l_name);
    $l_name = htmlspecialchars($l_name);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    
    $pass1 = trim($_POST['pass1']);
    $pass1 = strip_tags($pass1);
    $pass1 = htmlspecialchars($pass1);

    $usrid = trim($_POST['usrid']);
    $usrid = strip_tags($usrid);
    $usrid = htmlspecialchars($usrid);

    $pur = trim($_POST['pur']);
    $pur = strip_tags($pur);
    $pur = htmlspecialchars($pur);
    
    $name= $f_name." ".$l_name;
    // basic name validation
    if (empty($f_name)or(empty($l_name))) {
      $error = true;
      $errMSG5 = "Please enter your full name.";
    } else if (strlen($name) < 3) {
      $error = true;
      $errMSG5 = "Name must have atleat 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
      $error = true;
      $errMSG5 = "Name must contain alphabets and space.";
    }

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL)or empty($email )) {
      $error = true;
      $errMSG5 = "Please enter valid email address.";
    } else {
      // check email exist or not
      $query = "SELECT email FROM login WHERE email='$email'";
      $result = mysqli_query($conn,$query);
      $count = mysqli_num_rows($result);
      if($count!=0){
        $error = true;
        $errMSG5 = "Provided Email is already in use.";
      }
    }
    // password validation
    if (empty($pass)){
      $error = true;
      $errMSG = "Please enter password.";
    } else if(strlen($pass) < 6) {
      $error = true;
      $errMSG = "Password must have atleast 6 characters.";
    } else if(strcmp($pass,$pass1)!=0){
      $error = true;
      $errMSG = "Passwords did not match.";
    }

    // password encrypt using SHA256();
    $password = hash('sha256', $pass);

    if(empty($pur)){
    $error = true;
    $errMSG5 = "Please enter a purpose of use."; 
    }
    if(empty($usrid)){
    $error = true;
    $errMSG5 = "Please enter User ID."; 
    }


    // if there's no error, continue to signup
    if( !$error ) {

      $query = "INSERT INTO login(usrid, password, email, fname, lname, purpose) VALUES('$usrid', '$password', '$email', '$f_name','$l_name','$pur')";
      $queryb = "INSERT INTO blocked(usrid) VALUES('$usrid')";
      $res = mysqli_query($conn,$query);
      $resb = mysqli_query($conn,$queryb);

      if ($res) {
        $errTyp = "success";
        $errMSG5 = "Successfully registered, you may login now";
        unset($f_name);
        unset($l_name);
        unset($email);
        unset($password);
        unset($pass);
        unset($usrid);
        unset($pur);
        header("Location: index.php");
      } else {
        $errTyp = "danger";
        $errMSG5 = "Something went wrong, try again later...";
      }

    }


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
	  }

	  .bg {
		background:  linear-gradient(to right, rgba(255,158,57,1) 0%, rgba(255,227,155,1) 65%, rgba(91,108,132,1) 51%, rgba(19,43,78,1) 100%);
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
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
	
  <span class="text-white-50 text-right align-bottom"><a class="text-white-50" href="#!" data-toggle="modal" data-target="#creat">Create Account</a></span>
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
		<li class="nav-item nv actt">
          <a style="color: #ff6600;" class="nav-link">HOME</a>
		</li>
		<li class="nav-item nv">
		  <a class="nav-link" href="about.php">ABOUT</a>
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

   <div class="bg jumbotron" id="acnt" style="border-radius: 0; margin: 0;">
    <div class="mx-5 my-2">
    <h6 class="text-white">JOIN IN<h6>
	<h1 class="text-white">Quick Predictions at Your Fingertips<h1>
	<br>
	<h4 class="text-white">To join, enter your User ID and <br> password.</h4>
	<br><br><br><br>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form-inline">
	  <div class="form-group mr-sm-3 mb-2">
        <label for="inputusrid" class="sr-only">User ID</label>
        <input type="text" style="border-radius: 0;" class="form-control-lg form-control" id="inputusrid" placeholder="Enter user id" name="usrid">
      </div>
	  <div class="form-group mr-sm-2 mb-2">
        <label for="inputApplication" class="sr-only">Password</label>
        <input type="password" style="border-radius: 0;" class="form-control-lg form-control" id="inputApplication" placeholder="Password" name="pass">
      </div>
	  <button type="submit" id="usr" class="btn btn-outline-light ml-sm-2 mb-2" style="border-radius: 50px" name="submit">&emsp;&emsp;Join &emsp;&emsp;</button>
	</form>
	<?php
		if(isset($errMSG1)){
		?>
		<div><span style="color: red;"><?php echo $errMSG1; ?></span></div>
	  <?php } ?>
	<!--<br><br>
	<a href="#" class="text-white" data-toggle="modal" data-target="#pl">Problem logging in?</a>-->
	<br><br>
	<!--<a href="#" class="text-white" data-toggle="modal" data-target="#fp">Forgot Password?</a>-->
    </div>
  </div>

<!--Create Modal-->
<div class="modal fade" id="creat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalCenterTitle">Create Account</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form my-2 my-lg-0" >
      <div class="modal-body">
     <?php
    if(isset($errMSG5)){
    ?>
    <div><span style="color: red;"><?php echo $errMSG5;?></span></div>
    <?php } ?>
    <div class="form-row">
    <div class="form-group col-sm">
    <label for="exampleInputEmail1" style="color:#fff;">Enter Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First" name="f_name">
    </div>
    <div class="form-group col-sm">
    <label class="sm-lbl text-dark" for="exampleInputEmail1">Enter Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last" name="l_name">
    </div>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color:#fff;">Enter User ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User ID" name="usrid">
    </div>
      <div class="form-group">
    <label for="exampleInputEmail1" style="color:#fff;">Enter email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" name="email">
    </div>
      <div class="form-group">
    <label for="exampleInputEmail1" style="color:#fff;">Enter password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="pass">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color:#fff;">Confirm password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password" name="pass1">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color:#fff;">Enter Purpose of use</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Purpose" name="pur">
    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-light ml-sm-2" type="submit" name="action">Create Account</button>
      </div>
    </form>
    </div>
  </div>
</div>


  <footer class="page-footer font-small pt-2" id="cnt" style="background-color: #455668;">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

      <!-- Footer links -->
      <div class="row text-center text-md-left mt-3 pb-3 align-items-center">
      	<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-0">
          <a href="!#" data-toggle="modal" data-target="#creat" style="color: #fff;">Create Account</a>
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
