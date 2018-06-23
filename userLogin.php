<?php

/*@desc login and registration page for users
  @author susmitha
  @version 7.0
  @date 11/06/18
*/
include_once 'models/users.php';
include_once 'models/department.php';
$usersObj = new Users();
$departmentObj = new Department();
$errors = array();

//remember me

if(!empty($_POST['loginUser']))
 {
  $email =  $_POST['memberEmail'];
  $password = $_POST['memberPassword'];
  $usersObj->remember();
  $usersObj->validateMem($email,$password,"user");
  
  }

//REGISTRATION    

if (isset($_POST['registerSubmit'])) 
{
  
  $name = $_POST["name"];
  $email = $_POST["email"];
  $department = $_POST["deptId"];
  $mobile = $_POST["mobile"];
  $password = $_POST["password"];
  $isActive = $_POST["isActive"];
  array_pop($_POST);
  
    if(isset($_FILES["fileToUpload"]))
    {
      $fileToUpload = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));  
      $imageName = addslashes($_FILES['fileToUpload']['name']); 
       $_POST['profilePicture'] = $imageName; 
    } 
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
      if(isset($_POST["submit"])) 
      {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false)
        {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else
        {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }
      
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
      {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }
     
      if ($uploadOk == 0)
      {
        echo "Sorry, your file was not uploaded.";
      } else 
      {
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } 

        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
      }
  $result = $usersObj->insert($_POST);
  if($result == 0)
      { 
       header('location:http://localhost/DMS/userLogin.php?regerror=USER ALREADY EXISTS SO PLEASE LOGIN');
      session_destroy();
      echo "Error: " ;
      }
   else
      {    
        $email = $_POST['email'];
        $password = $_POST['password'];
        $usersObj->validateMem($email,$password,"user");

      }
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>form</title>
  <!-- Bootstrap files -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script  type="text/javascript" src="assets/js/login.js"></script> 
  <!-- Login stylesheet -->
  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body>
    <div class="container">
      
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
              <div class="text-center">
                <h1>DEVICE MANAGEMENT SYSTEM</h1> 
              </div>
            </div>
        </nav>
          
          
        <div>
          <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                  <div class="panel-heading">
                    <div class="row">

                      <div class="col-xs-6">
                        <a href="#" class="active" id="login-form-link">Login</a>
                      </div>

                      <div class="col-xs-6">
                        <a href="#" class="active" id="register-form-link">Create Your Account</a>
                      </div>

                    </div>
                    <hr>
                  </div>

                  <div class="panel-body">
                    <div class="row">

                      <div class="col-lg-12">

                        <form id="login-form" action="userLogin.php" onsubmit="return validateForm()" method="POST" role="form" style="display:block;">

                          <div class="form-group">

                            <div id="errMsg">
                                <?php if(isset($_GET['regerror'])) {
                                   echo $_GET['regerror'];} ?>
                            </div>

                            <input type="text" name="memberEmail" id="email" tabindex="1" class="form-control" placeholder="EMAIL"  value="<?php if(isset($_COOKIE["memberLogin"])) { echo $_COOKIE["memberLogin"]; } ?>"  />
                            <div id="emailError"></div>

                          </div>
                          
                          <div class="form-group">

                           <input type="password" name="memberPassword" id="pwd" tabindex="2" class="form-control" placeholder="PASSWORD" value="<?php if(isset($_COOKIE["memberPassword"])) { echo $_COOKIE["memberPassword"]; } ?>"/> 
                            <div id="pwdError"></div>
                            <div id="errMsg"><?php if(isset($_GET['error']))
                            {
                                   echo $_GET['error'];
                                 } ?>
                            </div>
                           
                          </div> 
                          
                          <div class="form-group text-center">

                            <input type="checkbox" name="remember" <?php if(isset($_COOKIE["memberLogin"])) { ?> checked <?php } ?> />  
                           <label for="remember-me">Remember me</label>  
                          </div>
                          
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="loginUser" id="submit" tabindex="4" class="form-control btn btn-login" value="submit">
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="text-center">
                                  <a href="forgotpassword.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                                </div>
                              </div>
                            </div>
                          </div>

                        </form>




                        <form id="register-form" action="userLogin.php" onsubmit="return submitForm()" method="POST" name="myForm" style="display: none;"  enctype="multipart/form-data" >

                          <div class="form-group">
                          	<label>Name:</label>
                            <input type="text" name="name" id="username" tabindex="1" class="form-control" placeholder="name" maxlength="30">
                            <p id="nameErr"></p>
                          </div>

                          <div class="form-group">
                          	<label>Email:</label>
                            <input type="text" name="email" id="Email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                            <p id="emailErr"></p>
                          </div>

                          <div class="form-group">
                            <label>DeptId:</label>
                            <select name="deptId" id = "dept"> 
                               <option value = ""> ---SELECT--- </option> 
                               <?php
                               $rows = $departmentObj->selectAll();
                               $count = count($rows);
                               $i = 0;
                               while ($i < $count )
                               {
                                    $id       = $rows[$i]['id'];
                                    $deptName = $rows[$i]['deptName'];
                                    echo '<option value="'.$id.'">'.$deptName.'</option>'; 
                                    $i++;}?>
                            </select>
                           </div>

                          <div class="form-group">
                          	<label>Mobile No:</label>
                            <input type="text" name="mobile" id="tel" tabindex="1" class="form-control"  value="">
                            <p id="telErr"></p>
                          </div>

                         <div class="form-group">
                            <label>Upload profile picture:</label>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                          </div>

                          <div class="form-group">
                          	<label>Password:</label>
                            <input type="password" name="password" id="pwd2" tabindex="2" class="form-control" placeholder="Password">
                            <p id="pasErr"></p>
                          </div>

                          <div class="form-group">
                          	<label>isActive:</label>
                            <input type="checkbox" name="isActive" id ="isActive" tabindex="1" class="" value="1">
                          </div>
                          
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="registerSubmit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="submit">
                              </div>
                            </div>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
    </div>

    <div id="error"></div>
    <script type="text/javascript" src="assets/js/mainpage.js"></script>
    <script type="text/javascript" src="assets/js/registration.js"></script>

</body>  
</html>