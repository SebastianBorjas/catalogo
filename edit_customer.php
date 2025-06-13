<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
$nombre = $_SESSION["USUARIO"];
$clave = $_SESSION["PASSWORD"];

$id = $_GET['id'];
if(!$_GET){
  echo "<script> window.location='customers_table.php?pagina=1'; </script>";
}
if($_GET['id']<= 0){
  echo "<script> window.location='customers_table.php?pagina=1'; </script>";
}
if($_GET['id']>$id){
  echo "<script> window.location='customers_table.php?pagina=1'; </script>";
}

if(isset($_GET['id'])){
  $id = $_GET['id'];

  $query = $pdo->query("SELECT * FROM Empresa WHERE usuario='$nombre' AND contraseña='$clave'");
  $resultado = $query->fetch(PDO::FETCH_BOTH);
  $idEmpresaLog = $resultado['idEmpresa'];

  $query2 = $pdo->prepare("SELECT * FROM Cliente WHERE idEmpresa ='$idEmpresaLog' AND numeroCliente = '$id'");
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
        <div class="puntos" style="height: 100%; margin-top:3em; width: 60%;"></div>
        <form class="suscripcion" style="width: 80%; margin-left: 260px; " action="update_customer.php" method="post" enctype="multipart/form-data" >
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <div class="etiqueta-roja" style="width: 35%; margin-left: 100px;">
            <h1>EDITAR CLIENTE</h1>
          </div>
          <div style="width: 80%;float: left;margin-left: 100px;height: 100%;margin-top: 5em;">
            <h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_CLIENTE" >Nombre de la industria a la que pertenece el cliente / Name of the industry to which the client belongs  (Español e Inglés)</h3>
            <textarea tabindex="1" type="text" maxlength="100" id="NOMBRE_CLIENTE" name="NOMBRE_CLIENTE" style="text-transform:uppercase; width: 90%; margin-top: 5px; margin-bottom: 10px;" rows="3" cols="50" class="campo-chico" placeholder=""  required><?php echo $fila['nombre'] ?></textarea>
            <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog?>"></input>
            <input type="hidden" id="idNumeroCliente" name="idNumeroCliente" value="<?php echo $id?>"></input>

            <div style="">
              <img style="width: 50%;height: 100%;margin-right: 20%;margin-left: 20%;margin-bottom: 2%;" src=ImagenesEmpresas/Clientes/<?php echo $fila['logo'] ?> >
              <input type="hidden" id="logo_cliente" name="logo_cliente" value="<?php echo $fila['logo']?>"></input>
              <b style="font-family:'Work Sans', sans-serif; color: #444;"><br>Seleccionar logo del cliente(.png):</b>
              <input tabindex="6" type="file" name="updateFileCliente" accept="image/jpeg, image/png, image/jpg" />
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