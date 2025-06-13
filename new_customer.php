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

$query22 = $pdo->query("select * from Cliente WHERE idEmpresa ='$idEmpresaLog' order by numeroCliente desc limit 1");
$resultado2 = $query22->fetch(PDO::FETCH_BOTH);
$NumeroCliente = $resultado2['numeroCliente'];
$SiguienteCliente = $NumeroCliente + '1';
?>
<html>

<div id="contenedor">
<div class="puntos" style="height: 80%; margin-top:3em; left: 18%; width: 60%; margin-left: 100px;"></div>
    <form class="suscripcion" action="upload_Customer.php" method="post" enctype="multipart/form-data" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!--<div class="etiqueta-roja">REGISTRO</div>-->
        <div class="etiqueta-roja" style="width: 40%;">
	    	<h1>CLIENTE</h1>
        </div>
    <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog ?>"></input>
    <input type="hidden" id="idNumeroCliente" name="idNumeroCliente" value="<?php echo $SiguienteCliente ?>"></input>

		<!--PRIMER BLOQUE-->
		<div style="width: 50%; height: 20em; margin-top: 5em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_INDUSTRIA_CLIENTE_ESP" >Nombre de la industria a la que pertenece el cliente / Industry (Español)</h3>
			<input type="text" maxlength="100" id="NOMBRE_INDUSTRIA_CLIENTE_ESP" name="NOMBRE_INDUSTRIA_CLIENTE_ESP" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 215%;" placeholder="INDUSTRIA" required>
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_INDUSTRIA_CLIENTE_ING" >Nombre de la industria a la que pertenece el cliente / Industry (Inglés)</h3>
			<input type="text" maxlength="100" id="NOMBRE_INDUSTRIA_CLIENTE_ING" name="NOMBRE_INDUSTRIA_CLIENTE_ING" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 215%;" class="campo-chico" placeholder="INDUSTRY"  required>

			<div style="margin-top: 5px;">
				<b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccione logo del cliente(.jpg):</b>
				<input type="file" name="uploadedFileLogoCliente" accept=".jpeg, .jpg" required/>
			</div>
		</div>

		     <input id="adicionar" class="enviar" type="submit" name="Siguiente" style="margin-left: 500px;" value="Guardar cliente">
	</form>
</div>

</html>