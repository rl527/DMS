<!-- @desc admin login page
    @version 7.0
    @author Ramesh
    @date 9/6/2018 -->
    <?php
    include_once 'models/users.php';

    if(isset($_POST['submit'])){
      echo "Ramesh";
      $email = $_POST['email'];
      $password = $_POST['password'];
      $userObj = new Users;
      $userObj->validateMem($email,$password,"admin");
    }
    ?>
<html>
	<head>
    <link rel="shortcut icon" href = "../../img/logo.jpg" />

		<title>

Login Page		</title>
<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif:400,500,600,700i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/dist/css/bootstrap-3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/dist/css/login.css">
	</head>

   <body>
	 <div class="container login_form text-center" >
	   <h1> Admin Login Portal</h1>
   </div>
  <div class="imgcontainer">
    <img src="assets/dist/img/Logo_copy.png" alt="Avatar" class="avatar">
  </div>
    <div class="container login_form text-center" >
        
            <div class="row" id="login">
                   
                       
                      <hr>
                      <form action="adminLogin.php" method="POST">
                  	  <label ><b>Email-id</b></label>
                      <input type="text" placeholder="Enter Email" name="email" required><br>

                      <label ><b>Password</b></label>
                      <input type="password" placeholder="Enter Password" name="password" required>
                          <br>
                        <div id="errMsg">
                        <?php
                         if(isset($_GET['error'])) 
                          {
                           echo $_GET['error'];
                          } 
                      ?>
                    </div>   
                      <button type="submit" name="submit">Login</button>
                      </form>
                      
             </div>
    </div>

</body>
</html>
