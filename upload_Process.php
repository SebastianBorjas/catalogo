<?php
session_start();

/////Datos de conexion
include("conexion.php"); 


$numeroProceso = $_POST["idNumeroProceso"];
$nombreProceso_Esp = $_POST["NOMBRE_PROCESO_ESPAÑOL"];
$nombreProceso_Ing = $_POST["NOMBRE_PROCESO_INGLÉS"];
$equipoDescripcion_Esp = $_POST["EQUIPO_DESCRIPCION_ESPAÑOL"];
$equipoDescripcion_Ing = $_POST["EQUIPO_DESCRIPCION_INGLÉS"];
$cantidadEquipo = $_POST["CANTIDAD_EQUIPO"];
$cantidadOperadores = $_POST["CANTIDAD_OPERADORES"];
$capacidadTurno_Esp = $_POST["CAPACIDAD_TURNO_ESPAÑOL"];
$capacidadTurno_Ing = $_POST["CAPACIDAD_TURNO_INGLÉS"];
$idEmpresa = $_POST["idEmpresa"];


//CONCATENACIÓN DE VARIABLES PARA UNIR VERSIONES EN ESPAÑOL E INGLÉS
$nombreProcesoConcatenado = $nombreProceso_Esp.'/'.$nombreProceso_Ing;
$equipoDescripcionConcatenado = $equipoDescripcion_Esp.'/'.$equipoDescripcion_Ing;
$capacidadTurnoConcatenado = $capacidadTurno_Esp.'/'.$capacidadTurno_Ing;


//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Procesos';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreProceso = $_FILES['uploadedFileProceso']['name'];
$tipo_Proceso = $_FILES['uploadedFileProceso']['type'];
$tamano_Proceso = $_FILES['uploadedFileProceso']['size'];
$guardadoProceso  = $_FILES['uploadedFileProceso']['tmp_name'];


//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         

$codigo = $idEmpresa.'-'.$numeroProceso.'-PROCESO-'; //CODIGO DE 17 DIGITOS



//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreProceso);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Procesos/$nombreProceso","ImagenesEmpresas/Procesos/$nombre_actual");


if(!file_exists($destino)){
  mkdir($destino,0777,true);
   if (file_exists($destino)){
     if (move_uploaded_file($guardadoProceso, $destino.'/'.$nombreProceso)){
       echo "Archivo Guardado con Éxito";
     }else{
       echo "El Archivo no se pudo Guardar";
     }
   }
}else{
  if (move_uploaded_file($guardadoProceso, $destino.'/'.$nombreProceso)){
    echo "Archivo Guardado con Éxito";
  }else {
    echo "El Archivo no se pudo Guardar";
  }
}

//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreProceso);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Procesos/$nombreProceso","ImagenesEmpresas/Procesos/$nombre_actual");

$sql = ("INSERT INTO Proceso (numeroProceso, nombreProceso, equipoDescripcion, cantidadEquipo, capacidad, imagen, operadores,idEmpresa) 
        VALUES('$numeroProceso','$nombreProcesoConcatenado','$equipoDescripcionConcatenado','$cantidadEquipo','$capacidadTurnoConcatenado','$nombre_actual','$cantidadOperadores','$idEmpresa')");
$sentencia = $pdo->prepare($sql) or die($pdo->errorInfo());
$sentencia->execute();

if($sentencia)
	{
  	echo "<script>alert('REGISTRO REALIZADO CORRECTAMENTE!!');window.location='processes_table.php';</script>";
	}
	else
	{
		echo "<script>alert('Estamos teniendo problemas. Por favor intenta nuevamente!!');window.location='processes_table.php';</script>";
	}