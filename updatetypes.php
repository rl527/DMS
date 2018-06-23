<?php
/*@desc updating the device types table
  @version 7.0
  @author Ramesh
  @date 9/6/2018
*/
session_start();
include_once 'models/types.php'; 

$typeObj = new Types();
$id =  $_SESSION['id'];
$rows = $typeObj->selectById($id);

$tname = $rows[0]['name'];
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
$typeObj->update($_POST,$id);
header('location:types.php');
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
<form action= "updatetypes.php" method="POST" class="text-center">
	<label>
		Name:
	</label>
	<input type="text" name="name" value="<?= $tname?>">
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