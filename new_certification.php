<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
  $nombre = $_SESSION["USUARIO"];
  $clave = $_SESSION["PASSWORD"];
  
$query21 = $pdo->query("Select * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = $query21->fetch(PDO::FETCH_BOTH);
$idEmpresaLog = $resultado['idEmpresa'];

$query22 = $pdo->query("select * from Certificacion WHERE idEmpresa ='$idEmpresaLog' order by numeroCertificacion desc limit 1");
$resultado2 = $query22->fetch(PDO::FETCH_BOTH);
$NumeroCertificacion = $resultado2['numeroCertificacion'];
$SiguienteCertificacion = $NumeroCertificacion + '1';
?>
<html>

<div id="contenedor">
    <div class="puntos" style="height: 80%; margin-top:3em; left: 18%; width: 60%; margin-left: 100px;"></div>
    <form class="suscripcion" action="upload_Certification.php" method="post" enctype="multipart/form-data">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!--<div class="etiqueta-roja">REGISTRO</div>-->
        <div class="etiqueta-roja" style="width: 50%;">
	    	<h1 >CERTIFICACIÓN</h1>
        </div>
		<input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog ?>"></input>
    <input type="hidden" id="idNumeroCertificacion" name="idNumeroCertificacion" value="<?php echo $SiguienteCertificacion ?>"></input>

		<!--PRIMER BLOQUE-->
		<div style="width: 50%; height: 17em; margin-top: 5em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_CERTIFICACION_ESP" >Nombre de la certificación / Certification name (Español)</h3>
			<input type="text" maxlength="100" id="NOMBRE_CERTIFICACION_ESP" name="NOMBRE_CERTIFICACION_ESP" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 215%;" placeholder="CERTIFICACIÓN" required>
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_CERTIFICACION_ING" >Nombre de la certificación / Certification name (Inglés)</h3>
			<input type="text" maxlength="100" id="NOMBRE_CERTIFICACION_ING" name="NOMBRE_CERTIFICACION_ING" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 215%;" class="campo-chico" placeholder="CERTIFICATION"  required>

			<div style="margin-top: 5px;">
				<b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccione imagen de la certificación (.jpg):</b>
				<input type="file" name="uploadedFileCertificacion" accept=".jpeg, .jpg" required/>
			</div>
		</div>

		     <input id="adicionar" class="enviar" type="submit" name="Siguiente" style="margin-left: 500px;" value="Guardar certificación">
	</form>
</div>

</html>