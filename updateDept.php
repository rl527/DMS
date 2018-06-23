<?php
/*@desc updating the departments table
  @version 7.0
  @author Ramesh
  @date 9/6/2018
*/

session_start();
 include_once 'models/department.php';

$deptObj = new department();
$id =  $_SESSION['id'];
$rows = $deptObj->selectById($id);

$dname = $rows[0]['deptName'];
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
// $typename = $_POST['typename'];
$deptObj->update($_POST,$id);
header('location:dept.php');
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
<form action= "updateDept.php" method="POST" class="text-center">
	<label>
		Name:
	</label>
	<input type="text" name="deptName" value="<?= $dname?>">
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