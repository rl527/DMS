	<?php
session_start();
/*@desc form for requesting device 
  @author priyanka
  @version 7.0
  @date June 21/18
*/

if(isset($_POST['submit']))
{
  $_SESSION['time'] = $_POST['time']; 
  $_SESSION['message'] = $_POST['message']; 
  $_SESSION['totalmessage'] = "My device request is for" .$_SESSION['time'] ."hours and desc: ". $_SESSION['message'] ;
  header("location:requestMail.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="assets/update.css">
</head>
<body>
  <form action='request.php' method="POST">
    TIME: <select required="required">
            <option value=''>REQUIRED TIME</option>
            <option value='1'>One hour</option>
            <option value='2'>Two hours</option>
            <option value='3'>Three hours</option>
            <option value='4'>Four hours</option>
            <option value='5'>Five hours</option>
            <option value='YourWish'>cant mention exact time</option>
          </select><br><br>
          <textarea name='message' rows='10' cols='30' required></textarea><br>
          <input type='submit' name="submit" value='SEND REQUEST' id='popupbtn' >
  </form>
</body>

</script>
</html>