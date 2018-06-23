<?php
/*@desc updating the devices table
  @version 7.0
  @author Ramesh
  @date 9/6/2018
*/

session_start();

include_once 'models/devices.php'; 

$devObj = new Devices();

$id =  $_SESSION['id'];
$rows = $devObj->selectById($id);

$dname = $rows[0]['deviceName'];
$typeId = $rows[0]['typeId'];
$pictures = $rows[0]['pictures'];
$description = $rows[0]['description'];
$modelNum = $rows[0]['modelNum'];
$alias = $rows[0]['alias'];
$tags = $rows[0]['tags'];
$isActive = $rows[0]['isActive'];

if($isActive == 1){
	$status = "checked";
}

if($_POST['submit'])
{
$dname = $_POST['deviceName']; 
$typeId = $_POST['typeId'];
$pictures = $_POST['pictures'];
$description = $_POST['description'];
$modelNum = $_POST['modelNum'];
$alias = $_POST['alias'];
$tags = $_POST['tags'];
if(isset($_POST['isActive'])){
	$_POST['isActive'] = 1;
	array_pop($_POST);
} 
else{
	array_pop($_POST);
	$_POST['isActive'] = 0;
}

// $typename = $_POST['typename'];
$devObj->update($_POST,$id);
header('location:devices.php');
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
<form action= "updatedev.php" method="POST" class="text-center">
	<label>
		Name:
	</label>
	<input type="text" name="deviceName" value="<?= $dname?>">
	<br>
	<label>
		typeId:
	</label>
	<input type="text" name="typeId" value="<?= $typeId?>">
	<br>
	<label>
		pictures:
	</label>
	<input type="text" name="pictures" value="<?= $pictures?>">
	<br>
	<label>
		description:
	</label>
	<input type="text" name="description" value="<?= $description?>">
	<br>
	<label>
		modelNum:
	</label>
	<input type="text" name="modelNum" value="<?= $modelNum?>">
	<br>
	<label>
		alias:
	</label>
	<input type="text" name="alias" value="<?= $alias?>">
	<br>
	<label>
		tags:
	</label>
	<input type="text" name="tags" value="<?= $tags?>">
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