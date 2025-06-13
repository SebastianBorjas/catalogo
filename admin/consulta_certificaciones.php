<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////

$hostname_conexion = "localhost";
$username_conexion = "canacin8_proye20";
$password_conexion = "CDOufbu0fa!A";
$name = "canacin8_proyectos";
$conexion = new mysqli($hostname_conexion,$username_conexion,$password_conexion,$name,3306);
$conexion->set_charset('utf8');
if ($conexion -> connect_errno)
{
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
}



//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT * FROM Certificacion ORDER BY idCertificacion";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
//alumnos es socios
if(isset($_POST['certificaciones']))
{
	$q=$conexion->real_escape_string($_POST['certificaciones']);
	$query="SELECT * FROM Certificacion WHERE 
		nombre LIKE '%".$q."%' or idEmpresa LIKE '".$q."%'";
		/*$query = "SELECT * FROM Empresa as Emp JOIN Proceso as Pro 
		ON Emp.idEmpresa = Pro.idEmpresa where Pro.nombreProceso like '".$q."%' or Pro.equipoDescripcion like '".$q."%'";*/
}

$buscarEmpresa=$conexion->query($query);
if ($buscarEmpresa->num_rows > 0)
{
	$tabla.= 
	'<table class="table">
		<tr class="bg-primary">
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">ID CERTIFICACIÓN</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">NOMBRE</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">IMAGEN</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">ARCHIVO PDF</td>
		</tr>';

	while($filasCliente= $buscarEmpresa->fetch_assoc())
	{
		$tabla.=
		'
		<tr>
		<td class="text-center">'.$filasCliente['idCertificacion'].'</td>
		<td class="text-center">'.$filasCliente['nombre'].'</td>
		<td class="text-center"><img  style="width: 100px; height: 100px;" src=../ImagenesEmpresas/Certificaciones/'.$filasCliente['imagen'].' ></td>
		<td class="text-center">
			<a class="btn btn-info" id="Validar" data-id="'.$filasCliente["idEmpresa"].'" style="background-color: #D72525;" ><font color="WHITE"> GENERAR PDF <span class="glyphicon glyphicon-download"></span></a>    
		</td>
</tr> 
		';
	}

	$tabla.='</table>';
} else
	{
		$tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
	}


echo $tabla;


?>

