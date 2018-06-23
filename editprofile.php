<?php 


/*@desc editing the users profile
  @author susmitha
  @version 7.0
  @date June 21/18
*/

include_once 'models/users.php';

include_once 'models/department.php';

$usersObj = new Users();

$departmentObj = new Department();

  if($_SESSION['userid'] == null)
  {
    header("location:userLogin.php");
  }
  $userid = $_SESSION['userid'];
  $rows = $usersObj->selectById($userid);
  $name = $rows[0]['name'];
  $email = $rows[0]['email'];
  $deptId = $rows[0]['deptId'];
  $mobile = $rows[0]['mobile'];
  $profilePicture = $rows[0]['profilePicture'];
  $_SESSION['$profilePicture'] = $profilePicture;
  $dp = $_SESSION['$profilePicture'];

  if (isset($_POST['saveChanges']))
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $deptId = $_POST['deptId'];

array_pop($_POST);
print_r($_POST);
    if(isset($_FILES["fileToUpload"]))
    {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
      if(isset($_POST["saveChanges"])) 
      {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) 
        {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } 
        else 
        {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }

     
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }
      
      if ($uploadOk == 0) 
      {
        echo "Sorry, your file was not uploaded.";
     
      } 
      else 
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
      if(isset($_FILES["fileToUpload"]))  
      {
        $fileToUpload = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));  
        $image = addslashes($_FILES['fileToUpload']['name']); 
       
    }
     if($image != null)
     {
       $_POST['profilePicture'] = $image;
       $usersObj->update($_POST,$userid);  
      }
      else{
      $usersObj->update($_POST,$userid);
    }
  }
  header("location:editprofile.php");
  exit();
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
   <link rel="stylesheet" type="text/css" href="assets/css/editprofile.css">
<link rel="stylesheet" type="text/css" href="assets/css/index.css">
    

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
        <h3 class="text-center">USER PROFILE</h3>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="well">
             <div class="table-responsive">
      <div class="container">

        <form class="form-horizontal" action="editprofile.php" role="form" method="POST" enctype="multipart/form-data">           
          
            <div class="row">
              <div class="col-md-12 personal-info">
                <h2  align="center">PERSONAL-INFO</h2>
              </div>
              <div class="col-md-12">
                <div class="text-center">
                   <?php
                    $files = glob("uploads/*.*");
                    for ($i=0; $i<count($files); $i++)
                    {   
                      $num = $files[$i];
                     
                      if($files[$i] == "uploads/".$profilePicture)
                        {
                        echo '<img src="'.$num.'" alt="random image">'."&nbsp;&nbsp;";
                        }
                    }
                  ?>  
                <input type="file" id="image-input" name="fileToUpload" onchange="readURL(this);" accept="image/*" value="$profilePicture" disabled class="form-control form-input Profile-input-file" > 
              </div> 

            <div class="row">
              <div class="col-md-9 personal-info">
                <h4 class="text-right col-lg-12"><span class="glyphicon glyphicon-edit"></span> Edit Profile</h4>
                  <input type="checkbox" class="form-control" id="checker">
              </div>
            </div>
                         
            <div class=" col-md-11">
              <div class="form-group">
                <label class="col-md-3 control-label">USERNAME:</label>
                  <div class="col-md-7">
                    <input class="form-control" type="text" name="name" id="name" value="<?= $name ?>" disabled >
                  </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label">EMAIL ID:</label>
                  <div class="col-md-7">
                    <input class="form-control" type="text" name="email" id = "Email" value="<?= $email ?>" disabled>
                  </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label">DEPT ID:</label>
                  <div class="col-md-7">
                    <!-- <input class="form-control" type="text" name="deptid" id="DepId" value="<?= $deptId ?>" disabled> -->
                    <select name="deptId" id = "DepId" disabled> 
                               <option value=""> ---SELECT--- </option> 
                               <?php 
                               $rows = $departmentObj->selectAll(); 
                               $count = count($rows);
                               $i = 0;
                               while ($i < $count )
                               {
                                    $id = $rows[$i]['id'];
                                    $deptName = $rows[$i]['deptName'];
                                    if($id == $deptId)
                                    {
                                      echo '<option value = '.$id.' selected>'.$deptName.'</option>';
                                    }
                                    else
                                    {
                                    echo '<option value = '.$id.'>'.$deptName.'</option>'; 
                                  }
                                $i++;
                                  }
                                  ?> 
                            </select>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">MOBILE:</label>
                  <div class="col-md-7">
                    <input class="form-control" type="text" name="mobile" id="tel" value="<?= $mobile ?>" disabled>
                  </div>
              </div>
                                    
              <div class="form-group">
                <label class="col-md-3 control-label">isActive:</label>
                  <div class="col-md-7">
                    <input type="checkbox" name="isActive" name="status" id ="isActive" tabindex="1"  value="" disabled>
                  </div>
              </div>
                                    
              <div class="form-group">
                <label class="col-md-5 control-label"></label>
                  <div class="col-md-7">
                    <input type="submit" class="btn btn-primary" name="saveChanges" id="submit" value="SAVE CHANGES" disabled> 
                    <input type="reset" class="btn btn-default" name= "cancel" value="CANCEL">
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
<script type="text/javascript" src="assets/js/editprofile.js"></script>
</html>



