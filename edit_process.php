<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
$nombre = $_SESSION["USUARIO"];
$clave = $_SESSION["PASSWORD"];

$id = $_GET['id'];
if(!$_GET){
  echo "<script> window.location='processes_table.php?pagina=1'; </script>";
}
if($_GET['id']<= 0){
  echo "<script> window.location='processes_table.php?pagina=1'; </script>";
}
if($_GET['id']>$id){
  echo "<script> window.location='processes_table.php?pagina=1'; </script>";
}

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $query = $pdo->query("SELECT * FROM Empresa WHERE usuario='$nombre' AND contraseña='$clave'");
  $resultado = $query->fetch(PDO::FETCH_BOTH);
  $idEmpresaLog = $resultado['idEmpresa'];

  $query2 = $pdo->prepare("SELECT * FROM Proceso WHERE idEmpresa ='$idEmpresaLog' AND numeroProceso = '$id'");
  $resultado2 = $query2->fetch(PDO::FETCH_BOTH);
  $query2->execute();

  if($query2->rowCount()>=1){
    $fila = $query2->fetch();
?>

<html>
  <div id="contenedor" style="max-width: fit-content; height: 100%">
    <div class="puntos" style="height: 150%; margin-top:3em; width: 60%;"></div>
    <form class="suscripcion" style="width: 80%; margin-left: 260px;" action="update_processv2.php" method="post" enctype="multipart/form-data" >
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      <div class="etiqueta-roja" style="width: 35%;">
        <h1>EDITAR PROCESO</h1>
      </div>

      <div style="width: 50%; float: left; height: 100%; margin-top: 5em;">
        <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_PROCESO" >Nombre del proceso / Process description (Español e Inglés)</h3>
        <textarea tabindex="1" type="text" maxlength="100" id="NOMBRE_PROCESO" name="NOMBRE_PROCESO" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" rows="3" cols="50" class="campo-chico" placeholder=""  required><?php echo $fila['nombreProceso'] ?></textarea>
        <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog?>"></input>
        <input type="hidden" id="idNumeroProceso" name="idNumeroProceso" value="<?php echo $id ?>"></input>

        <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="EQUIPO_DESCRIPCION" >Descripción de equipo / Machine description (Español e Inglés)</h3>
        <textarea tabindex="3" type="text" maxlength="100" id="EQUIPO_DESCRIPCION" name="EQUIPO_DESCRIPCION" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" rows="3" cols="50" class="campo-chico" placeholder=""   required><?php echo $fila['equipoDescripcion'] ?></textarea>


        <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CANTIDAD_OPERADORES" >Cantidad de operadores por turno por maquina / Operators quantity per shift per machine</h3>
        <input tabindex="5" type="number" min="0" maxlength="100" id="CANTIDAD_OPERADORES" name="CANTIDAD_OPERADORES" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 10em;" class="campo-chico" value="<?php echo $fila['operadores'] ?>" >

        <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CANTIDAD_EQUIPO" >Cantidad de equipos / Machine quantity</h3>
        <input tabindex="5" type="number" min="0" maxlength="100" id="CANTIDAD_EQUIPO" name="CANTIDAD_EQUIPO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 10em;" class="campo-chico" value="<?php echo $fila['cantidadEquipo'] ?>">
      </div>

      <div style="width: 50%; float: left; height: 100%; margin-top: 5em;">
        <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CAPACIDAD_TURNO" >Capacidad o kg por turno / Capacity per shift in kg or pcs (Español e Inglés)</h3>
        <textarea tabindex="7" type="text" maxlength="100" id="CAPACIDAD_TURNO" name="CAPACIDAD_TURNO" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" rows="3" cols="50" class="campo-chico" placeholder=""><?php echo $fila['capacidad'] ?></textarea>
            
        <div style="">
          <img style="width: 50%;height: 100%;margin-right: 20%;margin-left: 20%;margin-bottom: 2%;" src=ImagenesEmpresas/Procesos/<?php echo $fila['imagen'] ?> ><br><br>
          <input type="hidden" id="imagen_producto" name="imagen_producto" value="<?php echo $fila['imagen']?>"></input>
            <b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccionar imagen 1 del equipo que realiza el proceso(.jpg):</b>
            <input tabindex="6" type="file" name="updateFileProceso" accept="image/jpeg" /><br><br>
        </div>
      </div>
      <input class="enviar" type="submit" name="Siguiente" style="margin-left: 35%;" value="Guardar cambios">
    </form>
  </div>
</html>

<?php
  }else{
    echo "Ocurrio un error";
  }
}else{
  echo "Error, No se pudo ejecutar su consulta";
}
?>