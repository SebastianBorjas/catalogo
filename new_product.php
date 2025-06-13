<?php 
session_start();

include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
$nombre = $_SESSION["USUARIO"];
$clave = $_SESSION["PASSWORD"];
  
$query = $pdo->query("SELECT * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = $query->fetch(PDO::FETCH_BOTH);
$idEmpresaLog = $resultado['idEmpresa'];

$query2 = $pdo->query("SELECT * from Producto WHERE idEmpresa ='$idEmpresaLog' order by numeroProducto desc limit 1");
$resultado2 = $query2->fetch(PDO::FETCH_BOTH);
$query2->execute();
$NumeroProducto = $resultado2['numeroProducto'];
$SiguienteProducto = $NumeroProducto + '1';

$fila = $query2->fetch()
?>
<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	</head>
	<div id="contenedor" >
		<div class="puntos" style="height: 80%; margin-top:3em; left: 18%; width: 60%; margin-left: 100px;"></div>
		<form class="suscripcion" action="upload_Product.php" method="post" enctype="multipart/form-data" style=" margin-left: 260px">
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<!--<div class="etiqueta-roja">REGISTRO</div>-->
			<div class="etiqueta-roja" style="width: 100%;">
				<h1>AGREGAR NUEVO PRODUCTO</h1> 
			</div>
			<input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog ?>"></input>
		<input type="hidden" id="idNumeroProducto" name="idNumeroProducto" value="<?php echo $SiguienteProducto ?>"></input>

			<!--PRIMER BLOQUE-->
			<div style="width: 50%; height: 17em; margin-top: 5em;">
				<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_PRODUCTO_ESP" >Nombre del producto / Product name (Español)</h3>
				<input type="text" maxlength="100" id="NOMBRE_PRODUCTO_ESP" name="NOMBRE_PRODUCTO_ESP" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 215%;" placeholder="NOMBRE DEL PRODUCTO" required>
			
				<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_PRODUCTO_ING" >Nombre del prodcuto / Product name (Inglés)</h3>
				<input type="text" maxlength="100" id="NOMBRE_PRODUCTO_ING" name="NOMBRE_PRODUCTO_ING" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 215%;" class="campo-chico" placeholder="PRODUCT NAME"  required>

				<div style="margin-top: 5px;">
					<b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccione imagen del producto(.jpg):</b>
					<input type="file" name="uploadedFileProducto" accept="image/jpeg, image/png, image/jpg" required/>
					<img style="width: 50%;height: 100%;margin-right: 20%;margin-left: 20%;margin-bottom: 2%;" id="imagenPrev">
				</div>
			</div>

				<input id="adicionar" class="enviar" type="submit" name="Siguiente" style="margin-left: 500px;" value="Guardar producto">
		</form>
	</div>
</html>