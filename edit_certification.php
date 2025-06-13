<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
$nombre = $_SESSION["USUARIO"];
$clave = $_SESSION["PASSWORD"];

$id = $_GET['id'];
if(!$_GET){
  echo "<script> window.location='certifications_table.php?pagina=1'; </script>";
}
if($_GET['id']<= 0){
  echo "<script> window.location='certifications_table.php?pagina=1'; </script>";
}
if($_GET['id']>$id){
  echo "<script> window.location='certifications_table.php?pagina=1'; </script>";
}

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $query = $pdo->query("SELECT * FROM Empresa WHERE usuario='$nombre' AND contraseña='$clave'");
  $resultado = $query->fetch(PDO::FETCH_BOTH);
  $idEmpresaLog = $resultado['idEmpresa'];

  $query2 = $pdo->prepare("SELECT * FROM Certificacion WHERE idEmpresa ='$idEmpresaLog' AND numeroCertificacion = '$id'");
  $resultado2 = $query2->fetch(PDO::FETCH_BOTH);
  $query2->execute();

  $id = $_GET['id'];
  if(!$_GET){
    echo "<script> window.location='products_table.php?pagina=1'; </script>";
  }
  if($_GET['id']<= 0){
    echo "<script> window.location='products_table.php?pagina=1'; </script>";
  }
  if($_GET['id']>$id){
    echo "<script> window.location='products_table.php?pagina=1'; </script>";
  }


  if($query2->rowCount()>=1){
    $fila = $query2->fetch();

?>
<html>
  <div id="contenedor" style="max-width: fit-content;">
  <div class="puntos" style="height: 120%; margin-top:3em; width: 60%;"></div>
    <form class="suscripcion" style="width: 100%; margin-left: 0px;" action="update_certification.php" method="post" enctype="multipart/form-data" >
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <div class="etiqueta-roja" style="width: 100%; margin-left: 0px;">
        <h1>EDITAR CERTIFICACIÓN</h1>
      </div>
      <div style="width: 100%;float: left;margin-left: 0px;margin-top: 5em; height: 100%">
        <h3 class="titulo-rojo" style="margin-top: 10px; margin-left: 13%; color: #6d6b6b" for="NOMBRE_CERTIFICACION" >Nombre de la certification / name of certification(Español e Inglés)</h3>
        <textarea tabindex="1" type="text" maxlength="100" id="NOMBRE_CERTIFICACION" name="NOMBRE_CERTIFICACION" style="text-transform:uppercase; width: 90%;margin-left: 5%; margin-top: 5px; margin-bottom: 10px;" rows="3" cols="50" class="campo-chico" placeholder=""  required><?php echo $fila['nombre'] ?></textarea>
        <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog?>"></input>
        <input type="hidden" id="idNumeroCertificacion" name="idNumeroCertificacion" value="<?php echo $id?>"></input>

        <div style="">
          <img style="width: 100%;height: 100%;margin-right: 0%;margin-left: 0%;margin-bottom: 1%; margin-top: 3%;" src=ImagenesEmpresas/Certificaciones/<?php echo $fila['imagen'] ?>>
          <input type="hidden" id="imagen_certificacion" name="imagen_certificacion" value="<?php echo $fila['imagen']?>"></input>
          <b style="font-family:'Work Sans', sans-serif; color: #444;"><br>Seleccionar imagen de la certificación(.jpg):</b>
          <input tabindex="6" type="file" name="updateFileCertificacion" accept="image/jpeg" />
        </div>

        <input class="enviar" type="submit" name="Siguiente" style="margin-left: 35%;" value="Guardar cambios">
      </div>
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