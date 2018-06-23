<?php

/*@desc forgot password
  @author Ramesh
  @version 7.0
  @date June 21/18
   */
  include_once 'includes/dbconnect.php';

require_once 'models/users.php';
$credErr = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $email=$_POST["email"];
    $usersObj=new Users();
    $credErr=$usersObj->emailCheck($email);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>forgotpwd</title>
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
    
    <form class="loginform" name="login" method="POST" action="forgotpassword.php" onsubmit="return validate();" >
        <div class="loginblock">
            <h2>Enter the Email of Your Account to Reset New Password</h2>

            <div class="input-group">
                 <span class="input-group-addon">
                  <i class="icon_mail"></i>
                </span>
                    <input type="text" class="form-control" placeholder="Email" name="email"  autofocus>
                </div>
                <span id="emailErr"></span>
                <span class="error"><?=$credErr?></span>

               <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Continue">
          </div>
    </form>
</body>
</html>

