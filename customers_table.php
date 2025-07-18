<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
  $nombre = $_SESSION["USUARIO"];
  $clave = $_SESSION["PASSWORD"];
  

$query = $pdo->query("SELECT * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = $query->fetch(PDO::FETCH_BOTH);
$idEmpresaLog = $resultado['idEmpresa'];

$sql = ("SELECT * FROM Cliente WHERE estatus='1' AND idEmpresa ='$idEmpresaLog'");
$sentencia = $pdo->prepare($sql);
$sentencia->execute();

$resultado2 = $sentencia->fetchAll();

$clientes_x_pagina = 5;
$total_clientes_db = $sentencia->rowCount();
$paginas = $total_clientes_db/5;
$paginas = ceil($paginas);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">

    <script src="js/funciones.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
  </head>
  <body>
    <div >

      <br>
        <div style="margin-bottom: 1%; margin-left: 1%;">
          <form method="post">
            <div class="etiqueta-roja" style="width: 50%; margin-left: 380px">
              <h1>CLIENTES REGISTRADOS</h1>
            </div>
          </form> 
        </div>
      <br>

      <?php

        if(!$_GET){
          echo "<script> window.location='customers_table.php?pagina=1'; </script>";
        }
        if($_GET['pagina']<= 0){
          echo "<script> window.location='customers_table.php?pagina=1'; </script>";
        }
        if($_GET['pagina']>$paginas){
          echo "<script> window.location='customers_table.php?pagina=1'; </script>";
        }

        $iniciar = ($_GET['pagina']-1)*$clientes_x_pagina;

        $sql_clientes = ("SELECT * FROM Cliente WHERE estatus='1' AND idEmpresa ='$idEmpresaLog' LIMIT :iniciar,:nclientes");
        $sentencia_clientes = $pdo->prepare($sql_clientes);
        $sentencia_clientes->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
        $sentencia_clientes->bindParam(':nclientes', $clientes_x_pagina, PDO::PARAM_INT);
        $sentencia_clientes->execute();

        $resultado_clientes = $sentencia_clientes->fetchAll();
      ?>

      <table  class="table table-striped table-bordered" style="width:80%; margin-left:260px; " id="myTable"  cellpaddig="10">
        <thead>
          <tr>
            <th class="text-center"><i  aria-hidden="true"></i>N°</th>
            <th class="text-center"><i  aria-hidden="true"></i>NOMBRE</th>
            <th class="text-center"><i  aria-hidden="true"></i>LOGO</th>
            <th class="text-center"><i  aria-hidden="true"></i>MODIFICAR</th>
          </tr>
        </thead>
        <?php foreach($resultado_clientes as $costumers): ?>
          <tr>
            <td class="text-center"><?php echo $costumers['numeroCliente']?></td>
            <td class="text-center"><?php echo $costumers['nombre']?></td>
            <td class="text-center"><img src=ImagenesEmpresas/Clientes/<?php echo $costumers['logo'] ?> WIDTH="100" HEIGHT="100"></td>
            <td class="text-center"> 
              <a class="btn btn-sm btn-warning" id="update_process" href="edit_customer.php?id=<?php echo $costumers['numeroCliente'] ?>"><i class="glyphicon glyphicon-trash">Modificar</i></a><br><br>
              <a class="btn btn-sm btn-danger" id="delete_customer" onclick="preguntar()">Eliminar</a>
            </td>
          </tr>
        <?php endforeach ?>
      </table>

      <nav aria-label="Page navigation example" style="margin-left:45%">
        <ul class="pagination">
          <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>" style="margin-left:0px">
            <a class="page-link" href="customers_table.php?pagina=<?php echo $_GET['pagina']-1 ?>">
              Anterior
            </a>
          </li>

          <?php for($i=0;$i<$paginas;$i++): ?>
            <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
              <a class="page-link" href="customers_table.php?pagina=<?php echo $i + 1 ?>">
                <?php echo $i + 1 ?>
              </a>
            </li>
          <?php endfor ?>

          <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled':'' ?>">
            <a class="page-link" href="customers_table.php?pagina=<?php echo $_GET['pagina']+1 ?>">
              Siguiente
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </body>
</html>

<script>
function myFunction() {
 $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

});
}
</script>
<script type="text/javascript">
  $(document).ready(function(){
  });
</script>
<script type="text/javascript">
    function preguntar(){
      if(confirm("¿Estas seguro que desea eliminar este registro?")){
        window.location.href='delete_customer.php?id=<?php echo $costumers['numeroCliente']?>';
      }
    }
  </script>
</html>
