<?php

$id=$_GET['id'];

/*$count = 0;*/
if (!file_exists("submissions/$id")) {
    mkdir("submissions/$id", 0777, true);
}

$tmpFilePath = $_FILES['upload']['tmp_name'];

if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath = "submissions/$id/" . $_FILES['upload']['name'][0];
    $filename=$_FILES['upload']['name'][0];
    if(move_uploaded_file ($_FILES['upload']['tmp_name'][0], $newFilePath)){
    	include_once('../dbconnect.php');
		$mysqli=$conn;
        $res=$mysqli->query
          ("SELECT accpic FROM profile WHERE usrid='$id'");
        $row=mysqli_fetch_array($res);
        $filee=$row['accpic'];  
        unlink("submissions/$id/".$filee);
		$mysqli->query
    	  ("DELETE FROM profile WHERE usrid='$id'")

    	or die($mysqli->error);

  		$mysqli->query
    	  ("INSERT INTO profile (usrid, accpic) VALUES ('$id', '$filename')")
    
    	or die($mysqli->error);
    }
}

header("Location: AdIn.php");

?>
