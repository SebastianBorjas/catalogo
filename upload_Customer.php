<?php
session_start();
include("conexion.php"); 


$numeroCliente = $_POST["idNumeroCliente"];
$nombreCliente_Esp = $_POST["NOMBRE_INDUSTRIA_CLIENTE_ESP"];
$nombreCliente_Ing = $_POST["NOMBRE_INDUSTRIA_CLIENTE_ING"];
$idEmpresa = $_POST["idEmpresa"];

//CONCATENACIÓN DE VARIABLES PARA UNIR VERSIONES EN ESPAÑOL E INGLÉS
$nombreClienteConcatenado = $nombreCliente_Esp.'/'.$nombreCliente_Ing;

//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Clientes';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreCliente = $_FILES['uploadedFileLogoCliente']['name'];
$tipo_Cliente = $_FILES['uploadedFileLogoCliente']['type'];
$tamano_Cliente = $_FILES['uploadedFileLogoCliente']['size'];
$guardadoCliente  = $_FILES['uploadedFileLogoCliente']['tmp_name'];

//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         
$codigo = $idEmpresa.'-'.$numeroCliente.'-CLIENTE-'; //CODIGO DE 17 DIGITOS


if(!file_exists($destino)){
  mkdir($destino,0777,true);
   if (file_exists($destino)){
     if (move_uploaded_file($guardadoCliente, $destino.'/'.$nombreCliente)){
       echo "Archivo Guardado con Éxito";
     }else{
       echo "El Archivo no se pudo Guardar";
     }
   }
}else{
  if (move_uploaded_file($guardadoCliente, $destino.'/'.$nombreCliente)){
    echo "Archivo Guardado con Éxito";
  }else {
    echo "El Archivo no se pudo Guardar";
  }
}

//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreCliente);
$nombre_actual = "$codigo"."."."jpg" ;
rename("ImagenesEmpresas/Clientes/$nombreCliente","ImagenesEmpresas/Clientes/$nombre_actual");



$sentencia = $pdo->prepare("INSERT INTO Cliente (numeroCliente, nombre, logo, idEmpresa) VALUES('$numeroCliente','$nombreClienteConcatenado','$nombre_actual','$idEmpresa')");


if($sentencia->execute())
	{
  	echo "<script>alert('CLIENTE REGISTRADO CORRECTAMENTE!!');window.location='customers_table.php?pagina=1';</script>";
	}
	else
	{
		echo "<script>alert('Estamos teniendo problemas. Por favor intenta nuevamente!!');window.location='customers_table.php?pagina=1';</script>";
	}
?>