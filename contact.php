<!DOCTYPE html>

<?php 

session_start();
include_once 'dbconnect.php';

if(isset($_POST['contt']) ) {
		$error1 = false;

		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$fn = trim($_POST['fn']);
		$fn = strip_tags($fn);
		$fn = htmlspecialchars($fn);

		$ln = trim($_POST['ln']);
		$ln = strip_tags($ln);
		$ln = htmlspecialchars($ln);

		$text = mysqli_real_escape_string($conn, $_POST['queri']);

		if(empty($fn)){
			$error1 = true;
			$errMSG = "Please enter your first name.";
		}
		
		if(empty($email)){
			$error1 = true;
			$errMSG = "Please enter your email address.";
		}

		if(empty($text)){
			$error1 = true;
			$errMSG = "Please enter a query.";
		}

		if (!$error1) {
			mysqli_query($conn,"INSERT INTO contact VALUES('$email', '$fn', '$ln', '$text')");
			$errMSG1 = "Successfully submitted query.";
		}
	}

?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	
	<style>
	  body, html {
		height: 100%;
		margin: 0;
	  }

	  .bg {
		background-image: url("imgs/bck2.jpg");
		height: 100%; 
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		filter: blur(4px);
	  }
	
	  #centeredDiv1 {overflow: hidden; position: absolute; top: 10%; bottom: 10% !important; left: 10%; right: 10%; box-shadow: 3px 3px 6px 3px rgba(0, 0, 0, 0.7); border-radius: 2%; z-index: 999; background-color: rgba(0, 0, 0, 0.5);}
	  #ins1 {overflow-x: hidden; overflow-y: scroll; position: absolute; top: 2%; bottom: 2% !important; left: 5%; right: 5%; background-color: transparent;
	        -ms-overflow-style: none;
            overflow: -moz-scrollbars-none;
	  }
	  #ins1::-webkit-scrollbar { 
            display: none;
      }
	  
	  @media (min-width: 576px){
		  #centeredDiv1 {left: 25%; right: 25%;}
		  #ins1 {left: 2%; right: 2%;}
	  }
	</style>
</head>

<body>

  <div  class ="bg">
  </div>
  <div id="centeredDiv1">
    <div id="ins1" class="yohoho">
	<div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle" style="color: #eee;">Contact Us</h5>
	</div>
	<div>
	<div>
	<?php if (isset($errMSG)){?><span style="color: red;"><?php echo $errMSG;}?></span>
	<?php if (isset($errMSG1)){?><span style="color: green;"><?php echo $errMSG1;}?></span>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="form  my-3 mr-2 ml-2">
	  <div class="form-row">
	  <div class="form-group col-sm">
		<label for="exampleInputEmail1"  style="color:#fff;">Enter Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1" name="fn" aria-describedby="emailHelp" placeholder="First">
	  </div>
	  <div class="form-group col-sm">
		<label class="sm-lbl" for="exampleInputEmail1" style="color:rgba(0, 0, 0, 0); visibility:hidden;">Enter Name</label>
		<input type="text" class="form-control" id="exampleInputEmail1" name="ln" aria-describedby="emailHelp" placeholder="Last">
	  </div>
	  </div>
	  <div class="form-group">
		<label for="exampleInputEmail1" style="color:#fff;">Enter Email</label>
		<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Email">
	  </div>
	  <div class="form-group">
        <label for="exampleFormControlTextarea1" style="color:#fff;">Your Query or Question</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="queri"></textarea>
      </div>
      <br>
	  <div class="modal-footer">
		<button type="submit" name="contt" class="btn btn-outline-light ml-sm-2 mt-3 mb-0" style="border-radius: 50px; width:100%;">Submit Your Query</button>
	  </div>
	</form>
	</div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="js/bootstrap.js"></script>

</body>

</html>