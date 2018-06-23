<?php

/*@desc forgot password
  @author Ramesh
  @version 7.0
  @date 11/06/18
   */
session_start();

include_once 'PHPMailer_v5.1-master/class.phpmailer.php';
$email = $_SESSION['email'];
$mailto = $email;//$_POST['mail_to'];
$mailSub = "Request for Device";//$_POST['mail_sub'];
$mailMsg = $_SESSION['emailmsg']."<br> Your Unique token is :".$_SESSION['token'];

$mail = new PHPMailer(true);

$mail->IsSmtp();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;

$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;

$mail->IsHTML(true);
$mail->Username = "ch.susmitha19@gmail.com";
$mail->Password = "myattitude";
$mail->SetFrom("ch.susmitha19@gmail.com");
$mail->Subject = $mailSub;
$mail->Body = $mailMsg;
$mail->AddAddress($mailto);


if($mail->Send())
{
     echo '<script language="javascript" type="text/javascript"> 
              alert("Your request has been received and you will get mail soon!!!!!");
              window.location = "userLogin.php";
              </script>';
        }
        else
{
	header('location: userdashboard.php?response=THERE IS SOME PROBLEM SENDING MAIL,PLEASE TRY AGAIN');
}

?>