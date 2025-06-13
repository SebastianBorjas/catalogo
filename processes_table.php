<?php
session_start();
include_once 'conexion.php';
include_once 'header.php';
include_once 'barra_lateral.php';

$nombre = $_SESSION["USUARIO"];
$clave = $_SESSION["PASSWORD"];

$query = $pdo->query("SELECT * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = $query->fetch(PDO::FETCH_BOTH);
$idEmpresaLog = $resultado['idEmpresa'];

$sql = ("SELECT * FROM Proceso WHERE estatus='1' AND idEmpresa ='$idEmpresaLog'");
$sentencia = $pdo->prepare($sql);
$sentencia->execute();

$resultado2 = $sentencia->fetchAll();

$procesos_x_pagina = 5;
$total_procesos_db = $sentencia->rowCount();
$paginas = $total_procesos_db/5;
$paginas = ceil($paginas);
//echo $paginas;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">

    <script src="js/funciones.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <body>
    <div>

      <br>
        <div style="margin-bottom: 1%; margin-left: 1%;">
          <form method="post">
            <div class="etiqueta-roja" style="width: 50%; margin-left: 380px">
              <h1>PROCESOS REGISTRADOS</h1>
            </div>
          </form> 
        </div>
      <br>

      <?php
          if(!$_GET){
            echo "<script> window.location='processes_table.php?pagina=1'; </script>";
          }
          if($_GET['pagina']<= 0){
            echo "<script> window.location='processes_table.php?pagina=1'; </script>";
          }
          if($_GET['pagina']>$paginas){
            echo "<script> window.location='processes_table.php?pagina=1'; </script>";
          }

          $iniciar = ($_GET['pagina']-1)*$procesos_x_pagina;

          $sql_procesos = ("SELECT * FROM Proceso WHERE estatus='1' AND idEmpresa ='$idEmpresaLog' LIMIT :iniciar,:nprocesos");
          $sentencia_procesos = $pdo->prepare($sql_procesos);
          $sentencia_procesos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
          $sentencia_procesos->bindParam(':nprocesos', $procesos_x_pagina, PDO::PARAM_INT);
          $sentencia_procesos->execute();

          $resultado_procesos = $sentencia_procesos->fetchAll();

        ?>
      <div class="">
        <table  class="table table-striped table-bordered" style="margin-left: 260px; width:80%;" id="myTable"  cellpaddig="10">
              <!-- Table head -->
              <thead >
                  <tr>
                  
                  <th class="text-center"><i  aria-hidden="true"></i>N°</th>
                  <th class="text-center"><i  aria-hidden="true"></i>NOMBRE</th>
                  <th class="text-center"><i  aria-hidden="true"></i>EQUIPO DESCRIPCIÓN</th>
                  <th class="text-center"><i  aria-hidden="true"></i>CANTIDAD EQUIPOS</th>
                  <th class="text-center"><i  aria-hidden="true"></i>CAPACIDAD</th>
                  <th class="text-center"><i  aria-hidden="true"></i>CANTIDAD OPERADORES</th>
                  <th class="text-center"><i  aria-hidden="true"></i>IMAGEN</th>
                  <th class="text-center"><i  aria-hidden="true"></i>MODIFICAR</th>

                  </tr>
              </thead>
              <?php foreach($resultado_procesos as $proceso): ?>
                <tr>
                  <td class="text-center"><?php echo $proceso['numeroProceso'] ?></td>
                  <td class="text-center"><?php echo $proceso['nombreProceso'] ?></td>
                  <td class="text-center"><?php echo $proceso['equipoDescripcion'] ?></td>
                  <td class="text-center"><?php echo $proceso['cantidadEquipo'] ?></td>
                  <td class="text-center"><?php echo $proceso['capacidad'] ?></td>
                  <td class="text-center"><?php echo $proceso['operadores'] ?></td>
                  <td class="text-center"><img src=ImagenesEmpresas/Procesos/<?php echo $proceso['imagen'] ?> WIDTH="100" HEIGHT="100"></td>
                  <td class="text-center"> 
                  <a class="btn btn-sm btn-warning" id="update_process" href="edit_process.php?id=<?php echo $proceso['idProceso'] ?>"><i class="glyphicon glyphicon-trash"></i>Modificar</a><br><br>
                  <a class="btn btn-sm btn-danger" id="delete_process" onclick="preguntar()">Eliminar</a>
                  </td>
                </tr> 
              <?php endforeach ?>
        </table>
      </div>
      <nav aria-label="Page navigation example" style="margin-left:45%">
        <ul class="pagination">
          <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>">
            <a class="page-link" href="processes_table.php?pagina=<?php echo $_GET['pagina']-1 ?>">
              Anterior
            </a>
          </li>

          <?php for($i=0;$i<$paginas;$i++): ?>
            <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
              <a class="page-link" href="processes_table.php?pagina=<?php echo $i + 1 ?>">
              <?php echo $i + 1 ?>
              </a>
            </li>
          <?php endfor ?>

          <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled':'' ?>">
            <a class="page-link" href="processes_table.php?pagina=<?php echo $_GET['pagina']+1 ?>">
              Siguiente
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </body>
  <script type="text/javascript">
    function preguntar(){
      if(confirm("¿Estas seguro que desea eliminar este registro?")){
        window.location.href='delete_proccess.php?id=<?php echo $proceso['numeroProceso']?>';
      }
    }
  </script>
</html>