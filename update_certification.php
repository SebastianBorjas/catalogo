<?php
session_start();
include 'conexion.php';

$nombreCertificacion = $_POST["NOMBRE_CERTIFICACION"];
$idEmpresa = $_POST["idEmpresa"];
$numeroCertificacion = $_POST["idNumeroCertificacion"];
$imagenCertificacion = $_POST["imagen_certificacion"];
//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Certificaciones';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreImagen = $_FILES['updateFileCertificacion']['name'];
$tipo_Imagen = $_FILES['updateFileCertificacion']['type'];
$tamano_Imagen = $_FILES['updateFileCertificacion']['size'];
$guardadoImagen  = $_FILES['updateFileCertificacion']['tmp_name'];
//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         
$codigo = $idEmpresa.'-'.$numeroCertificacion.'-CERTIFICACION-'; //CODIGO DE 17 DIGITOS



//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreImagen);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Certificaciones/$nombreImagen","ImagenesEmpresas/Certificaciones/$nombre_actual");

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
rename("ImagenesEmpresas/Certificaciones/$nombreImagen","ImagenesEmpresas/Certificaciones/$nombre_actual");

if(isset($_POST['updateFileCertificacion']) && isset($_POST['NOMBRE_CERTIFICACION'])){
  $sql=("UPDATE Certificacion SET  nombre = '$nombreCertificacion'  WHERE numeroCertificacion='$numeroCertificacion' AND idEmpresa ='$idEmpresa'");
  $sentencia = $pdo->prepare($sql) or die($pdo->errorInfo());
  $sentencia->execute();
  if($sentencia){
    echo "<script>alert('REGISTRO MODIFICADO CORRECTAMENTE, NO SE INGRESÓ NUEVA IMAGEN!!');window.location='certifications_table.php?pagina=1';</script>";  
  }else{
    echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='certifications_table.php?pagina=1';</script>";
  }
} else{
    if($nombreImagen!=""){
      $sql2=("UPDATE Certificacion SET  nombre ='$nombreCertificacion', imagen ='$nombre_actual'  WHERE numeroCertificacion='$numeroCertificacion' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡REGISTRO MODIFICADO, SE INGRESÓ NUEVA IMAGEN!');window.location='certifications_table.php?pagina=1';</script>"; 
  } else{
      $sql2=("UPDATE Certificacion SET  nombre ='$nombreCertificacion', imagen ='$imagenCertificacion'  WHERE numeroCertificacion='$numeroCertificacion' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡SE MODIFICO CORRECTAMENTE!');window.location='certifications_table.php?pagina=1';</script>";
  }
}
?>