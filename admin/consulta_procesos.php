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
$query="SELECT * FROM Proceso ORDER BY idProceso";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
//alumnos es socios
if(isset($_POST['procesos']))
{
	$q=$conexion->real_escape_string($_POST['procesos']);
    $query= "SELECT Pr.idProceso, Em.nombreEmpresa, Pr.nombreProceso, Pr.equipoDescripcion, Pr.capacidad FROM Proceso as Pr INNER JOIN Empresa AS Em ON Pr.idEmpresa = Em.idEmpresa WHERE 
		Pr.nombreProceso LIKE '%".$q."%' or Pr.equipoDescripcion LIKE '".$q."%'";

    /*
	$query= "SELECT * FROM Proceso WHERE 
		nombreProceso LIKE '%".$q."%' or equipoDescripcion LIKE '".$q."%'";
		/*$query = "SELECT * FROM Empresa as Emp JOIN Proceso as Pro 
		ON Emp.idEmpresa = Pro.idEmpresa where Pro.nombreProceso like '".$q."%' or Pro.equipoDescripcion like '".$q."%'";*/
}

$buscarEmpresa=$conexion->query($query);
if ($buscarEmpresa->num_rows > 0)
{
	$tabla.= 
	'<table class="table">
		<tr class="bg-primary">
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">ID PROCESO</td>
            <td style="background-color: #221F43; color: #ffffff; text-align: center;">NOMBRE EMPRESA</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">NOMBRE / DESCRIPCIÓN</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">EQUIPO DESCRIPCIÓN</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">CAPACIDAD POR TURNO</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF REDUCIDO</td>
			<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF COMPLETO</td>
		</tr>';

	while($filasProceso= $buscarEmpresa->fetch_assoc())
	{
		$tabla.=
		'
		<tr>
		<td class="text-center">'.$filasProceso['idProceso'].'</td>
        <td class="text-center">'.$filasProceso['razon_social'].'</td>
		<td class="text-center">'.$filasProceso['nombreProceso'].'</td>
		<td class="text-center">'.$filasProceso['equipoDescripcion'].'</td>
		<td class="text-center">'.$filasProceso['capacidad'].'</td>
		<td class="text-center">
			<a class="btn btn-info" id="Validar" data-id="'.$filasProceso["idEmpresa"].'" style="background-color: #D72525;" ><font color="WHITE">PDF CORTO<span class="glyphicon glyphicon-download"></span></a>    
		</td>
        <td class="text-center">
			<a class="btn btn-info" id="ValidarFormato" data-id="'.$filasProceso["idEmpresa"].'" style="background-color: #D72525;" ><font color="WHITE">PDF COMPLETO<span class="glyphicon glyphicon-download"></span></a>    
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

