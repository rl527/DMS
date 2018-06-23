<?php

/*@desc forgot password
  @author Ramesh
  @version 7.0
  @date June 21/18
   */
require_once 'includes/dbconnect.php';
require_once 'models/users.php';
$connectionObj=new connectDB();

$ifErr=$tokenErr=null;
  if(isset($_GET['userId']))
  { 
      $_SESSION['userid']  = rtrim($_GET['userId'],'/');
  }

  if(isset($_POST['submit']))
  {
      $password = $_POST['password'];
      $confirmpassword = $_POST['confirmpassword'];
      $enteredtoken = $_POST['token']; 
      $id = $_SESSION['userid'];
      $usersObj=new users();
      $ifErr = $usersObj->passwordReset($password,$confirmpassword,$enteredtoken,$id);
  }
     
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <link rel="shortcut icon" href="img/logo-footer.png">

  <title>Resetpassword</title>

  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="assets/css/bootstrap-theme.css" rel="stylesheet">
  <!-- font icon -->
  <link href="assets/css/elegant-icons-style.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!--external css-->
  <link href="assets/css/style.css" rel="stylesheet">

  
</head>

<body class="loginadmin">

 	<div class="container">
  	
    <form class="loginform" name="resetform" method="POST" action="resetpassword.php" onsubmit="return validate();" >
      	<div class="loginblock">
          	<p class="lockicon">
                <i class="icon_lock_alt"></i>
            </p>
            <h4 class="adminname">Resetpassword</h4>    

			<div class="input-group">
  	        	  <span class="input-group-addon">
                  <i class="icon_key_alt"></i>
                </span>
  	      		 <input type="text" class="form-control" placeholder="Enter token" name="token">
          	</div>
            <span id="tknErr"></span>
                        <span class="error"><?=$tokenErr?></span>


          	<div class="input-group">
  	        	  <span class="input-group-addon">
                  <i class="icon_key_alt"></i>
                </span>
  	      		 <input type="password" class="form-control" placeholder="Password" name="password">
          	</div>
            <span id="pwdErr"></span>

            <div class="input-group">
  	        	  <span class="input-group-addon">
                  <i class="icon_key_alt"></i>
                </span>
  	      		 <input type="password" class="form-control" placeholder="ConfirmPassword" name="confirmpassword">
          	</div>
            <span id="cpwdErr"></span>

            <span class="error"><?=$ifErr?></span>
           
        	   <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Changepassword">
     	  </div>
    </form>

 	</div>
  
</body>

</html>
