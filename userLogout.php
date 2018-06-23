<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("Location:userLogin.php"); // Redirecting To Home Page
}
?>