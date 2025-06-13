<?php
session_start();
include 'conexion.php';

$nombreProceso = $_POST["NOMBRE_PROCESO"];
$descripcionEquipo = $_POST["EQUIPO_DESCRIPCION"];
$cantidadOperadores = $_POST["CANTIDAD_OPERADORES"];
$capacidadTurno = $_POST["CAPACIDAD_TURNO"];
$cantidadEquipo = $_POST["CANTIDAD_EQUIPO"];
$idEmpresa = $_POST["idEmpresa"];
$numeroProceso = $_POST["idNumeroProceso"];
$imagenProducto = $_POST["imagen_producto"];
//ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Procesos';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreImagen = $_FILES['updateFileProceso']['name'];
$tipo_Imagen = $_FILES['updateFileProceso']['type'];
$tamano_Imagen = $_FILES['updateFileProceso']['size'];
$guardadoImagen  = $_FILES['updateFileProceso']['tmp_name'];
//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         
$codigo = $idEmpresa.'-'.$numeroProceso.'-PROCESO-'; //CODIGO DE 17 DIGITOS
//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreImagen);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Procesos/$nombreImagen","ImagenesEmpresas/Procesos/$nombre_actual");

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
    echo "El Archivo no se pudo guardar en el servidor, intentelo más tarde.";
  }
}
//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreImagen);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Procesos/$nombreImagen","ImagenesEmpresas/Procesos/$nombre_actual");

if(isset($_POST['updateFileProceso'])){
  $sql=("UPDATE Proceso SET  nombreProceso ='$nombreProceso', cantidadEquipo ='$cantidadEquipo', capacidad ='$capacidadTurno', operadores ='$cantidadOperadores', equipoDescripcion ='$descripcionEquipo'  WHERE idProceso='$numeroProceso' AND idEmpresa ='$idEmpresa'");
  $sentencia = $pdo->prepare($sql) or die($pdo->errorInfo());
  $sentencia->execute();
  if($sentencia){
    echo "<script>alert('REGISTRO MODIFICADO CORRECTAMENTE, NO SE INGRESÓ NUEVA IMAGEN!!');window.location='processes_table.php?pagina=1';</script>";  
  }else{
    echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='processes_table.php?pagina=1';</script>";
  }
} else{
    if($nombreImagen!=""){
      $sql2=("UPDATE Proceso SET  nombreProceso ='$nombreProceso', cantidadEquipo ='$cantidadEquipo', capacidad ='$capacidadTurno', operadores ='$cantidadOperadores', imagen ='$nombre_actual', equipoDescripcion ='$descripcionEquipo'  WHERE idProceso='$numeroProceso' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡REGISTRO MODIFICADO, SE INGRESÓ NUEVA IMAGEN!');window.location='processes_table.php?pagina=1';</script>"; 
  } else{
      $sql2=("UPDATE Proceso SET  nombreProceso ='$nombreProceso', cantidadEquipo ='$cantidadEquipo', capacidad ='$capacidadTurno', operadores ='$cantidadOperadores', imagen ='$imagenProducto', equipoDescripcion ='$descripcionEquipo'  WHERE idProceso='$numeroProceso' AND idEmpresa ='$idEmpresa'");
      $sentencia2 = $pdo->prepare($sql2) or die($pdo->errorInfo());
      $sentencia2->execute();

      echo "<script>alert('¡SE MODIFICO CORRECTAMENTE!');window.location='processes_table.php?pagina=1';</script>";
  }
}
?>