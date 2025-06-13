<!-- 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script src="paging.js"></script>
-->

<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
  $nombre = $_SESSION["USUARIO"];
  $clave = $_SESSION["PASSWORD"];
  

$query21 = $pdo->query("Select * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = $query21->fetch(PDO::FETCH_BOTH);
//$row = mysqli_fetch_assoc($query21);
$idEmpresaLog = $resultado['idEmpresa'];

?>

<head>
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">

  <script src="js/funciones.js"></script>
  <script src="librerias/alertifyjs/alertify.js"></script>
</head>

<body>
    <br>
<div style="margin-bottom: 1%; margin-left: 1%;">
<form method="post">
<div class="etiqueta-roja" style="width: 50%; margin-left: 260px">
        <h1 >PRODUCTOS REGISTRADOS</h1>
        </div>
</form> 
</div>
    <br>

<!----------------- TABLA------------->
<div>
<div class="table-responsive">
<!-- Table  -->
<table  class="table table-striped table-bordered" style="width:80%; margin-left:260px; " id="myTable"  cellpaddig="10">
  <!-- Table head -->
  <thead >
    <tr>
      
     <!-- <th class="text-center"><i  aria-hidden="true"></i>ID</th>-->
      <th class="text-center"><i  aria-hidden="true"></i>N°</th>
      <th class="text-center"><i  aria-hidden="true"></i>DESCRIPCIÓN</th>
      <th class="text-center"><i  aria-hidden="true"></i>IMAGEN</th>
      <th class="text-center"><i  aria-hidden="true"></i>MODIFICAR</th>


    </tr>
  </thead>
  <!-- Table head -->

  <!-- Table body -->
  <tbody>
        <?php
    //////////////Boton buscar/////////////
    if(isset($_POST['buscar']))
    {
        if(empty($_POST['xpago']))
        {
            $and=" AND EMPRESA like'".$nombre."%'";
        }
        else if (empty($_POST['myInput']))
        {
            $and=" AND PAGO='".$pago."'";
        }
        else
        {
            $and=" AND EMPRESA like'".$nombre."%'&& PAGO='".$pago."'";
        }
    }
    
      $resultado = $pdo -> query("SELECT * FROM Producto WHERE estatus='1' AND idEmpresa ='$idEmpresaLog'");
      if($resultado->fetchColumn() == 0)
      {
          $mensaje="<h1>NO HAY PRODUCTOS REGISTRADOS";
      }
      while($fila = $resultado -> fetch(PDO::FETCH_BOTH)){

        $datos=$fila[1]."||".
        $datos=$fila[2]."||".
        $datos=$fila[3]."||".
       /* $datos=$fila[4]."||".
        $datos=$fila[5]."||".
        $datos=$fila[6]."||".*/
        $datos=$fila[5];
       
      ?>
    <tr>
        <!--<td class="text-center"><?php echo $fila['idProducto'] ?></td>-->
        <td class="text-center"><?php echo $fila['numeroProducto'] ?></td>
        <td class="text-center"><?php echo $fila['descripcion'] ?></td>
        <td class="text-center"><img src=ImagenesEmpresas/Productos/<?php echo $fila['imagen'] ?> WIDTH="100" HEIGHT="100"></td>
        <td class="text-center"> 
                <a class="btn btn-sm btn-warning" id="update_process" href="edit_product.php?id=<?php echo $fila['numeroProducto'] ?>"><i class="glyphicon glyphicon-trash"></i>Modificar</a>
         </td>
        
    </tr>      
      <?php }
      echo $mensaje;
  ?>
  </tbody> 
  <!-- Table body -->
</table>
<!-- Table  -->

<!-- PAGINACION -->
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1222</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
<!-- PAGINACION -->

</div>
</div>

<!-- Modal Edición de Producto -->

<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <!-- Id de Producto -->
  <!--<label>ID</label>-->
    <input type="hidden"  name="" id="idProducto" class="form-control input-sm">

    <!-- Nombre del Producto -->
    <label>Nombre del Producto (Español e Inglés)</label>
    <textarea class="form-control" id="idNombreProducto" style="min-width: 100%"></textarea>
  
  <!-- Imagen de maquinara o equipo se realiza para hacer el Producto -->  
    <b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccione imágen del Producto(.jpg):</b>
    <input type="file"  name="idImagen" accept="image/jpg" required/>
      
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal" id="idActualizarProducto">Guardar cambios</button>
      </div>
    </div>
  </div>
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

<!-- 
<script>
  $(document).ready(function() {
    $('#myTable').paging({limit: 5});
  })
</script>
-->

</html>