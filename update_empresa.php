<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require "PHPMailer-master/src/Exception.php";

include 'conexion.php';


$Fecha =  date("Y-m-d");

$razon_social1 = $_POST["RAZON_SOCIAL"];
$razon_social = strtoupper($razon_social1);
//echo $razon_social;
$direccion1 = $_POST["DIRECCION"];
$direccion =  strtoupper($direccion1);
//echo $direccion;
$sitio_web1 = $_POST["SITIO_WEB"];
$sitio_web =  strtoupper($sitio_web1);
//echo $sitio_web;
$actividad_principal1 = $_POST["ACTIVIDAD_PRINCIPAL"];
$actividad_principal =  strtoupper($actividad_principal1);
//echo $actividad_principal_esp;
/*$actividad_principal_ing1 = $_POST["ACTIVIDAD_PRINCIPAL_INGLÉS"];
$actividad_principal_ing = strtoupper($actividad_principal_ing1);*/
//echo $actividad_principal_ing;
$nombres1 = $_POST["NOMBRES"];
$nombres = strtoupper($nombres1);
//echo $nombres;
$correo1 = $_POST["CORREO"];
$correo = strtoupper($correo1);
//echo $correo;
$apellidos1 = $_POST["APELLIDO"];
$apellidos = strtoupper($apellidos1);
//echo $apellidos;
$telefono1 = $_POST["TELEFONO"];
$telefono = strtoupper($telefono1);
//echo $telefono;
$idEmpresa = $_POST["idEmpresa"];
//echo $idEmpresa;
$usuario = $_POST["USUARIO"];
$contrasena = $_POST["CONTRASEÑA"];
echo $contrasena;
$colonia1 = $_POST["COLONIA"];
$colonia =  strtoupper($colonia1);
$ciudad1 = $_POST["CIUDAD"];
$ciudad =  strtoupper($ciudad1);
$municipio1 = $_POST["MUNICIPIO"];
$municipio =  strtoupper($municipio1);
$estado1 = $_POST["ESTADO"];
$estado =  strtoupper($estado1);
$cp1 = $_POST["CP"];
$cp =  strtoupper($cp1);
$seccion1 = $_POST["COMBO_SECCION"];
$seccion =  strtoupper($seccion1);
$ramo1 = $_POST["COMBO_RAMO"];
$ramo =  strtoupper($ramo1);
$calle1 = $_POST["NOMBRE_CALLE"];
$calle =  strtoupper($calle1);
$numeroext1 = $_POST["NUMERO_EXT"];
$numeroext =  strtoupper($numeroext1);




//comprobacion datos duplicados
$stmtDis = $db->query("SELECT * FROM Empresa WHERE correo= '$correo' and idEmpresa= '$idEmpresa'");
$stmtComparacion = $db->query("SELECT * FROM Empresa WHERE idEmpresa <> '$idEmpresa'");

$resultado = mysqli_fetch_array($stmtDis);
$resultadoComparacion = mysqli_fetch_array($stmtComparacion);

//CONSULTAS DE VARIABLES DE EMPRESA EN BASE DE DATOS
$correoConsulta = $resultado['correo'];
$usuarioGuardado = $resultado['usuario'];
$claveGuardado = $resultado['contraseña'];
echo $claveGuardado;

//CONSULTAS DE VARIABLES DE EMPRESAS EN GENERAL PARA COMPARACIÓN 
$correoComparacion = $resultadoComparacion['correo'];

if(strcasecmp($usuarioGuardado, $usuario) !== 0){

     $sql=("UPDATE Empresa SET usuario ='$usuario' WHERE idEmpresa ='$idEmpresa'");
        $sentencia =mysqli_query($db,$sql) or die(mysqli_error());
        if($sentencia)
        {
                 echo '<script language="javascript">
                  alert("Modificaciones guardadas correctamente");
                  window.location="index.php";
                  </script>';            
        }
        else
            {
               echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='company_profile.php';</script>";
            }

  }

  if(strcasecmp($claveGuardado, $contrasena) !== 0){

     $sql=("UPDATE Empresa SET contraseña ='$contrasena'   WHERE idEmpresa ='$idEmpresa'");
        $sentencia =mysqli_query($db,$sql) or die(mysqli_error());
        if($sentencia)
        {
                 echo '<script language="javascript">
                  alert("Modificaciones guardadas correctamente");
                  window.location="index.php";
                  </script>';            
        }
        else
            {
               echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='company_profile.php';</script>";
            }

  }

if(strcasecmp($correoConsulta, $correo) !== 0){ 
  echo '<script language="javascript">
            alert("EL CORREO ELECTRÓNICO INGRESADO YA ESTÁ REGISTRADO EN EL SISTEMA");
          window.location="company_profile.php";
        </script>';
    
}else{


       //ESTABLECEMOS DESTINO DE LOS ARCHIVOS
$destino = 'ImagenesEmpresas/Logos';
//OBTENEMOS LA INFORMACIÓN DEL ARCHIVO ///////////////////////////////////// LOGO
$nombreLogo = $_FILES['uploadedFileLogo']['name'];
$tipo_Logo = $_FILES['uploadedFileLogo']['type'];
$tamano_Logo = $_FILES['uploadedFileLogo']['size'];
$guardadoLogo  = $_FILES['uploadedFileLogo']['tmp_name'];

//CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
$codigo_fecha = date("YmdHis");         
//$no_aleatorio = rand(100, 999); //GENERAMOS TRES DIGITOS PARA INCORPORARLO AL FINAL DEL CODIGO
$codigo = $idEmpresa.'-'.$Fecha.'-LOGO'; //CODIGO DE 17 DIGITOS

if (empty($nombreLogo)) {


  if(strcasecmp($usuarioGuardado, $usuario) == 0 || strcasecmp($claveGuardado, $contrasena) == 0){

     $sql=("UPDATE Empresa SET  nombreEmpresa = '$razon_social', actividadPrincipal ='$actividad_principal', nombre ='$nombres', apellido ='$apellidos', colonia ='$colonia', ciudad = '$ciudad', municipio = '$municipio', estado = '$estado', cp = '$cp', calle = '$calle', num_exterior = '$numeroext', seccion = '$seccion', ramo = '$ramo', telefono ='$telefono', correo ='$correo', sitioWeb ='$sitio_web'  WHERE idEmpresa ='$idEmpresa'");
        $sentencia =mysqli_query($db,$sql) or die(mysqli_error());
        if($sentencia)
        {
                 echo '<script language="javascript">
                  alert("Modificaciones guardadas correctamente");
                  window.location="company_profile.php";
                  </script>';            
        }
        else
            {
               echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='company_profile.php';</script>";
            }

  }else{

      $sql=("UPDATE Empresa SET  nombreEmpresa = '$razon_social', actividadPrincipal ='$actividad_principal', nombre ='$nombres', apellido ='$apellidos', colonia ='$colonia', ciudad = '$ciudad', municipio = '$municipio', estado = '$estado', cp = '$cp', calle = '$calle', num_exterior = '$numeroext', seccion = '$seccion', ramo = '$ramo', telefono ='$telefono', correo ='$correo', sitioWeb ='$sitio_web', usuario ='$usuario', contraseña ='$contrasena'   WHERE idEmpresa ='$idEmpresa'");
        $sentencia =mysqli_query($db,$sql) or die(mysqli_error());
        if($sentencia)
        {
               
                  //      $response['status']  = 'success';
                 // $response['message'] = '¡Modificaciones guardadas exitosamente!';

                //  echo "<script>alert('DATOS MODIFICADOS CORRECTAMENTE!!');window.location='index.php';</script>";
                  echo '<script language="javascript">
                  alert("Modificaciones guardadas correctamente");
                  window.location="index.php";
                  </script>';
                
        }
        else
            {
               // $response['status']  = 'error';
                  $response['message'] = 'Error , ¡porfavor intentelo en otro momento!';

              // echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='company_profile.php';</script>";
            }
    //echo json_encode($response);
        }
  }
  else{


            if(strcasecmp($usuarioGuardado, $usuario) == 0 or strcasecmp($claveGuardado, $contrasena) == 0){

                //RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
      list($nombre, $ext) = explode(".", $nombreLogo);
      $nombre_actual = "$codigo"."."."$ext" ;
      rename("ImagenesEmpresas/Logos/$nombreLogo","ImagenesEmpresas/Logos/$nombre_actual");


      if(!file_exists($destino)){
        mkdir($destino,0777,true);
         if (file_exists($destino)){
           if (move_uploaded_file($guardadoLogo, $destino.'/'.$nombreLogo)){
             echo "Archivo Guardado con Éxito";
           }else{
             echo "El Archivo no se pudo Guardar1";
           }
         }
      }else{
        if (move_uploaded_file($guardadoLogo, $destino.'/'.$nombreLogo)){
          echo "Archivo Guardado con Éxito";
        }else {
          echo "El Archivo no se pudo Guardar2";
        }
      }

      //RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
      list($nombre, $ext) = explode(".", $nombreLogo);
      $nombre_actual = "$codigo"."."."$ext" ;
      rename("ImagenesEmpresas/Logos/$nombreLogo","ImagenesEmpresas/Logos/$nombre_actual");

    $sql=("UPDATE Empresa SET  nombreEmpresa = '$razon_social', actividadPrincipal ='$actividad_principal', nombre ='$nombres', apellido ='$apellidos', colonia ='$colonia', ciudad = '$ciudad', municipio = '$municipio', estado = '$estado', cp = '$cp', calle = '$calle', num_exterior = '$numeroext', seccion = '$seccion', ramo = '$ramo', telefono ='$telefono', correo ='$correo', sitioWeb ='$sitio_web', logo ='$nombre_actual'  WHERE idEmpresa ='$idEmpresa'");
        $sentencia =mysqli_query($db,$sql) or die(mysqli_error());
        if($sentencia)
        {
               
                  //      $response['status']  = 'success';
                 // $response['message'] = '¡Proceso modificado exitosamente!';

                  echo "<script>alert('REGISTRO MODIFICADO CORRECTAMENTE CORRECTAMENTE, IMAGEN NUEVA INGRESADA!!');window.location='company_profile.php';</script>";
                
        }
        else
            {
               // $response['status']  = 'error';
               //   $response['message'] = 'Error , ¡porfavor intentelo en otro momento!';

               echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='company_profile.php';</script>";
            }
    //echo json_encode($response);

  }else{

      $sql=("UPDATE Empresa SET  nombreEmpresa = '$razon_social', actividadPrincipal ='$actividad_principal', nombre ='$nombres', apellido ='$apellidos', colonia ='$colonia', ciudad = '$ciudad', municipio = '$municipio', estado = '$estado', cp = '$cp', calle = '$calle', num_exterior = '$numeroext', seccion = '$seccion', ramo = '$ramo', telefono ='$telefono', correo ='$correo', sitioWeb ='$sitio_web', usuario ='$usuario', contraseña ='$contrasena', logo ='$nombre_actual'   WHERE idEmpresa ='$idEmpresa'");
        $sentencia =mysqli_query($db,$sql) or die(mysqli_error());
        if($sentencia)
        {
               
                  //      $response['status']  = 'success';
                 // $response['message'] = '¡Modificaciones guardadas exitosamente!';

                //  echo "<script>alert('DATOS MODIFICADOS CORRECTAMENTE!!');window.location='index.php';</script>";
                  echo '<script language="javascript">
                  alert("Modificaciones guardadas correctamente");
                  window.location="index.php";
                  </script>';
                
        }
        else
            {
               // $response['status']  = 'error';
                  $response['message'] = 'Error , ¡porfavor intentelo en otro momento!';

              // echo "<script>alert('NO SE LOGRÓ GUARDAR LA MODIFICACIÓN, INTENTELO MÁS TARDE!!');window.location='company_profile.php';</script>";
            }
    //echo json_encode($response);
        }
  }
  }



    
?>

