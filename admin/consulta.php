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
$query="SELECT * FROM Empresa ORDER BY idEmpresa";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
//alumnos es socios
if(isset($_POST['empresas']))
{
	$q=$conexion->real_escape_string($_POST['empresas']);
	$query="SELECT * FROM Empresa WHERE 
		nombreEmpresa LIKE '%".$q."%'";
		/*$query = "SELECT * FROM Empresa as Emp JOIN Proceso as Pro 
		ON Emp.idEmpresa = Pro.idEmpresa where Pro.nombreProceso like
		 '".$q."%' or Pro.equipoDescripcion like '".$q."%'";*/
}

$buscarEmpresa=$conexion->query($query);
if ($buscarEmpresa->num_rows > 0)
{
	$tabla.= 
	'<table class="table">
		<tr class="bg-primary">
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">ID EMPRESA</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">RAZON SOCIAL</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">ACTIVIDAD PRINCIPAL</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">CONTACTO</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">TELÉFONO</td>
			<!--<td style="background-color: #221F43; color: #ffffff; text-align: center;">CORREO</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">DIRECCIÓN</td>-->
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF REDUCIDO</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF COMPLETO</td>
		</tr>';

	while($filasSocio= $buscarEmpresa->fetch_assoc())
	{
		$tabla.=
		'
		<tr>
		<td class="text-center">'.$filasSocio['idEmpresa'].'</td>
		<td class="text-center">'.$filasSocio['nombreEmpresa'].'</td>
		<td class="text-center">'.$filasSocio['actividadPrincipal'].'</td>
		<td class="text-center">'.$filasSocio['nombre'].' '.$filasSocio['apellido'].'</td>
		<td class="text-center">'.$filasSocio['telefono'].'</td>
		<!--<td class="text-center">'.$filasSocio['correo'].'</td>
		<td class="text-center">$'.$filasSocio['direccion'].'</td>-->
		<td class="text-center">
			<a class="btn btn-info" id="Validar" data-id="'.$filasSocio["idEmpresa"].'" style="background-color: #D72525;" ><font color="WHITE">PDF CORTO<span class="glyphicon glyphicon-download"></span></a>    
		</td>
        <td class="text-center">
			<a class="btn btn-info" id="Validar2" data-id="'.$filasSocio["idEmpresa"].'" style="background-color: #D72525;" ><font color="WHITE">PDF COMPLETO<span class="glyphicon glyphicon-download"></span></a>    
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

