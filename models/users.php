<?php

/*@desc CRUD operations for users table in class Users
  @version 7.0
  @date June 21/18
*/
session_start();
include_once 'modelwrapper.php';

class Users
{

	/*@desc selecting the records in the users table
	  @author ramesh
	  @return string data
	 */
	
	
	function selectAll()
	{
		$modelWrap = new ModelWrapper();	
		$data = $modelWrap->selectAll("users");
		return $data;
	}
    
    /*@desc selecting the users record by id
      @author ramesh
      @param int id*/
		
     function selectById($id){
     	$modelWrap = new ModelWrapper();
		$data = $modelWrap->selectById("users",$id);
		return $data;
     }

     /*@desc deleting the records in users table
       @author ramesh
       @param int id
       */
	function delete($id)
	{
		$modelWrap = new ModelWrapper();
		$modelWrap->deleteById($id,"users");
	}


	    /*@desc updating users records
        @author susmitha
        @param string updateArr
        @param int id
        */

  	function update($updateArr,$id)
      {
        $modelWrap = new ModelWrapper();
        $rows = $modelWrap->updateRecord("users",$updateArr,$id);
      }

 		  /*@desc inserting the users records
        @author susmitha
        @param string fieldArr
        */

	function insert($fieldArr)
    {
      $fieldArr['role'] = "user";  
      $modelWrap = new ModelWrapper();
      $result = $modelWrap->insertData($fieldArr,"users");
      return $result;
    }


	/*@desc selecting users records to display on the adminDashboard
    @author ramesh
	  @return string rows
	*/

	function tablerows(){
		$modelWrap = new ModelWrapper();
		$rows = $modelWrap->tablerows("users");
		return $rows;
	}

  /*@desc selecting users having devices records to display on adminsdashboard
    @author ramesh
    @return string data
  */	

	function displayTable(){
		$sql = "select u.id as id,u.name as name,d.deviceName as dname FROM users u,devices d where u.id = d.updatedBy";
		$data = $this->runQuery($sql);
		return $data;
	}

  /*@desc validations for user and admin login form
    @author priyanka
    @param string email
    @param string password
    @param string role
  */  

function validateMem($email,$password,$role)
    {

      $dbObj = new connectDB();
      $sql = "SELECT * from users where email = '$email' and password = '$password' and role = '$role' ";
      $result = $dbObj->conn->query($sql);
      $numRows = mysqli_num_rows($result);
      if($numRows == 1)
      {
          $row = mysqli_fetch_array($result);
          if($role =="user"){
             $_SESSION['userid'] = $row['id'];
             $_SESSION['username'] = $row['name'];      
             header("location:./userdashboard.php");
          }
          else
          {

             $_SESSION['userid'] = $row['id'];
             $_SESSION['username'] = $row['name'];
             header("location:./starter.php");//Admin Dashboard
          }
          return 0;
      }
      elseif($role =="user"){

        header('location:./userLogin.php?error=INVALID USERNAME AND PASSWORD COMBINATION');
      }
      else{

         header('location:./adminLogin.php?error=INVALID USERNAME AND PASSWORD COMBINATION');
      }

    }



    /*@desc changing the users password
      @author susmitha
      @param int id
      @param string newPassword
      @param string currentPwd
      */

    function passwordChange($id,$newPassword,$currentPwd)
    {
      $modelWrap = new ModelWrapper();
      $data = $modelWrap->selectById("users",$id);
      if($currentPwd == $data[0]['password']) 
      {
        $updateArr['id'] = $id;
        $updateArr['password'] = $newPassword;

        $modelWrap = new ModelWrapper();
        $modelWrap->updateRecord("users",$updateArr,$id);


        {
          echo '<script language="javascript" type="text/javascript"> 
                alert("password successfully changed");
                window.location = "userdashboard.php";
                </script>';
        }
      }
      else
      {
        header('location:./changePassword.php?pwderror=password does not match');
      }
    }


      /*@desc reseting the password
      @author ramesh
      @param string password
      @param string confirmpassword
      @param string enteredtoken
      @param int id
      */

     function passwordReset($password,$confirmpassword,$enteredtoken,$id)
    {
      $connectionObj=new connectDB(); 
      $uniqueToken=null; 
      $sql = "SELECT password,name from users where id = '$id' ";
      $row = $this->runQuery($sql);
      if($row == TRUE)
      {
        $uniqueToken = $row[0]['password']; 
      }
      if($enteredtoken === $uniqueToken)
      { 
        if($password == $confirmpassword)
        {   
          $sql = "UPDATE users SET password= '$password'  WHERE id = '$id' "; 
          $result = mysqli_query($connectionObj->conn,$sql);
          if($result == TRUE)
          {
            $_SESSION['userid'] = $id;
            $_SESSION['username'] = $row[0]['name'];
            header('location:./userdashboard.php');
          }
        }
        else
        {
          $matchErr= "Password Not Matched";
          return $matchErr;
        }
      }
      else
      {
        $tokenErr= "Invalid Token";
        return $tokenErr;
      }
    }


     /*@desc rememberme functionality for user
       @author susmitha
      */

    function remember()
    {

            $dbObj = new connectDB(); 
            $sql = "Select * from users where email = '" . $_POST["memberEmail"] . "' and password = '" . $_POST["memberPassword"] . "'";
            $result = mysqli_query($dbObj->conn,$sql);
            $user = mysqli_fetch_array($result);
            if($user) 
          {
                    //$_SESSION["member_id"] = $user["member_id"];
                  if(!empty($_POST["remember"])) 
                  {
                  setcookie ("memberLogin",$_POST["memberEmail"],time()+ (10 * 365 * 24 * 60 * 60));
                  setcookie ("memberPassword",$_POST["memberPassword"],time()+ (10 * 365 * 24 * 60 * 60));
                  } 
                else 
              {
                  if(isset($_COOKIE["memberLogin"]))
                {
                  setcookie ("memberLogin","");
                }
                if(isset($_COOKIE["memberPassword"]))
                {
                  setcookie ("memberPassword","");
                }
              }

          }

    }


   

    /*@desc checking email for forgot password
      @author ramesh
      @param string email
      @return string credErr
      */

   function emailCheck($email) 
    {
      $connectionObj=new connectDB();
      $_SESSION['email'] = $email;
      $sql="SELECT id,email FROM users where email='$email' AND role='user' ";
      $row = $this->runQuery($sql);
      $id = $row[0]['id'];
      $uniqidStr = md5(uniqid(mt_rand()));;
      $_SESSION['token'] = $uniqidStr;
      $sql = "UPDATE users SET `password`= '$uniqidStr'  WHERE id = '$id'";
      $result = mysqli_query($connectionObj->conn,$sql);
      if($result == TRUE)
      {
        $_SESSION['emailmsg'] = "Dear User This is the link you have to go through and change the password: http://localhost/DMS/resetpassword.php?userId=$id";
        header('location:forgotpwdmail.php');
      } 
      else
      {
        $credErr="Invalid email";
        return $credErr;
      }
    }


  /*@desc for all querires to run
    @param string sql
    @return string rows*/

	function runQuery($sql)
	{
			$dbObj = new connectDB();
			$result = mysqli_query($dbObj->conn,$sql);
			if($result == TRUE)
			{  
			$num_rows=mysqli_num_rows($result);	
			$i=0;
			while($i < $num_rows)
			{
				$row = mysqli_fetch_assoc($result);
			    $rows[] = $row;
			    $i++;
			}
				return $rows;
			}
			else
			{
			  echo "Fails";
			}
	}

}

?>