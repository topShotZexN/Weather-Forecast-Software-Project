<!DOCTYPE html>

<?php

  session_start();
  include_once '../dbconnect.php';

  if(isset($_SESSION['weather_ad'])){
    $usrid=$_SESSION['weather_ad'];
  }
  else{
  	header("Location: ad_login.php");
    exit;
  }

  $res1=mysqli_query($conn,"SELECT accpic FROM profile WHERE usrid='$usrid'");
  $row1=mysqli_fetch_array($res1);
  $filenamee=$row1['accpic'];

?>

<html>
<head><title><?php echo $_GET['q']; ?></title>
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
</style>
</head>

<body>




<?php
error_reporting(0);
$get = json_decode(file_get_contents('http://ip-api.com/json/'),true);


date_default_timezone_set($get['timezone']);


$city = $_GET['q'];


$string = "http://api.openweathermap.org/data/2.5/forecast?q=".$city."&units=metric&appid=9d7b748ab7d47e8f73a824885e4e69d2";
$data = json_decode(file_get_contents($string),true);


 $country =  "<h1 class='text-white'>".$data['city']['name'].", ".$data['city']['country']."</h1>";
 
 

 
?>

<nav style="background: #455668;">
    <div class="nav justify-content-end mb-2 mr-2 mr-sm-3">
    <!--<img src="">-->
  <span class="text-white-50 text-right align-bottom"><img src="submissions/<?php echo $usrid."/".$filenamee ?>" height="20px" width="20px" style="border-radius: 50%;">&ensp;</span>
  <!--dropdown menu-->
  <span class="text-white-50 text-right align-bottom"><a href="ad_logout.php" class="text-white-50">Logout</a></span>
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
		  <a class="nav-link" href="#!">ABOUT</a>
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
			
				<?php 
				echo $country;
				?>
				<br><br>
				<center>
				<form method="GET" action="ad_get_pred.php" autocomplete="off" class="form my-2 my-lg-0" >
			      <div class="form-group my-3">
					<select name="Datte" class="form-control" style="width:15%;" data-toggle="tooltip" data-placement="top" title="Choose the Date and Time">
						<option selected>Choose...</option>
						<?php for ($num1 = 0; $num1 < sizeof($data['list']); $num1 += 1) {?>
						<option value="<?php echo $num1 ?>"><?php echo $data['list'][$num1]['dt_txt'] ?></option>
					    <?php } ?>
					</select>
				  </div>
				  <br>
					<input type="text" name="q" value="<?php echo $city ?>" style="display:none;">
					<button class="btn btn-outline-light ml-0" type="submit" name="dat" style="border-radius: 50px;">Select</button>
				</form>
			    </center>
				
		 
	<?php
		if(isset($_GET['dat'])){
			$val = $_GET['Datte'];
	?>
		    <hr style="border-color:#ddd;">

		    <h3 class="text-white"><?php echo "Date: ".$data['list'][$val]['dt_txt']."<br>";?></h3>

      <?php $temperature = "<b>Temperature: ".$data['list'][$val]['main']['temp']."</b>";
      		$clouds = "<b>Clouds: ".$data['list'][$val]['clouds']['all']."%</b>"; 
      		$humidity = "<b>Humidity: ".$data['list'][$val]['main']['humidity']."%</b>";
      		$windspeed = "<b>Wind Speed: ".$data['list'][$val]['wind']['speed']."m/s</b>";
      		$pressure = "<b>Pressure: ".$data['list'][$val]['main']['pressure']."hpa</b>";
      		$logo = "<center><img src='http://openweathermap.org/img/w/".$data['list'][$val]['weather'][0]['icon'].".png' height='100px' width='100px'></center>";
            $desc = "<p>".$data['list'][$val]['weather'][0]['description']."</p>";

    			  ?><div>
    			  <div class="d-flex justify-content-center flex-row"><?php 
				  echo $logo; ?></div>
				  <div class="d-flex justify-content-center flex-row"><h2 class="text-white"><?php echo $desc;?></h2></div>
				  <div class="d-flex justify-content-center flex-row">
    			  <ul class="text-white list-group list-group-flush">		
			      <li class="list-group-item" style="background: transparent;"><?php	echo $temperature; ?></li>
			      <li class="list-group-item" style="background: transparent;"><?php	echo $clouds; ?></li>
			      <li class="list-group-item" style="background: transparent;"><?php	echo $humidity; ?></li>
			      <li class="list-group-item" style="background: transparent;"><?php	echo $windspeed; ?></li>
			      <li class="list-group-item" style="background: transparent;"><?php	echo $pressure; ?><br></li>
			      </ul>
			      </div>
                  <?php } ?>
		          </div>
		
	</div>
	</div>


<?php include '../footer.php';
  ?>

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