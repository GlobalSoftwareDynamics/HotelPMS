<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {
		$bandera = false;
// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$link = mysqli_connect("localhost", "root", "","hotelpms");
// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
// Selecting Database
		mysqli_query($link,"SET NAMES 'utf8'");
// SQL query to fetch information of registered users and finds user match.
		$query = mysqli_query($link,"SELECT * FROM Colaborador WHERE contraseña='$password' AND usuario='$username'");
		$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			while($row = mysqli_fetch_array($query)){
				$codigoEmpleado = $row['idEmpleado'];
				$_SESSION['login']=$username; // Initializing Session
				$_SESSION['user']=$codigoEmpleado; // Session User
				if($row['idTipoUsuario'] == 1){
					header('Location:mainRecepcion.php');
				}
			}
		} else {
			$error = "Usuario o contraseña inválidos";
		}
		mysqli_close($link); // Closing Connection
	}
}
?>