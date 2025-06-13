<?php
session_start();
include("conexion.php"); 

$numeroProducto = $_POST["idNumeroProducto"];
$nombreProducto_Esp = $_POST["NOMBRE_PRODUCTO_ESP"];
$nombreProducto_Ing = $_POST["NOMBRE_PRODUCTO_ING"];
$idEmpresa = $_POST["idEmpresa"];

//CONCATENACIÓN DE VARIABLES PARA UNIR VERSIONES EN ESPAÑOL E INGLÉS
$nombreProductoConcatenado = $nombreProducto_Esp.'/'.$nombreProducto_Ing;

//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Productos';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreProducto = $_FILES['uploadedFileProducto']['name'];
$tipo_Producto = $_FILES['uploadedFileProducto']['type'];
$tamano_Producto = $_FILES['uploadedFileProducto']['size'];
$guardadoProducto  = $_FILES['uploadedFileProducto']['tmp_name'];

//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");
$codigo = $idEmpresa.'-'.$numeroProducto.'-PRODUCTO-'; //CODIGO DE 17 DIGITOS

//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreProducto);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Producto/$nombreProducto","ImagenesEmpresas/Producto/$nombre_actual");

if(!file_exists($destino)){
  mkdir($destino,0777,true);
   if (file_exists($destino)){
     if (move_uploaded_file($guardadoProducto, $destino.'/'.$nombreProducto)){
      echo "Archivo Guardado con Éxito";
     }else{
       echo "El Archivo no se pudo Guardar";
     }
   }
}else{
  if (move_uploaded_file($guardadoProducto, $destino.'/'.$nombreProducto)){
   echo "Archivo Guardado con Éxito";
  }else {
    echo "El Archivo no se pudo Guardar";
  }
}

//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreProducto);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Productos/$nombreProducto","ImagenesEmpresas/Productos/$nombre_actual");

$sql = ("INSERT INTO Producto (numeroProducto, descripcion, imagen, idEmpresa) VALUES('$numeroProducto','$nombreProductoConcatenado','$nombre_actual','$idEmpresa')");
$sentencia = $pdo->prepare($sql) or die($pdo->errorInfo());
$sentencia->execute();

if($sentencia)
	{
  	echo "<script>alert('PRODUCTO REGISTRADO CORRECTAMENTE!!');window.location='products_table.php?pagina=1';</script>";
	}
	else
	{
		echo "<script>alert('Estamos teniendo problemas. Por favor intenta nuevamente!!');window.location=products_table.php?pagina=1';</script>";
	}