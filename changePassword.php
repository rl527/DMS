<?php 

/*@desc changing users password
  @author susmitha
  @version 7.0
  @date June 21/18
   */
  session_start();
  include_once 'includes/dbconnect.php';
  include 'models/users.php';


  $dbObj = new connectDB();
  if($_SESSION['userid'] == null)
  {
  header("location:userLogin.php");
 }
  $userid =  $_SESSION['userid'];
  $usersObj = new Users();
 

  $resultCard=$usersObj->selectById($userid);
  if (isset($_POST['submit']))
  {
    $id =  $_SESSION['userid'];
    $newPassword = $_POST['newPwd'];
    $currentPwd = $_POST['currentPwd'];
    $usersObj->passwordChange($id,$newPassword,$currentPwd);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>USER DASHBOARD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/index.css">
    <script type="text/javascript">
    
    </script>

</head>
<body>

<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="assets/images/logo.jpg"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
         <li class="active"><a href="userdashboard.php">Dashboard</a></li>
        <li><a href="editprofile.php">Edit Profile</a></li>
        <li><a href="changePassword.php">Change Password</a></li>
        <li><a href="userLogout.php">LogOut</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-2 sidenav hidden-xs">
      <a class="logo" href="userdashboard.php"><img src="assets/images/Logo_copy.png" ></img></a>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="userdashboard.php">Dashboard</a></li>
        <li><a href="editprofile.php">Edit Profile</a></li>
        <li><a href="changePassword.php">Change Password</a></li>
        <li><a href="userLogout.php">LogOut</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-10">
      <div class="well">
        <h1 class="text-center">DEVICE MANAGEMENT SYSTEM</h1>
      </div>
    </div>

    <div class="col-sm-10">
      <div class="well">
        <h3 class="text-center">CHANGE PASSWORD</h3>
      </div>
      <div class="row ">
        <div class="col-sm-12">
          <div class="well">
            <div class="content">
      <div class="img">
        <div class="panel-body">
          <div class="row">     
            <div class="col-md-6 col-md-offset-3">

                <form method="POST" name="myForm" action="changePassword.php" align="center" onclick="return validateForm()">
                  <div class="form-group">
                    <label>Current Password:</label>
                    <input type="password" name="currentPwd" id="pwd" tabindex="1" class="form-control" >
                    <p id="currentPwdError"></p>
                  </div>

                  <div class="form-group">
                    <label>New Password:</label>
                    <input type="password" name="newPwd" id="nPwd"  tabindex="1" class="form-control" >
                    <p id="newPwdError"></p>
                  </div>

                  <div class="form-group">
                    <label>Confirm Password:</label>
                    <input type="password" name="confirmPwd" id="cPwd" onkeyup="validatePwd()" tabindex="1" class="form-control" >
                    <p id="confirmPwdError"></p>
                    <div id="errMsg"><?php if(isset($_GET['pwderror'])){echo $_GET['pwderror'];} ?></div>
                    <p id="passerror"></p>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" value="submit" onclick="passwordAlert()">
                  </div>
            
                </form>
                <br>
                <br>
            </div>
          </div>
        </div>
      </div>
    </div>
          
   
<div id="error"></div>
<script type="text/javascript" src="assets/js/pwd.js"></script>


</script>
</body>        
</html>