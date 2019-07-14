<?php

if(isset($_POST['forp']))
{
    $usrid = $_POST['usrid'];
    $usrid = strip_tags($usrid);
    $usrid = htmlspecialchars($usrid);

    $result = mysqli_query($conn,"SELECT * FROM admin where adid='$usrid'");
    $row = mysqli_fetch_assoc($result);
	$fetch_user_id=$row['adid'];
	$email=$row['email'];
	$password=$row['password'];
	if($usrid==$fetch_user_id) {
				$to = $email;
                $subject = "Password";
                $txt = "Your password is : ".$password;
                $headers = "From: oinksharma@gmail.com";
                mail($to,$subject,$txt,$headers);
			}
				else{
					$errMSG5 = "invalid userid";
				}
}
?>