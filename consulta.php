<?php
session_start();


include 'conexion.php';




//////////////// VALORES INICIALES ///////////////////////

$label="";
//$query="SELECT * FROM Empresa ORDER BY IdEmpresa";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
//alumnos es socios
if(isset($_POST['correo']))
{
	$q=$conexion->real_escape_string($_POST['correo']);
	$query="SELECT * FROM Empresa WHERE 
		correo LIKE '%".$q."%'";
}

$buscarCorreo=$conexion->query($query);
if ($buscarCorreo->num_rows > 0)
{
	$label='<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="CORREO" >ESTE CORREO YA ESTÁ REGISTRADO EN EL SISTEMA</h3>';

} else
	{
		$label="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $label;


?>

