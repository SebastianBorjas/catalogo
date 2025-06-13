<?php

 session_start();
 
include 'conexion.php';	
	 
	
$usuario = $_POST["USUARIO"];
$clave = $_POST["PASSWORD"];
$query21 = $pdo->query("Select * from Empresa where usuario = '$usuario' and contraseña = '$clave'");

 if($query21->rowCount() > 0){
     $_SESSION["USUARIO"] = $_POST["USUARIO"];
	 $_SESSION["PASSWORD"] = $_POST["PASSWORD"];
     header("Location:company_profile.php");
 }
 else{
     echo "<script>alert('Nombre de usuario o contraseña incorrecto');window.location='index.php';</script>";
 }
	$pdo->close();
?>