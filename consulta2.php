<?php
session_start();
include 'conexion.php';


$query="SELECT * FROM Empresa ORDER BY idEmpresa";
$sql = "SELECT * FROM Empresa";
$sentencia = $pdo->prepare($sql);
$sentencia -> execute();

$resultado = $sentencia->fetchAll();

$empresas_x_pagina = 10;

$total_empresas_db = $sentencia->rowCount();
$paginas = $total_empresas_db/10;
$paginas = ceil($paginas);

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['empresas']))
{
	$q = $_POST['empresas'];
	//$q2 = $_POST['producto'];
	$query = "SELECT * FROM Empresa WHERE 
		nombreEmpresa LIKE '%".$q."%' OR actividadPrincipal LIKE '%".$q."%' OR nombre LIKE '%".$q."%' OR apellido LIKE '%".$q."%' OR ramo LIKE '%".$q."%' OR telefono LIKE '%".$q."%'";

	//$query2 = "SELECT * FROM Producto WHERE descripcion LIKE '%".$q2."%' ";
}

$buscarEmpresa=$pdo->query($query);

if ($buscarEmpresa->rowCount() > 0){ 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  </head>
  <body>
    <div class="container">
		<table  class="table">
			<thead>
			<tr class = "bg-primary">
				<td style="background-color: #221F43; color: #ffffff; text-align: center;">No.</td>
				<td style="background-color: #221F43; color: #ffffff; text-align: center;">Nombre de la Empresa</td>
				<td style="background-color: #221F43; color: #ffffff; text-align: center;">ACTIVIDAD PRINCIPAL</td>
				<td style="background-color: #221F43; color: #ffffff; text-align: center;">CONTACTO</td>
				<td style="background-color: #221F43; color: #ffffff; text-align: center;">TELÉFONO</td>
				<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF REDUCIDO</td>
				<td style="background-color: #221F43; color: #ffffff; text-align: center;">GENERAR PDF COMPLETO</td>
			</tr>
			</thead>
			<?php while($consulta = $buscarEmpresa->fetch(PDO::FETCH_ASSOC)): ?>
			<tr>
				<td class="text-center"><?php echo $consulta['idEmpresa']?></td>
				<td class="text-center"><?php echo $consulta['nombreEmpresa']?></td>
				<td class="text-center"><?php echo $consulta['actividadPrincipal']?></td>
				<td class="text-center"><?php echo $consulta['nombre'].' '.$consulta['apellido']?></td>
				<td class="text-center"><?php echo $consulta['telefono']?></td>
				<td class="text-center">
					<a class="btn btn-info" id="Validar" href="Formato.php?id=<?php echo $consulta['idEmpresa'] ?>" data-id="<?php echo $consulta["idEmpresa"]?>" style="background-color: #D72525;" ><font color="WHITE">PDF CORTO<span class="glyphicon glyphicon-download"></span></a>
					<input type="hidden" id="id_empresa" name="id_empresa" value="<?php echo $consulta['idEmpresa']?>"></input>
				</td>
				<td class="text-center">
					<a class="btn btn-info" id="Validar2" href="Formato2.php?id=<?php echo $consulta['idEmpresa'] ?>" style="background-color: #D72525;" ><font color="WHITE">PDF COMPLETO<span class="glyphicon glyphicon-download"></span></a>   
                    <input type="hidden" id="id_empresa2" name="id_empresa2" value="<?php echo $consulta['idEmpresa']?>"></input>
				</td>
			</tr>
			<?php endwhile ?>
		</table>
	</div>
  </body>
</html>

<?php
} else
	{
		echo "No se encontraron coincidencias con sus criterios de búsqueda.";
	}
?>