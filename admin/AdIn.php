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

  if( isset($_POST['blck'])) {

    $error = false;
    
    $busrid = trim($_POST['busrid']);
    $busrid = strip_tags($busrid);
    $busrid = htmlspecialchars($busrid);

    $res4=mysqli_query($conn,"SELECT usrid, block FROM blocked WHERE usrid='$busrid'");
    $row4=mysqli_fetch_array($res4);
    if ($row4['block']==0){
      mysqli_query($conn,"UPDATE blocked SET block=1 where usrid='$busrid'");
      $errTyp = "success";
      $errMSG3 = "Successfully blocked user";
    }
    else if ($row4['block']==1){
      mysqli_query($conn,"UPDATE blocked SET block=0 where usrid='$busrid'");
      $errTyp = "success";
      $errMSG3 = "Successfully unblocked user";
    }
    else{
      $errTyp = "danger";
      $errMSG3 = "Something went wrong, try again later...";
    }
  }

  if( isset($_POST['deld'])) {

    $error = false;
    
    $locc = trim($_POST['locc']);
    $locc = strip_tags($locc);
    $locc = htmlspecialchars($locc);

    $dat_tim = trim($_POST['dat_time']);
    $dat_tim = strip_tags($dat_tim);
    $dat_tim = htmlspecialchars($dat_tim);

    if(empty($locc)){
      $error = true;
      $errMSG4 = "Please enter a location.";
    }
    if(empty($dat_tim)){
      $error = true;
      $errMSG4 = "Please enter date & time.";
    }

    $res=mysqli_query($conn,"SELECT location, date_time  FROM wdata WHERE location='$locc' AND date_time='$dat_tim'");
    $row=mysqli_fetch_array($res);

    if (!empty($row)){
      mysqli_query($conn,"DELETE FROM wdata WHERE location='$locc' AND date_time='$dat_tim'");
      $errTyp = "success";
      $errMSG4 = "Successfully deleted data";
    }
    else{
      $errTyp = "danger";
      $errMSG4 = "Data for this location and time does not exist.";
    }
  }

  if( isset($_POST['inmod'])) {

    $error = false;
    
    $locat = trim($_POST['locat']);
    $locat = strip_tags($locat);
    $locat = htmlspecialchars($locat);

    $dattime = trim($_POST['dattime']);
    $dattime = strip_tags($dattime);
    $dattime = htmlspecialchars($dattime);

    $temp = trim($_POST['temp']);
    $temp = strip_tags($temp);
    $temp = htmlspecialchars($temp);

    $cloud = trim($_POST['cloud']);
    $cloud = strip_tags($cloud);
    $cloud = htmlspecialchars($cloud);

    $hum = trim($_POST['hum']);
    $hum = strip_tags($hum);
    $hum = htmlspecialchars($hum);

    $wind = trim($_POST['wind']);
    $wind = strip_tags($wind);
    $wind = htmlspecialchars($wind);

    $pres = trim($_POST['pres']);
    $pres = strip_tags($pres);
    $pres = htmlspecialchars($pres);

    if(empty($locat)){
      $error = true;
      $errMSG5 = "Please enter a location.";
    }
    if(empty($dattime)){
      $error = true;
      $errMSG5 = "Please enter date & time.";
    }

    $res=mysqli_query($conn,"SELECT location, date_time  FROM wdata WHERE location='$locat' AND date_time='$dattime'");
    $row=mysqli_fetch_array($res);

    if (!empty($row) && !$error){
      $ress=mysqli_query($conn,"UPDATE wdata SET temp='$temp', clouds='$cloud', humidity='$hum', wind='$wind', pressure='$pres' WHERE location='$locat' AND date_time='$dattime'");
      if ($ress){
        $errTyp = "success";
        $errMSG5 = "Successfully modified data";
      }
      else{
        $errMSG5 = "Something went wrong... Try again later.";
      }
    }
    else if (!$error){
      $ress=mysqli_query($conn,"INSERT INTO wdata(location, date_time, temp, clouds, humidity, wind, pressure) VALUES('$locat', '$dattime', '$temp', '$cloud', '$hum', '$wind', '$pres')");
      if ($ress){
        $errTyp = "success";
        $errMSG5 = "Successfully inserted data";
      }
      else{
        $errMSG5 = "Something went wrong... Try again later.";
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
      <a style="color: #ff6600;" class="nav-link" href="LoggedIn.php">HOME</a>
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
    <div class="mx-5 my-3">
    <ul class="list-unstyled">
      <li>
        <a href="pred.php" class="text-light ml-2 aa">
          <span style="font-size: 25px;">Get Prediction&ensp;<i class="fa fa-chevron-right fa-lg text-center text-light" style="font-size: 22px;"></i></span>
        </a>
      </li>
      <br><br>
      <li>
        <a href="!#" class="text-light ml-2 aa" data-toggle="modal" data-target="#blkusr">
          <span style="font-size: 25px;">Block/Unblock User&ensp;<i class="fa fa-chevron-right fa-lg text-center text-light" style="font-size: 22px;"></i></span>
        </a>
      </li>
      <br><br>
      <li>
        <a href="#!" class="text-light ml-2 aa" data-toggle="modal" data-target="#insmod">
          <span style="font-size: 25px;">Insert/Update Data&ensp;<i class="fa fa-chevron-right fa-lg text-center text-light" style="font-size: 22px;"></i></span>
        </a>
      </li>
      <br><br>
      <li>
        <a href="#!" class="text-light ml-2 aa" data-toggle="modal" data-target="#deldata">
          <span style="font-size: 25px;">Delete Data&ensp;<i class="fa fa-chevron-right fa-lg text-center text-light" style="font-size: 22px;"></i></span>
        </a>
      </li>
    </ul>
  </div>
	<br><br>
	<!--<a href="#" class="text-white" data-toggle="modal" data-target="#fp">Forgot Password?</a>-->
    <!--</div>-->
  </div>


<!--block user-->
<div class="modal fade" id="blkusr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalCenterTitle text-light">Block/Unblock User</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form my-2 my-lg-0" >
      <div class="modal-body">
     <?php
    if(isset($errMSG3)){
    ?>
    <div><span style="color: red;"><?php echo $errMSG3; ?></span></div>
    <?php } ?>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter User ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User ID" name="busrid">
    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" aria-label="submit" type="submit" name="blck">Block</button>
        <button class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" aria-label="submit" type="submit" name="blck">Unblock</button>
      </div>
    </form>
    </div>
  </div>
  </div>

<!--change password-->
<div class="modal fade" id="insmod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalCenterTitle text-light">Insert/Modify Data</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form my-2 my-lg-0" >
      <div class="modal-body">
     <?php
    if(isset($errMSG5)){
    ?>
    <div><span style="color: red;"><?php echo $errMSG5; ?></span></div>
    <?php } ?>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Location</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Location" name="locat">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Date and Time</label>
    <input type="text" class="form-control" id="exampleInputEmail1" data-toggle="tooltip" title="In yyyy-mm-dd hr-min-sec format" aria-describedby="emailHelp" placeholder="Date-Time" name="dattime">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Temperature</label>
    <input type="number" step="0.001" min="0" class="form-control" id="exampleInputEmail1" data-toggle="tooltip" title="In &deg; C" aria-describedby="emailHelp" placeholder="Temperature" name="temp">
    </div>
      <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Cloud Percentage</label>
    <input type="number" step="0.001" min="0" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Cloud" name="cloud">
    </div>
      <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Humidity</label>
    <input type="number" step="0.001" class="form-control" id="exampleInputEmail1" data-toggle="tooltip" title="In percentage" aria-describedby="emailHelp" placeholder="Humidity" name="hum">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Windspeed</label>
    <input type="number" step="0.001" class="form-control" id="exampleInputEmail1" data-toggle="tooltip" title="In m/s" aria-describedby="emailHelp" placeholder="Windspeed" name="wind">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Pressure</label>
    <input type="number" step="0.001" class="form-control" id="exampleInputEmail1" data-toggle="tooltip" title="In hpa" aria-describedby="emailHelp" placeholder="Pressure" name="pres">
    </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" aria-label="submit" type="submit" name="inmod">Update</button>
      </div>
    </form>
    </div>
  </div>
  </div>

<!--delete data-->
<div class="modal fade" id="deldata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalCenterTitle text-light">Delete Weather Data</h5>
        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form my-2 my-lg-0" >
      <div class="modal-body">
     <?php
    if(isset($errMSG4)){
    ?>
    <div><span style="color: red;"><?php echo $errMSG4; ?></span></div>
    <?php } ?>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Location</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Location" name="locc">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1" style="color: #fff;">Enter Date and Time</label>
    <input type="text" class="form-control" id="exampleInputEmail1" data-toggle="tooltip" title="In yyyy-mm-dd hr-min-sec format" aria-describedby="emailHelp" placeholder="Date-Time" name="dat_time">
    </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" aria-label="submit" type="submit" name="deld">Delete</button>
    </div>
    </form>
    </div>
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
          <input class="text-white" name="upload[]" type="file" accept="image/*" />
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
