<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
  $nombre = $_SESSION["USUARIO"];
  $clave = $_SESSION["PASSWORD"];
  

$query21 = $pdo->query("Select * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = $query21->fetch(PDO::FETCH_BOTH);
//$row = mysqli_fetch_assoc($query21);
$idEmpresaLog = $resultado['idEmpresa'];

?>
<html>
		<div class="bloque-contacto" style="margin-left:260px">
		<h1 class="contacto-home">CONTACTO</h1>
		<!--<h2 class="persona-de-contacto">Lic. Javier Quintanilla Lavastida.</h2>-->
		<h2 class="persona-de-contacto">Ing. Adrian Alejandro Lara Tobias.</h2>
		<h2 class="cargo-persona-contacto">Departamento de Informática</h2>
		<div class="puntos-2"></div>

		<div class="datos-contacto-home" align="left">
			<div class="elemento-contacto-grande">
				<div class="palabra-roja-home">MAIL</div>
			<!--	<div class="palabra-gris-home">servicios@canacintramonclova.org</div> -->
			    	<div class="palabra-gris-home">soporte@canacintramonclova.org</div>
			</div><!--
			--><div class="elemento-contacto">
				<div class="palabra-roja-home">TEL</div>
				<div class="palabra-gris-home">(866) 633 6633</div>
				<div class="palabra-gris-home">(866) 631 0900</div>
				<div class="palabra-gris-home">(866) 631 1509</div>
				<div class="palabra-gris-home">(866) 631 0886</div>
			</div><!--
			--><div class="elemento-contacto">
				<div class="palabra-roja-home">CEL</div>
			<!--	<div class="palabra-gris-home">044 (866) 112 97 53</div>-->
			<div class="palabra-gris-home"> (866) 146 9422</div>
			</div>
		</div>
	</div>
<!--	<div class="bloque-contacto">
		<div class="cuarenta">
			<h1 class="contacto-titulo">CONTACTO</h1>
			<h2 class="persona-de-contacto-seccion">Lic. Javier Quintanilla Lavastida.</h2>
			<h2 class="cargo-persona-contacto">Coordinador de Eventos</h2>

			<div class="datos-contacto-home" align="left">
				<div class="elemento-contacto-seccion">
					<div class="palabra-roja-home">MAIL</div>
					<div class="palabra-gris-home">servicios@Canacintramonclova.org</div>
				</div><!--
				<div class="elemento-contacto-seccion-chico" align="left">
					<div class="palabra-roja-home">TEL</div>
					<div class="palabra-gris-home">(866) 633 6633</div>
					<div class="palabra-gris-home">(866) 631 0900</div>
					<div class="palabra-gris-home">(866) 631 1509</div>
					<div class="palabra-gris-home">(866) 631 0886</div>
				</div><!--
				<div class="elemento-contacto-seccion-chico">
					<div class="palabra-roja-home">CEL</div>
					<div class="palabra-gris-home">044 (866) 112 97 53</div>
				</div>
			</div>
		</div><!--
		--><!--<div class="sesenta">
		<!--	<img class="imagen-home-mediana" src="images/CONTACTO4.png">-->
	<!--	</div>
	</div>-->

</html>
