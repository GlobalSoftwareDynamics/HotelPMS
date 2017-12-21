<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$link = mysqli_connect("localhost", "root", "","hotelpms");
// Selecting Database
//$db = mysqli_select_db($link,"seapp");
session_start();// Starting Session
mysqli_query($link,"SET NAMES 'utf8'");
// Storing Session
$user_check=$_SESSION['login'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($link,"SELECT * FROM Colaborador WHERE usuario = '$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['usuario'];
if(!isset($login_session)){
	mysqli_close($link); // Closing Connection
	header('Location:index.php'); // Redirecting To Home Page
}
date_default_timezone_set('America/Lima');
?>