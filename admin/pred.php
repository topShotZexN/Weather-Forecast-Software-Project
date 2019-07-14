<!DOCTYPE html>

<?php

  session_start();
  include_once '../dbconnect.php';

  if(!isset($_SESSION['weather_ad']) ){
    header("location: ad_login.php");
    exit;
  }
  else{
    $usrid=$_SESSION['weather_ad'];
  }

  $res1=mysqli_query($conn,"SELECT accpic FROM profile WHERE usrid='$usrid'");
  $row1=mysqli_fetch_array($res1);
  $filenamee=$row1['accpic'];

    if( isset($_POST['changepw']) ) {
    
    $error = false;
    
    $usrid = trim($_POST['usrid']);
    $usrid = strip_tags($usrid);
    $usrid = htmlspecialchars($usrid);

    $passo = trim($_POST['passo']);
    $passo = strip_tags($passo);
    $passo = htmlspecialchars($passo);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    
    $pass1 = trim($_POST['pass1']);
    $pass1 = strip_tags($pass1);
    $pass1 = htmlspecialchars($pass1);
    
    if(empty($usrid)){
      $error = true;
      $errMSG2 = "Please enter your id.";
    }

    if(empty($passo)){
      $error = true;
      $errMSG2 = "Please enter your old password.";
    }
    
    if (empty($pass)){
      $error = true;
      $errMSG2 = "Please enter password.";
    } else if(strlen($pass) < 6) {
      $error = true;
      $errMSG2 = "Password must have atleast 6 characters.";
    } else if(strcmp($pass,$pass1)!=0){
      $error = true;
      $errMSG2 = "Passwords did not match.";
    }

    $passo=hash('sha256', $passo);
    $pass=hash('sha256', $pass);
    
    
    if (!$error) {

      $res2=mysqli_query($conn,"SELECT password FROM admin WHERE adid='$usrid'");
      $row2=mysqli_fetch_array($res2);
      $count = mysqli_num_rows($res2); // if uname/pass correct it returns must be 1 row

      if( $count == 1 && $row2['password']==$passo ) {
        $res3=mysqli_query($conn, "UPDATE admin SET password = '$pass' WHERE adid='$usrid'");
        if ($res3){
          $errTyp = "success";
          $errMSG2 = "Successfully changed password";
          //echo "<meta http-equiv='refresh' content='0'>";
        }
        else{
          $errTyp = "danger";
          $errMSG2 = "Something went wrong, try again later...";
        }
      } else {
        $errMSG2 = "Incorrect Credentials, Try again...";
      }

    }
  }

?>

<html>

<head>

  <title>Weather Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
  <link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
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
		background:  linear-gradient(to right, #FC5C7D, #6A82FB);
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

    .yoh{
        width: 45%;
    }

    .ddp :focus, .ddp:active{
      background: #FC5C7D !important;
    }

    @media (max-width: 767.98px) {
      .yoh{
        width: 90%;
      }
    }
  </style>	  
	  
</head>

<body>
  <nav style="background: #455668;">
    <div class="nav justify-content-end mb-2 mr-2 mr-sm-3">
    <!--<img src="">-->
  <span class="text-white-50 text-right align-bottom"><img src="submissions/<?php echo $usrid."/".$filenamee ?>" height="20px" width="20px" style="border-radius: 50%;">&ensp;</span>
  <!--dropdown menu-->
  <div class="dropdown">
  <a class="dropdown-toggle text-white-50 text-right " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item ddp" href="#chngdp" data-toggle="modal">Change Profile Picture</a>
    <a class="dropdown-item ddp" href="#Modal3" data-toggle="modal">Change Password</a>
    <a class="dropdown-item ddp" href="ad_logout.php">Logout</a>
  </div>
  </div>
	</div>

	<div class="w-100 justify-content-sm-left nav" style="background: #eee;" id="navbarSupportedContent">
	  <div style="background:white; height: 100px; width: 100px; margin: 10px;"><img src="../imgs/logo.jpg" height="100px" width="100px"></div>
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
      <a style="color: #ff6600;" class="nav-link" href="AdIn.php">HOME</a>
		</li>
		<li class="nav-item nv">
		  <a class="nav-link" href="../about.php">ABOUT</a>
		</li>
		<li class="nav-item nv">
		  <a class="nav-link" href="../contact.php" target="blank">CONTACT US</a>
		</li>
	  </ul>
	  </div>
	  </div>
	  </div>
	</div>
  </nav>

   <div class="bg jumbotron" id="acnt" style="border-radius: 0; margin: 0;">
    <div class="mx-0 my-0">
    <center>
    <h2 class="text-white">Enter City and Country Code</h2>
    <br><br>
	  <form method="GET" action="ad_get_pred.php" autocomplete="off" class="yoh form my-2 my-lg-0" >
    <div class="form-group">
    <label for="exampleInputEmail1" style="color:#fff;">For Example, Delhi, IN</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Location" name="q">
    </div>
    <br>
    <button class="btn btn-outline-light ml-0" type="submit" name="action" style="border-radius: 50px;">Get Prediction</button>
    </form>
    </center>
	<!--<br><br>
	<a href="#" class="text-white" data-toggle="modal" data-target="#pl">Problem logging in?</a>-->
	<br><br>
	<!--<a href="#" class="text-white" data-toggle="modal" data-target="#fp">Forgot Password?</a>-->
    </div>
  </div>

  <!--change password-->
<div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalCenterTitle text-light">Change Password</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form my-2 my-lg-0" >
      <div class="modal-body">
     <?php
    if(isset($errMSG2)){
    ?>
    <div><span style="color: red;"><?php echo $errMSG2; ?></span></div>
    <?php } ?>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ID" name="usrid">
    </div>
      <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter old password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Old Password" name="passo">
    </div>
      <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter new password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="New Password" name="pass">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Confirm new password</label>
    <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Confirm new Password" name="pass1">
    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" aria-label="submit" type="submit" name="changepw">Change</button>
      </div>
    </form>
    </div>
  </div>
  </div>

<!--Change dp-->
<div class="modal fade" id="chngdp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="submit_ad.php?id=<?php echo $usrid;?>" enctype="multipart/form-data">
          <input name="upload[]" type="file" accept="image/*" />
      </div>
      <div class="modal-footer">
      <button type="submit" name="dpchn" class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" aria-label="submit">Upload</button>
        </form>
      </div>
    </div>
    </div>
  </div>  

<!--delete account
  <?php include 'del_modal.php';
  ?>-->

 <footer class="page-footer font-small pt-2" id="cnt" style="background-color: #455668;">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

      <!-- Footer links -->
      <div class="row text-center text-md-left mt-3 pb-3 align-items-center">
      	<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-0">
          <a href="ad_logout.php" style="color: #fff;">Logout</a>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-0">
          <a href="../about.php" style="color: #fff;">About</a>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-0">
          <a href="../contact.php" target="blank" style="color: #fff;">Contact Us</a>
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
  <script src="../js/bootstrap.js"></script>

  <script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
  </script>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>

</body>

</html>
