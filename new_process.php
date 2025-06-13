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

$query2 = $pdo->query("SELECT * from Proceso WHERE idEmpresa ='$idEmpresaLog' order by numeroProceso desc limit 1");
$resultado2 = $query2->fetch(PDO::FETCH_BOTH);
$query2->execute();
$NumeroProceso = $resultado2['numeroProceso'];
$SiguienteProceso = $NumeroProceso + '1';

$fila = $query2->fetch();
?>
<html>
<div id="contenedor" style="max-width: fit-content;">
<div class="puntos" style="height: 100%; margin-top:3em; left: 18%; width: 60%; margin-left: 100px;"></div>
    <form class="suscripcion" style="width: 100%; margin-left:260px;" action="upload_Process.php" method="post" enctype="multipart/form-data" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--<div class="etiqueta-roja">REGISTRO</div>-->
        <div class="etiqueta-roja" style="width: 35%;">
    <h1 > NUEVO PROCESO</h1>
    

        </div>

    <!--PRIMER BLOQUE-->
    <div style="width: 40%; float: left; height: 27em; margin-top: 5em;">
      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_PROCESO_ESPAÑOL" >Nombre del proceso (Español) (Máximo 30 carácteres)</h3>
      <input tabindex="1" type="text" maxlength="30" id="NOMBRE_PROCESO_ESPAÑOL" name="NOMBRE_PROCESO_ESPAÑOL" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="" required>
      <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog ?>"></input>
    <input type="hidden" id="idNumeroProceso" name="idNumeroProceso" value="<?php echo $SiguienteProceso ?>"></input>

      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="EQUIPO_DESCRIPCION_ESPAÑOL" >Descripción de equipo (Español)</h3>
      <input tabindex="3" type="text" maxlength="100" id="EQUIPO_DESCRIPCION_ESPAÑOL" name="EQUIPO_DESCRIPCION_ESPAÑOL" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder=""  >

      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CANTIDAD_EQUIPO" >Cantidad de equipos / Machine quantity</h3>
      <input tabindex="5" type="number" maxlength="100" id="CANTIDAD_EQUIPO" name="CANTIDAD_EQUIPO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 10em;" class="campo-chico" >

      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CANTIDAD_OPERADORES" >Cantidad de operadores por turno por maquina / Operators quantity per shift per machine</h3>
      <input tabindex="5" type="number" maxlength="100" id="CANTIDAD_OPERADORES" name="CANTIDAD_OPERADORES" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 10em;" class="campo-chico" >

    </div>

    <!--SEGUNDO BLOQUE-->
    <div style="width: 40%; float: left; height: 27em; margin-top: 5em;">
      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_PROCESO_INGLÉS" >Process description (Inglés) (Maximum 30 characters)</h3>
      <input tabindex="2" type="text" maxlength="30" id="NOMBRE_PROCESO_INGLÉS" name="NOMBRE_PROCESO_INGLÉS" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; width: 90%; margin-bottom: 10px;" placeholder="" required>
        
      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="EQUIPO_DESCRIPCION_INGLÉS" >Machine description (Inglés)</h3>
      <input tabindex="4" type="text" maxlength="100" id="EQUIPO_DESCRIPCION_INGLÉS" name="EQUIPO_DESCRIPCION_INGLÉS" style="text-transform:uppercase; margin-top: 5px; width: 90%; margin-bottom: 10px;" class="campo-chico" placeholder="">

    </div>

    

    <!--TERCER BLOQUE-->
    <div style="width: 40%; float: left; height: 20em;">
      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CAPACIDAD_TURNO" >Capacidad o kg por turno (Español)</h3>
      <input tabindex="7" type="text" maxlength="100" id="CAPACIDAD_TURNO_ESPAÑOL" name="CAPACIDAD_TURNO_ESPAÑOL" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="" >

      <div style="margin-top: 30px; width: max-content;">
        <b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccionar imagen de equipo que realiza el proceso(.jpg):</b>
        <input tabindex="6" type="file" name="uploadedFileProceso" accept=".jpeg, .jpg"/>
		<br><br>

      </div>

			<input class="enviar" type="submit" name="Siguiente" style="margin-left: 500px; font-size: inherit;" value="Registrar">

    </div>

    <!--CUARTO BLOQUE-->
    <div style="width: 40%; float: left; height: 20em;"> 
      <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CAPACIDAD_TURNO_ING" >Capacity per shift in kg or pcs (Inglés)</h3>
      <input tabindex="9" type="text" maxlength="100" id="CAPACIDAD_TURNO_INGLÉS" name="CAPACIDAD_TURNO_INGLÉS" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="" >
    </div>

  </form>
</div>

</html>