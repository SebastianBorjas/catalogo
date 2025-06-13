<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">

  <script src="librerias/alertifyjs/alertify.js"></script>
</head>
<body>
  
</body>
</html>
<?php
session_start();
include 'conexion.php';

$descripcionProducto = $_POST["descripcion_producto"];
$idEmpresa = $_POST["idEmpresa"];
$numeroProducto = $_POST["idNumeroProducto"];
$imagenProducto = $_POST["imagen_producto"];
//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Productos';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreImagen = $_FILES['updateFileProducto']['name'];
$tipo_Imagen = $_FILES['updateFileProducto']['type'];
$tamano_Imagen = $_FILES['updateFileProducto']['size'];
$guardadoImagen  = $_FILES['updateFileProducto']['tmp_name'];

//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         
$codigo = $idEmpresa.'-'.$numeroProducto.'-PRODUCTO-'; //CODIGO DE 17 DIGITOS
//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreImagen);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Productos/$nombreImagen","ImagenesEmpresas/Productos/$nombre_actual");

if(!file_exists($destino)){
  mkdir($destino,0777,true);
   if (file_exists($destino)){
     if (move_uploaded_file($guardadoImagen, $destino.'/'.$nombreImagen)){
      echo "Archivo Guardado con Éxito";
     }else{
       echo "El Archivo no se pudo guardar en el servidor, intentelo más tarde.";
     }
   }
}else{
  if (move_uploaded_file($guardadoImagen, $destino.'/'.$nombreImagen)){
   echo "Archivo Guardado con Éxito";
  }else {
    echo "El Archivo no se pudo guardar en el servidor, intenelo más tarde.";
  }
}
//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreImagen);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Productos/$nombreImagen","ImagenesEmpresas/Productos/$nombre_actual");

if(isset($_POST['updateFileProducto']) && isset($_POST['descripcion_producto'])){
  $sql=("UPDATE Producto SET  descripcion = '$descripcionProducto' WHERE numeroProducto='$numeroProducto' AND idEmpresa ='$idEmpresa'");
  $sentencia = $pdo->prepare($sql) or die($pdo->errorInfo());
  $sentencia->execute();
  if($sentencia){
    echo "<script>alert('REGISTRO MODIFICADO CORRECTAMENTE, NO SE INGRESÓ NUEVA IMAGEN!!');window.location='products_table.php?pagina=1';</script>";  
  }else{
    echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='products_table.php?pagina=1';</script>";
  }
} else{
    if($nombreImagen!=""){
      $sql2=("UPDATE Producto SET descripcion ='$descripcionProducto', imagen = '$nombre_actual' WHERE numeroProducto='$numeroProducto' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡REGISTRO MODIFICADO, SE INGRESÓ NUEVA IMAGEN!');window.location='products_table.php?pagina=1';</script>"; 
  } else{
      $sql2=("UPDATE Producto SET descripcion ='$descripcionProducto', imagen = '$imagenProducto' WHERE numeroProducto='$numeroProducto' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡SE MODIFICO CORRECTAMENTE!');window.location='products_table.php?pagina=1';</script>";
  }
}
?>