<?php
session_start();
include("conexion.php"); 

$numeroCertificacion = $_POST["idNumeroCertificacion"];
$nombreCertificacion_Esp = $_POST["NOMBRE_CERTIFICACION_ESP"];
$nombreCertificacion_Ing = $_POST["NOMBRE_CERTIFICACION_ING"];
$idEmpresa = $_POST["idEmpresa"];
$imagenCertificacion = $_POST["imagen_certificacion"];
//CONCATENACIÓN DE VARIABLES PARA UNIR VERSIONES EN ESPAÑOL E INGLÉS
$nombreCertificacionConcatenado = $nombreCertificacion_Esp.'/'.$nombreCertificacion_Ing;

//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Certificaciones';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreCertificacion = $_FILES['uploadedFileCertificacion']['name'];
$tipo_Certificacion = $_FILES['uploadedFileCertificacion']['type'];
$tamano_Certificacion = $_FILES['uploadedFileCertificacion']['size'];
$guardadoCertificacion  = $_FILES['uploadedFileCertificacion']['tmp_name'];

//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         
//$no_aleatorio = rand(100, 999); //GENERAMOS TRES DIGITOS PARA INCORPORARLO AL FINAL DEL CODIGO
$codigo = $idEmpresa.'-'.$numeroCertificacion.'-CERTIFICACION-'; //CODIGO DE 17 DIGITOS


if(!file_exists($destino)){
  mkdir($destino,0777,true);
   if (file_exists($destino)){
     if (move_uploaded_file($guardadoCertificacion, $destino.'/'.$nombreCertificacion)){
      // echo "Archivo Guardado con Éxito";
     }else{
       echo "El Archivo no se pudo Guardar";
     }
   }
}else{
  if (move_uploaded_file($guardadoCertificacion, $destino.'/'.$nombreCertificacion)){
   // echo "Archivo Guardado con Éxito";
  }else {
    echo "El Archivo no se pudo Guardar";
  }
}

//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreCertificacion);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Certificaciones/$nombreCertificacion","ImagenesEmpresas/Certificaciones/$nombre_actual");



$sentencia = $pdo->prepare("INSERT INTO Certificacion (numeroCertificacion, nombre, imagen, idEmpresa) VALUES('$numeroCertificacion','$nombreCertificacionConcatenado','$nombre_actual','$idEmpresa')");

if($sentencia->execute())
	{
  	echo "<script>alert('CERTIFICACIÓN REGISTRADA CORRECTAMENTE!!');window.location='certifications_table.php?pagina=1';</script>";
	}
	else
	{
		echo "<script>alert('Estamos teniendo problemas. Por favor intenta nuevamente!!');window.location='certifications_table.php?pagina=1';</script>";
	}