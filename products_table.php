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

$sql = ("SELECT * FROM Producto WHERE estatus='1' AND idEmpresa ='$idEmpresaLog'");
$sentencia = $pdo->prepare($sql);
$sentencia->execute();

$resultado2 = $sentencia->fetchAll();

$producto_x_pagina = 5;
$total_productos_db = $sentencia->rowCount();
$paginas = $total_productos_db/5;
$paginas = ceil($paginas);
//echo $paginas;
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />


    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">

    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/funciones.js"></script>
    <script src="librerias/alertifyjs/alertify.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  </head>
  <body>
    <div>

      <br>
        <div style="margin-bottom: 1%; margin-left: 1%;">
          <form method="post">
            <div class="etiqueta-roja" style="width: 50%; margin-left: 380px">
              <h1 >PRODUCTOS REGISTRADOS</h1>
            </div>
          </form> 
        </div>
      <br>

      <?php
        if(!$_GET){
          echo "<script> window.location='products_table.php?pagina=1'; </script>";
        }
        if($_GET['pagina']<= 0){
          echo "<script> window.location='products_table.php?pagina=1'; </script>";
        }
        if($_GET['pagina']>$paginas){
          echo "<script> window.location='products_table.php?pagina=1'; </script>";
        }

        $iniciar = ($_GET['pagina']-1)*$producto_x_pagina;

        $sql_productos = ("SELECT * FROM Producto WHERE estatus='1' AND idEmpresa ='$idEmpresaLog' LIMIT :iniciar,:nproductos");
        $sentencia_productos = $pdo->prepare($sql_productos);
        $sentencia_productos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
        $sentencia_productos->bindParam(':nproductos', $producto_x_pagina, PDO::PARAM_INT);
        $sentencia_productos->execute();

        $resultado_productos = $sentencia_productos->fetchAll();

      ?>

      <table  class="table table-striped table-bordered" style="width:80%; margin-left: 260px;" id="myTable"  cellpaddig="10">
        <thead>
          <tr>
            <th class="text-center"><i  aria-hidden="true"></i>N°</th>
            <th class="text-center"><i  aria-hidden="true"></i>DESCRIPCIÓN</th>
            <th class="text-center"><i  aria-hidden="true"></i>IMAGEN</th>
            <th class="text-center"><i  aria-hidden="true"></i>OPCIONES</th>
          </tr>
        </thead>
        <?php foreach($resultado_productos as $producto): ?>
          <tr>
            <td class="text-center"><?php echo $producto['numeroProducto']?></td>
            <td class="text-center"><?php echo $producto['descripcion']?></td>
            <td class="text-center"><img src=ImagenesEmpresas/Productos/<?php echo $producto['imagen'] ?> WIDTH="100" HEIGHT="100"></td>
            <td class="text-center"> 
              <a class="btn btn-sm btn-warning" id="update_product" href="edit_product.php?id=<?php echo $producto['numeroProducto'] ?>"><i>Modificar</i></a><br> <br>
              <a class="btn btn-sm btn-danger" id="delete_product" onclick="preguntar()">Eliminar</a>
            </td>
          </tr>
        <?php endforeach ?>
      </table>

      <nav aria-label="Page navigation example" style="margin-left:40%">
        <ul class="pagination">
          <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>">
            <a class="page-link" href="products_table.php?pagina=<?php echo $_GET['pagina']-1 ?>">
              Anterior
            </a>
          </li>

          <?php for($i=0;$i<$paginas;$i++): ?>
            <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
              <a class="page-link" href="products_table.php?pagina=<?php echo $i + 1 ?>">
                <?php echo $i + 1 ?>
              </a>
            </li>
          <?php endfor ?>

          <li class="page-item <?php echo $_GET['pagina']>=$paginas? 'disabled':'' ?>">
            <a class="page-link" href="products_table.php?pagina=<?php echo $_GET['pagina']+1 ?>">
              Siguiente
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </body>

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

      $('#idActualizarProducto').click(function(){
        actualizaDatos();
      });
    });
  </script>

  <script type="text/javascript">
    function preguntar(){
      if(confirm("¿Estas seguro que desea eliminar este registro?")){
        window.location.href='delete_product.php?id=<?php echo $producto['numeroProducto']?>';
      }
    }
  </script>
</html>