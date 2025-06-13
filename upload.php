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
//echo $direccion;
$sitio_web1 = $_POST["SITIO_WEB"];
$sitio_web =  strtoupper($sitio_web1);
//echo $sitio_web;
$actividad_principal_esp1 = $_POST["ACTIVIDAD_PRINCIPAL_ESPAÑOL"];
$actividad_principal_esp =  strtoupper($actividad_principal_esp1);
//echo $actividad_principal_esp;
$actividad_principal_ing1 = $_POST["ACTIVIDAD_PRINCIPAL_INGLÉS"];
$actividad_principal_ing = strtoupper($actividad_principal_ing1);
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
$idEmpresa = $_POST["idNumeroEmpresa"];
//echo $idEmpresa;
//echo $telefono;



//comprobacion datos duplicados
$stmtDis = $db->query("SELECT * FROM Empresa WHERE correo= '$correo'");
//$stmtDis -> bindParam("ss", $razon_social, $correo);
//$stmtDis -> execute();
//$resultado = mysqli_fetch_array($stmtDis);
//$nombreEmpresa = $resultado['nombreEmpresa'];
//echo $nombreEmpresa;
//$correoConsulta = $resultado['correo'];
//echo $correoConsulta;
$rows=$stmtDis->num_rows;

if($rows>=1){ 
//if($nombreEmpresa == $razon_social || $correoConsulta == $correo){ 
  echo '<script language="javascript">
            alert("EL CORREO ELECTRÓNICO INGRESADO YA ESTÁ REGISTRADO EN EL SISTEMA");
      window.location="register.php";
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
//echo $codigo;



//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreLogo);
$nombre_actual = "$codigo"."."."$ext";
rename("ImagenesEmpresas/Logos/$nombreLogo","ImagenesEmpresas/Logos/$nombre_actual");


if(!file_exists($destino)){
  mkdir($destino,0777,true);
   if (file_exists($destino)){
     if (move_uploaded_file($guardadoLogo, $destino.'/'.$nombreLogo)){
       echo "Archivo Guardado con Éxito";
     }else{
       echo "El Archivo no se pudo Guardar";
     }
   }
}else{
  if (move_uploaded_file($guardadoLogo, $destino.'/'.$nombreLogo)){
    echo "Archivo Guardado con Éxito";
  }else {
    echo "El Archivo no se pudo Guardar";
  }
}

//RENOMBRAMOS EL ARCHIVO SUBIDO -- LOGO
list($nombre, $ext) = explode(".", $nombreLogo);
$nombre_actual = "$codigo"."."."$ext" ;
rename("ImagenesEmpresas/Logos/$nombreLogo","ImagenesEmpresas/Logos/$nombre_actual");


      $separador = "/";
      $actividadPrincipal = $actividad_principal_esp.$separador.$actividad_principal_ing;
      //$direccion = "calle ".$calle. "#".$numeroext.",".$colonia.",".$ciudad.",".$estado;

      $stmt = $GLOBALS['db']->prepare("INSERT INTO Empresa (
        nombreEmpresa,
        actividadPrincipal,
        nombre,
        apellido,
        colonia,
        ciudad,
        municipio,
        estado,
        cp,
        calle,
        num_exterior,
        seccion,
        ramo,
        telefono,
        correo,
        sitioWeb,
        logo,
        usuario,
        contraseña) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


      $stmt->bind_param("sssssssssssssssssss",
      $razon_social,
      $actividadPrincipal,
      $nombres,
      $apellidos,
      $colonia,
      $ciudad,
      $municipio,
      $estado,
      $cp,
      $calle,
      $numeroext,
      $seccion,
      $ramo,
      $telefono,
      $correo,
      $sitio_web,
      $nombre_actual,
      $correo,
      $telefono);

      if($stmt->execute())
        {
          /////////////////////email para registrado///////////////////////////////
        $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->Host ="canacintramonclova.org";
          $mail->SMTPAuth = true;
          $mail->Username = "noreplay@canacintramonclova.com";   
          $mail->Password = "!123456789A!";
          $mail->Port = 25;    
          $mail->From="noreplay@canacintramonclova.com";
          $mail->FromName = "CANACINTRA MONCLOVA";
          $mail->AddAddress("$correo","$razon_social");
          $mail->WordWrap = 25;
          $mail->CharSet = 'UTF-8';
          $mail->IsHTML(true);
          $mail->addAttachment("Imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png");
          $mail->Subject  =  "Catálogo de capacidades de empresas / Registro exitoso";
          $mail->Body     =  nl2br("Bienvenido/a $nombres $apellidos<br>
          Gracias por registrarse en el Catálogo de Productos y Capacidades de Empresas CANACINTRA.<br>
          
          Ingresa a tu perfil en el siguiente enlace https://www.canacintramonclova.com/apps/capacitycatalog/index.php
          para agregar tus procesos, productos, clientes y certificaciones<br>
          
          Estos son tus datos de acceso:<br>
          Usuario: $correo
          Clave: $telefono<br>
          ");
      
          
          
        /////////////////////////email para canacintra/////////////////
          $mail2 = new PHPMailer(true);
          // $mail2->SMTPDebug = 2;
          //$mail2->Debugoutput = 'html';
          $mail2->isSMTP();
          //$mail2->SMTPSecure = 'ssl'; ////
          $mail2->Host ="canacintramonclova.org";
          $mail2->SMTPAuth = true;
          $mail2->Username = "noreplay@canacintramonclova.com";  
          //$mail2->Username = "soporte@canacintramonclova.org";  
          $mail2->Password = "!123456789A!";
          //$mail2->Password = "!!Monclova!2021!!";
          $mail2->Port = 25;    
          $mail2->From="noreplay@canacintramonclova.com";
          $mail2->FromName = "CANACINTRA MONCLOVA";
        
          $mail2->AddAddress("soporte@canacintramonclova.org","Ing. Jesús Jazieel Ibarra Facundo");
          $mail2->WordWrap = 50;
          $mail2->IsHTML(true);
          $mail2->CharSet = 'UTF-8';
          //$mail2->addAttachment("admin/temp/PROMO1.jpg");
          $mail2->Subject  =  "NUEVO REGISTRO DE EMPRESA EN CATÁLOGO ";
          $mail2->Body     =  nl2br(" Nuevo registro en plataforma de Catálogo de Productos y Capacidades de Empresas Canacintra
          
          Datos de nuevo registro<br>

          Empresa: $razon_social
          Contacto: $nombres $apellidos
          Correo: $correo
          Teléfono: $telefono<br>
          <br>
          
          Estos son sus datos de acceso:<br>
          Usuario: $correo
          Clave: $telefono<br>
          ");
         
          $mail->send();
          $mail2->send();
        
          echo "<script>window.location='index.php';window.location='index.php';</script>";
          
        }
        else
        {
          echo "<script>alert('Estamos teniendo problemas. Por favor regresa más tarde!!');window.location='index.php';</script>";
        }
        $db->close();
     }
   
    
?>  