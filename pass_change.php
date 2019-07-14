<?php

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
      $errMSG2 = "Please enter your user id.";
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

      $res2=mysqli_query($conn,"SELECT password FROM login WHERE usrid='$usrid'");
      $row2=mysqli_fetch_array($res2);
      $count = mysqli_num_rows($res2); // if uname/pass correct it returns must be 1 row

      if( $count == 1 && $row2['password']==$passo ) {
        $res3=mysqli_query($conn, "UPDATE login SET password = '$pass' WHERE usrid='$usrid'");
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
    <label for="exampleInputEmail1" style="color: #fff;">Enter User ID</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Employee ID" name="usrid">
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