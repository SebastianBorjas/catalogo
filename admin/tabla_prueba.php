<?php

////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
include("header.php");
include '../conexion.php';
include ("barra_lateral.php");
////////////////// VARIABLES DE CONSULTA////////////////////////////////////

$where="";
$numeroProceso=$_POST['xnumeroProceso'];
$nombreProceso=$_POST['xnombreProceso'];
$equipoDescripcion=$_POST['xequipoDescripcion'];
$cantidadEquipo=$_POST['xcantidadEquipo'];
$capacidad=$_POST['xcapacidad'];


////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar']))
{

	if (empty($_POST['xnumeroProceso'])) {
			if (empty($_POST['xnombreProceso'])) {
					if (empty($_POST['xequipoDescripcion'])) {
						if (empty($_POST['xcantidadEquipo'])) {
							if (empty($_POST['xcapacidad'])) {
									$where="where Pro.numeroProceso like '".$numeroProceso."%' and Pro.nombreProceso like '".$nombreProceso."%' and Pro.equipoDescripcion like '".$equipoDescripcion."%' and Pro.cantidadEquipo like '".$cantidadEquipo."%' and Pro.capacidad like '".$capacidad."%'";
									//$where = "where Pro.estatus = '1'";
							}else{
								$where="where Pro.capacidad like '".$capacidad."%'";
							}
						}else{
							$where="where Pro.cantidadEquipo like '".$cantidadEquipo."%'";
						}
					}else{
						$where="where Pro.equipoDescripcion like '".$equipoDescripcion."%'";
					}
			}else{
				$where="where Pro.nombreProceso like '".$nombreProceso."%'";	
			}
	}else{
		$where="where Pro.numeroProceso like '".$numeroProceso."%'";
	}


/*
	if (empty($_POST['xnumeroProceso']))
	{
		$where="where nombre like '".$nombre."%'";
	}

	else if (empty($_POST['xnombre']))
	{
		$where="where carrera='".$carrera."'";
	}

	else
	{
		$where="where nombre like '".$nombre."%' and carrera='".$carrera."'";
	}*/
}
/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////

$proceso="SELECT * FROM Empresa as Emp
    JOIN Proceso as Pro
    ON Emp.idEmpresa = Pro.idEmpresa $where";
$resProc = $db->query($proceso);
//$empresas="SELECT * FROM Empresa $where ";
$resProcesos=$db->query($proceso);

/*$query22 = $db->query("SELECT * FROM Empresa as Emp JOIN Proceso as Pro ON Emp.idEmpresa = Pro.idEmpresa where Pro.estatus = '1'");
$resultado2 = mysqli_fetch_array($query22);*/

if(mysqli_num_rows($resProc)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<!--<head>
		<title>Filtro de Búsqueda PHP</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	</head>-->
	<body>
		<header>
			<div class="alert alert-info" style="margin-left: 230px">
			<h2>Filtro de Búsqueda PHP</h2>
			</div>
		</header>
		<section>
			<form method="post" style="margin-left: 260px;">
				<input type="text" placeholder="Nombre..." name="xnombre"/>
				<!--<select name="xFiltro">
					<option value="">Proceso </option>
					<?
						while ($registroProcesos = $resProcesos->fetch_array(MYSQLI_BOTH))
						{
							echo '<option value="'.$registroProcesos['nombreProceso'].'">'.$registroProcesos['nombreProceso'].'</option>';
						}
					?>
				</select>-->

				<select name="xFiltro">
					<option value="">Filtrar por</option>
					<option value="nombreProceso">Nombre de proceso</option>
					<option value="equipoDescripcion">Descripción del equipo</option>
					<option value="capacidad">Capacidad</option>
				</select>
				<button name="buscar" type="submit">Buscar</button>
			</form>
			<table class="table">
				<tr class="bg-primary">
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">ID EMPRESA</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">RAZON SOCIAL</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">ACTIVIDAD PRINCIPAL</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">CONTACTO</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">TELÉFONO</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">CORREO</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">DIRECCIÓN</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF REDUCIDO</td>
					<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF COMPLETO</td>
				</tr>';

				<?php

				while ($registrosEmpresas = $resProc->fetch_array(MYSQLI_BOTH))
				{

					echo'<tr>
							<td class="text-center">'.$registrosEmpresas['idEmpresa'].'</td>
							<td class="text-center">'.$registrosEmpresas['nombreEmpresa'].'</td>
							<td class="text-center">'.$registrosEmpresas['actividadPrincipal'].'</td>
							<td class="text-center">'.$registrosEmpresas['nombre'].' '.$registrosEmpresas['apellido'].'</td>
							<td class="text-center">'.$registrosEmpresas['telefono'].'</td>
							<td class="text-center">'.$registrosEmpresas['correo'].'</td>
							<td class="text-center">$'.$registrosEmpresas['direccion'].'.00</td>
							<td class="text-center">
								<a class="btn btn-info" id="Validar" data-id="'.$registrosEmpresas["IdSocio"].'" style="background-color: #D72525;" ><font color="WHITE">PDF CORTO<span class="glyphicon glyphicon-download"></span></a>    
							</td>
					        <td class="text-center">
								<a class="btn btn-info" id="Validar" data-id="'.$registrosEmpresas["IdSocio"].'" style="background-color: #D72525;" ><font color="WHITE">PDF COMPLETO<span class="glyphicon glyphicon-download"></span></a>    
							</td>
							
					</tr>';
				}
				?>
			</table>

			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>