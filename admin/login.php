<?php

	session_start();

	if($_POST["NOMBRE"] == "admin" && $_POST["PASSWORD"] == "admin"){
		$_SESSION["USUARIO"] = $_POST["NOMBRE"];
		$_SESSION["PASSWORD"] = $_POST["PASSWORD"];
		header("Location:busqueda.php");
	}
	else{
		echo "<script>alert('Nombre de usuario o contraseña incorrecta');window.location='index.php';</script>";
	}
?>