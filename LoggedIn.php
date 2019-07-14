<!DOCTYPE html>

<?php

  session_start();
  include_once 'dbconnect.php';

  if(!isset($_SESSION['weather']) ){
    header("location: index.php");
    exit;
  }
  else{
    $usrid=$_SESSION['weather'];
  }

  $res1=mysqli_query($conn,"SELECT accpic FROM profile WHERE usrid='$usrid'");
  $row1=mysqli_fetch_array($res1);
  $filenamee=$row1['accpic'];

?>

<html>

<head>

  <title>Weather Report</title>
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
		background:  linear-gradient(to right, #00F260, #0575E6);
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
      background: #ff6600 !important;
    }

    @media (max-width: 767.98px) {
      .yoh{
        width: 90%;
      }
    }
  </style>	  
	  
</head>

<body>
  <?php include 'nav.php';
  ?>

   <div class="bg jumbotron" id="acnt" style="border-radius: 0; margin: 0;">
    <div class="mx-0 my-0">
    <center>
    <h2 class="text-white">Enter City and Country Code</h2>
    <br><br>
	  <form method="GET" action="get_prediction.php" autocomplete="off" class="yoh form my-2 my-lg-0" >
    <div class="form-group">
    <label for="exampleInputEmail1" style="color:#fff;">For Example, Delhi, IN</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Location" name="q">
    </div>
    <br>
    <button class="btn btn-outline-light ml-0" type="submit" name="action" style="border-radius: 50px;">Get Prediction</button>
    </form>
    </center>
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

  <!--change password-->
  <?php include 'pass_change.php';
  ?>

<!--delete account-->
  <?php include 'del_modal.php';
  ?>

  <?php include 'footer.php';
  ?>
  

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="js/bootstrap.js"></script>

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
