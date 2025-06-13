<?php
session_start();
include 'conexion.php';

$nombreCliente = $_POST["NOMBRE_CLIENTE"];
$idEmpresa = $_POST["idEmpresa"];
$numeroCliente = $_POST["idNumeroCliente"];
$logoCliente = $_POST["logo_cliente"];
//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Clientes';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreImagen = $_FILES['updateFileCliente']['name'];
$tipo_Imagen = $_FILES['updateFileCliente']['type'];
$tamano_Imagen = $_FILES['updateFileCliente']['size'];
$guardadoImagen  = $_FILES['updateFileCliente']['tmp_name'];
//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         
$codigo = $idEmpresa.'-'.$numeroCliente.'-Cliente-'; //CODIGO DE 17 DIGITOS
//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreImagen);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Clientes/$nombreImagen","ImagenesEmpresas/Clientes/$nombre_actual");

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
rename("ImagenesEmpresas/Clientes/$nombreImagen","ImagenesEmpresas/Clientes/$nombre_actual");

if(isset($_POST['updateFileCliente']) && isset($_POST['NOMBRE_CLIENTE'])){
  $sql=("UPDATE Cliente SET nombre ='$nombreCliente' WHERE numeroCliente='$numeroCliente' AND idEmpresa ='$idEmpresa'");
  $sentencia = $pdo->prepare($sql) or die($pdo->errorInfo());
  $sentencia->execute();
  if($sentencia){
    echo "<script>alert('REGISTRO MODIFICADO CORRECTAMENTE, NO SE INGRESÓ NUEVA IMAGEN!!');window.location='customers_table.php?pagina=1';</script>";  
  }else{
    echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='customers_table.php?pagina=1';</script>";
  }
} else{
    if($nombreImagen!=""){
      $sql2=("UPDATE Cliente SET nombre ='$nombreCliente', logo ='$nombre_actual' WHERE numeroCliente='$numeroCliente' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡REGISTRO MODIFICADO, SE INGRESÓ NUEVA IMAGEN!');window.location='customers_table.php?pagina=1';</script>"; 
  } else{
      $sql2=("UPDATE Cliente SET nombre ='$nombreCliente', logo ='$logoCliente' WHERE numeroCliente='$numeroCliente' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡SE MODIFICO CORRECTAMENTE!');window.location='customers_table.php?pagina=1';</script>";
  }
}
?>