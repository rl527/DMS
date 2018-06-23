<?php 

/*@desc users dashboard
  @author priyanka
  @version 7.0
  @date June 21/18
  */

  include 'includes/dbconnect.php';
  include 'models/users.php';
  include 'models/devices.php';
 
 
 if($_SESSION['userid'] == null)
 {
  header("location:userLogin.php");
 }
  $userid =  $_SESSION['userid'];


  $devicesObj=new Devices();
  
  $usersObj=new Users();

  $resultCard=$usersObj->selectById($userid);

  if (isset($_POST['pwd_submit']))
  {
    $id =  $_SESSION['userid'];
    $password = $_POST['newPwd'];
  }


  // $userid =  $_SESSION['userid'];
  $recpage = 6;
  
  $result = $devicesObj->selectAll(); //run the query

  
  $totalrecords = count($result); //count number of records

  $totalpages = ceil($totalrecords / $recpage); 
    
  if (isset($_GET["page"])) 
  {
    $page  = $_GET["page"]; 
  } 
  else
  { 
    $page=1; 
  } 
    $startfrom = ($page-1) * $recpage; 
   
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      <a class="navbar-brand" href="userdashboard.php" src="assets/images/Logo_copy.png"></a>
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
        <h3 class="text-center">DEVICE DETAILS</h3>
      </div>
      <div class="row ">
        <div class="col-sm-9">
          <div class="well">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover ">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>DEVICES</th>
                      <th>USER HAVING DEVICE</th>
                      <th>TO REQUEST</th>
                      <th>AFTER RECEIVING</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       //updation
                      if(isset($_GET['rid'])) 
                      {   
                        $_SESSION['email'] = $_GET['rid']; //email
                        header("location:request.php");
                        exit();
                      }
                      if(isset($_GET['devid'])) 
                      {   
                        $devid = $_GET['devid'];
                        $updateArr['updatedBy'] = $userid;
                        $devicesObj->update($updateArr,$devid);
                      }
                        $rows=$devicesObj->tableData($startfrom,$recpage);
                        $count=count($rows);
                        $i=0;
                        while($i<$count)
                        {
                         
                        echo "<tr>
                                <td>".$rows[$i]['id']."</td>
                                <td>".$rows[$i]['dname']."</td>
                                <td>".$rows[$i]['uname']."</td>
                                <td>";
                                if($resultCard[0]['email'] != $rows[$i]['email'])
                                {
                                echo "<a  id = 'update' class='btn btn-info' href='userdashboard.php?rid=".$rows[$i]['email']."'  data-toggle='modal' data-target='#myModal' disable>Request</a></td>";                                
                                }
                                else
                                {
                                  echo "With you ".$rows[$i]['uname']."";
                                }
                                echo "<td><div class='box'>
                                      <div class='btn btn-info'>
                                        <a href='userdashboard.php?devid=".$rows[$i]['id']."'>RECEIVED</a>
                                      </div>
                                    </div>
                                </td>
                              </tr>";
                            $i++;
                          }
                          ?>
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>
                </tbody>
               
              </table> 
                <div id="response" class="text-center">
                  <?php if(isset($_GET['response'])) 
                  {echo $_GET['response'];} ?>
                </div>
            </div>


            <div class="pagination">
                    <ul class="pagination ">
                        <?php
                            echo "<li> 
                                    <a href='userdashboard.php?page=1'>
                                    <span class='glyphicon glyphicon-chevron-left'></span>
                                    </a>
                                  </li>"; // Goto 1st page

                            for ($i=1; $i<=$totalpages; $i++)
                            { 
                                echo "<li><a class='active' href='userdashboard.php?page= ".$i."' > 
                                ".$i." </a></li> "; 
                            } 
                            echo "<li><a  href='userdashboard.php?page=$totalpages'><span class='glyphicon glyphicon-chevron-right'></span></a> </li>"; // Goto last page
                        ?>
                    </ul>  
            </div>
          </div>
        </div>
        <div class="col-sm-3 text-center">
          <div class="well">
            <h2 >User Profile Card</h2>
             <div class="card">
              <?php
               $files = glob("uploads/*.*");
                    for ($i=0; $i<count($files); $i++)
                    {   
                      $num = $files[$i];
                     
                      if($files[$i] == "uploads/".$resultCard[0]['profilePicture'])
                        {
                        echo '<img src="'.$num.'" alt="random image">'."&nbsp;&nbsp;";
                        }
                    }
                ?>
              <hr>
              <p class="title"><label>Name:</label><?= $resultCard[0]['name']; ?></p>
              <p class="title"><label>Mobile:</label><?= $resultCard[0]['mobile']; ?></p>
              <p class="title"><label>Email:</label><?= $resultCard[0]['email']; ?></p>
                <div class="cardicons">
                  <a href="https://github.com/login"><i class="fa fa-github"></i></a> 
                  <a href="https://twitter.com/login?lang=en"><i class="fa fa-twitter"></i></a>  
                  <a href="https://www.linkedin.com/start/join?_l=en"><i class="fa fa-linkedin"></i></a>  
                  <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a> 
                </div>
                <ul>
                  <li><a  href="editprofile.php">VIEW PROFILE</a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>
</body>
</html>
