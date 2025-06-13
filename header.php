<!DOCTYPE html>
<?php

include 'conexion.php';
//include ("barra_lateral.php");
    
  $nombre = $_SESSION["USUARIO"];
  $clave = $_SESSION["PASSWORD"];

$Fecha =  date("d-m-Y");
$hoy = getdate();

$bMeses = array("void","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$bDias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$fecha = getdate();

$dias = $bDias[$fecha["wday"]];
$day = $fecha["weekday"];
$month = $fecha["month"];
$daynum = $fecha["mday"];
$year = $fecha["year"];
$meses = $bMeses[$fecha["mon"]];

$actual = "Hoy es $dias ".$fecha["mday"]." de ".$meses." de ".$fecha["year"]."";
$actually = "Today is ".$day.", ".$month." ".$daynum.", ".$year."";

$query21 = $pdo->query("Select * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = $query21->fetch(PDO::FETCH_BOTH);
//$resultado = mysqli_fetch_array($query21);

?>
<html>
<head>
	<title>Catálogo empresa</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <META HTTP-EQUIV="Expires" CONTENT="-1">
  <link rel="stylesheet" type="text/css" href="style.css">
 <script src="https://use.fontawesome.com/7750d00bf0.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 
 <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.1/dist/sweetalert2.all.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

<nav id="nvartop" class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin-left: 230px; background-color: #00324b!important">
  <!-- Brand/logo 
  <a class="navbar-brand" href="inicio.php">
    <img src="Imagenes/LOGO-CANACINTRA DELEGACIÓN MONCLOVA BLANCO.png" alt="logo" style="width:100px;">
  </a>-->
  <!-- Links -->
 <!-- <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a style="width: max-content;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            PRODUCTOS
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="new_product.php">AGREGAR NUEVO PRODUCTO</a>
            <a class="dropdown-item" href="products_table.php">VER PRODUCTOS REGISTRADOS</a>
        </li>
        <li class="nav-item dropdown">
            <a style="width: max-content;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            PROCESOS
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="new_process.php">AGREGAR NUEVO PROCESO</a>
            <a class="dropdown-item" href="processes_table.php">VER PROCESOS REGISTRADOS</a>
        </li>
        <li class="nav-item dropdown">
            <a style="width: max-content;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            CLIENTES
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="new_customer.php">AGREGAR NUEVO CLIENTE</a>
            <a class="dropdown-item" href="customers_table.php">VER CLIENTES REGISTRADOS</a>
        </li>
        <li class="nav-item dropdown">
            <a style="width: max-content;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            CERTIFICACIONES
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="new_certification.php">AGREGAR NUEVA CERTIFICACIÓN</a>
            <a class="dropdown-item" href="certifications_table.php">VER CERTIFICACIONES REGISTRADAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="salir.php">SALIR</a>
        </li>
    </ul>-->
    
    
    <div style="width: 100%;color: white;font-family: inherit;font-weight: 500;font-size: 1.5rem;">
    <label><?php echo $resultado["nombreEmpresa"]; ?></label>
    </div>
    
    <div style="text-align: end;width: 100%;color: white;font-family: inherit;font-weight: 500;font-size: 1.5rem;">
     <label style="font-size: 1rem;"><?php echo $actual ?></label> / 
     <label style="font-size: 1rem;"><?php echo $actually ?></label>
    </div>
</nav>

