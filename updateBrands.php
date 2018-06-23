<?php
/*@desc updating the brands table
  @version 7.0
  @author Ramesh
  @date 9/6/2018
*/

session_start();
include_once 'models/brands.php'; 

$brandObj = new Brands();

$id =  $_SESSION['id'];
$rows = $brandObj->selectById($id);
$bname = $rows[0]['name'];
$isActive = $rows[0]['isActive'];
if($isActive == 1)
{
	$status = "checked";
}
$typename = $rows[0]['typename'];



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
$brandObj->update($_POST,$id);
header('location:brands.php');
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
<form action= "updateBrands.php" method="POST" class="text-center">
	<label>
		Name:
	</label>
	<input type="text" name="name" value="<?= $bname?>">
	<br>
	<label>
		Status:
	</label>
	<input type="checkbox" name="isActive" <?= $status?> >
	<br>
	<label>
		TypeName:
	</label>
	<input type="text" name="typename"  value="<?= $typename?>">
	<br>

	<input type="submit" class='btn btn-info' name="submit" >
</form>

</body>
</html>