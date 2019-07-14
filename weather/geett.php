<html>
<head><title>Weather Report of <?php echo $_GET['q']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<style>
html, body, h1, h2, h3, h4, h5, h6 {
  font-family: "Comic Sans MS", cursive, sans-serif;
}
</style>

<body>




<?php
error_reporting(0);
$get = json_decode(file_get_contents('http://ip-api.com/json/'),true);


date_default_timezone_set($get['timezone']);


$city = $_GET['q'];


$string = "http://api.openweathermap.org/data/2.5/forecast?q=".$city."&units=metric&appid=9d7b748ab7d47e8f73a824885e4e69d2";
$data = json_decode(file_get_contents($string),true);


 $country =  "<h1 class='w3-xxxlarge w3-animate-zoom'><b>".$data['city']['name'].",".$data['city']['country']."</h1></b>";
 
 

 
?>

	<div class="w3-display-container w3-wide">
		  <div class="w3-margin-top">
			
				<?php 
				echo $country;
				?>

				<center>
				<form method="GET" action="geett.php" autocomplete="off" class="form my-2 my-lg-0" >
					<select name="Datte">
						<?php for ($num1 = 0; $num1 < sizeof($data['list']); $num1 += 1) {?>
						<option value="<?php echo $num1 ?>"><?php echo $data['list'][$num1]['dt_txt'] ?></option>
					    <?php } ?>
					</select>
					<input type="text" name="q" value="<?php echo $city ?>" style="display:none;">
					<input type="submit" name="dat" value="Get Selected Values" />
				</form>
			    </center>
				
		  </div>
	
	
	<div class="w3-margin-top w3-padding-top">
		<div class="w3-animate-left w3-margin-top"><br><br><br>

	<?php
		if(isset($_GET['dat'])){
			$val = $_GET['Datte'];
	?>
		    <!--<p><?php echo $num1; ?></p>-->
			<h1 class="w3-xlarge"><?php echo "<b>Date: ".$data['list'][$val]['dt_txt']."</b><br>";?></h1> 
      <?php $temperature = "<b>Temperature: ".$data['list'][$val]['main']['temp']."</b><br>";
      		$clouds = "<b>Clouds:".$data['list'][$val]['clouds']['all']."%</b><br>"; 
      		$humidity = "<b>Humidity:".$data['list'][$val]['main']['humidity']."%</b><br>";
      		$windspeed = "<b>Wind Speed:".$data['list'][$val]['wind']['speed']."m/s</b><br>";
      		$pressure = "<b>Pressure:".$data['list'][$val]['main']['pressure']."hpa</b><br>";
      		$logo = "<center><img src='http://openweathermap.org/img/w/".$data['list'][$val]['weather'][0]['icon'].".png'></center>";
            $desc = "<b><p>".$data['list'][$val]['weather'][0]['description']."</p></b>";

    			  ?><div class="w3-xlarge">
    			  <?php 
				  echo $logo; 
				  echo "<center><h2>".$desc."</h1></center>";
				  ?>
    			  <ul>		
			      <li><?php	echo $temperature; ?></li>
			      <li><?php	echo $clouds; ?></li>
			      <li><?php	echo $humidity; ?></li>
			      <li><?php	echo $windspeed; ?></li>
			      <li><?php	echo $pressure; ?><br></li>
			      </ul>
   <?php } ?>

		</div>
		
	</div>
	
	</div>




















</body>
</html>