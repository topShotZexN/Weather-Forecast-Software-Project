<?php

  session_start();
  include_once 'dbconnect.php';

  $mysqli=$conn;

  if(isset($_SESSION['weather']))
  {
    $usrid=$_SESSION['weather'];
  }
  else
  { 
    header("location: index.php");
    exit;
  }

  $res=mysqli_query($conn,"SELECT usrid, fname, lname, email, purpose FROM login WHERE  usrid='$usrid'");
  $row=mysqli_fetch_array($res);
  $name=$row['fname']." ".$row['lname'];

  $email=$row['email'];

  $pur=$row['purpose'];

  $res1=mysqli_query($conn,"SELECT accpic FROM profile WHERE usrid='$usrid'");
  $row1=mysqli_fetch_array($res1);
  $filenamee=$row1['accpic'];

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

    .ddp :focus, .ddp:active{
      background: #ff6600 !important;
    }

    .yoh{
        width: 50%;
      }

    @media (max-width: 767.98px) {
      .yoh{
        width: 100%;
      }
    }
  </style>	  
	  
</head>

<body>
  <?php include 'nav.php';
  ?>

   <div class="bg jumbotron" id="acnt" style="border-radius: 0; margin: 0;">
    <div class="mx-5 my-2">
    
	    <div class="modal-body" style="width: 100%; margin: auto;">
        <div class="row align-items-center mb-0">
        <div class="col-md">
        <div class="d-flex justify-content-md-center mt-3">
        <img src="submissions/<?php echo $usrid."/".$filenamee ?>" height="150px" width="150px" style="border-radius: 50%;">
        </div>
        <br><br>
        <div class="d-flex justify-content-md-center">
        <a class="btn btn-outline-light ml-sm-2" style="border-radius: 50px;" data-toggle="modal" href="#chngdp">Change</a>
        </div>
        <br><br>
        </div>
        <!--<br><br>-->
        <div class="col-md">
        <div>
          <h5 class="text-light">User ID: <?php echo $usrid; ?></h5>
        </div>
        <br>
        <div>
          <h5 class="text-light">Name: <?php echo $name; ?></h5>
        </div>
        <br>
        <div>
          <h5 class="text-light">Email: <?php echo $email; ?></h5>
        </div>
        <br>
        <div>
          <h5 class="text-light">Purpose: <?php echo $pur; ?></h5>
        </div>
        <br>
        <!--<div>
          <a data-toggle="modal" href="#!" data-target="#Modal3"><h5 class="text-light">Change Password</h5>
        </div>-->
        </div>
        </div>
      </div>
	<!--<br><br>
	<a href="#" class="text-white" data-toggle="modal" data-target="#pl">Problem logging in?</a>-->
	<br><br>
	<!--<a href="#" class="text-white" data-toggle="modal" data-target="#fp">Forgot Password?</a>-->
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
        <form method="post" action="submit.php?id=<?php echo $usrid;?>" enctype="multipart/form-data">
          <input class="text-white" name="upload[]" type="file" accept="image/*" />
      </div>
      <div class="modal-footer">
      <button type="submit" name="dpchn" class="btn btn-outline-light ml-sm-2" style="border-radius: 50px" style="width:100%;" aria-label="submit">Upload</button>
        </form>
      </div>
    </div>
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
