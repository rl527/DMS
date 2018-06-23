<?php
/*@desc updating the users table
  @version 7.0
  @author Ramesh
  @date 9/6/2018
*/
session_start();
include_once 'models/users.php'; //
include 'models/department.php';

/*@desc user update records*/
$userObj = new Users();
$id =  $_SESSION['id'];
$rows = $userObj->selectById($id);
$username = $rows[0]['name'];
$email = $rows[0]['email'];
$userdeptId = $rows[0]['deptId'];
$mobile = $rows[0]['mobile'];
$profpic = $rows[0]['profilePicture'];
$password = $rows[0]['password'];

$isActive = $rows[0]['isActive'];
if($isActive == 1){
	$status = "checked";
}

if($_POST['submit'])
{
if(isset($_POST['isActive'])){
	$_POST['isActive'] = 1;
	array_pop($_POST);
} 
else{
	array_pop($_POST);
	$_POST['isActive'] = 0;
}
$userObj->update($_POST,$id);
header('location:users.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="assets/update.css">
</head>
<body>
<form action= "updateuser.php" method="POST" class="text-center">
	<label>
		Name:
	</label>
	<input type="text" name="name" value="<?= $username?>">
	<br>
	<label>
		Email:
	</label>
	<input type="text" name="email" value="<?= $email?>">
	<br>
	<label>
		Mobile:
	</label>
	<input type="text" name="mobile" value="<?= $mobile?>">
	<br>
	<label>
		ProfilePic:
	</label>
	<input type="text" name="profilePicture" value="<?= $profpic?>">
	<br>
	<label>
		Password:
	</label>
	<input type="password" name="password" value="<?= $password?>">
	<br>
	<label>
		DeptId:
	</label>
	<select name="deptId" id = "DepId" > 
                               <option value=""> ---SELECT--- </option> 
                               <?php 
                               $deptObj = new Department;
                               $rows = $deptObj->selectAll();
                               $count = count($rows);
                               $i = 0;
                               while ($i < $count )
                               {
                                  if($rows[$i]['isActive'] == 1)
                                  {
                                    $id = $rows[$i]['id'];
                                    $deptName = $rows[$i]['deptName'];
                                      if($id == $userdeptId){
                                      echo '<option value = '.$id.' selected>'.$deptName.'</option>';
                                    }
                                    else{
                                    echo '<option value = '.$id.'>'.$deptName.'</option>'; 
                                  }
                                 }
                                $i++;
                               }
      ?> 
	<br>
	<label>
		Status:
	</label>
	<input type="checkbox" name="isActive" <?= $status?> >
	<br>
	<input type="submit" class='btn btn-info' name="submit" >
</form>

</body>
</html>