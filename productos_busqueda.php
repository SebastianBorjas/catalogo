<?php
session_start();
include("header.php");
include 'conexion.php';
include ("barra_lateral.php");
    
  $nombre = $_SESSION["USUARIO"];
  $clave = $_SESSION["PASSWORD"];


$query21 = $db->query("Select * From Empresa where usuario='$nombre' AND contraseña='$clave'");
$resultado = mysqli_fetch_array($query21);
$idEmpresaLog = $resultado['idEmpresa'];

$query22 = $db->query("Select * From Empresa where estatusPrivilegios='1' AND idEmpresa='$idEmpresaLog'");
$resultado2 = mysqli_fetch_array($query22);
$privilegios = $resultado2['estatusPrivilegios'];


//$SiguienteProceso = $NumeroProceso + '1';
//echo $SiguienteProceso;

?>
<html>
<div id="mensaje" style="visibility: visible; margin-left: 30em; width: 70%;" class="etiqueta-roja">
<h1 style="color: #ffffff; font-weight: normal;  font-size: 1.5rem;"> NO CUENTAS CON PERMISOS PARA VISUALIZAR EL CATÁLOGO / YOU DON'T HAVE PERMISSIONS TO VIEW THE CATALOG</h1>
<h2 style="color: #000000; font-weight: normal; font-size: 1.5rem"> CONTACTA AL EQUIPO DE CANACINTRA PARA QUE TE LO OTORGUEN</h2>
</div>
<div id="contenedor" style="max-width: fit-content; visibility: hidden; margin: 0;">
<div class="puntos" style="height: 100%; margin-top:3em; left: 18%; width: 60%; margin-left: 100px;"></div>
  <form class="suscripcion" style="width: 100%; margin-left:200px;" action="upload_Process.php" method="post" enctype="multipart/form-data" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--<div class="etiqueta-roja">REGISTRO</div>
    <div class="etiqueta-roja" style="width: 35%;">
       <h1 > NUEVO PROCESO</h1>
    </div>-->

    	<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="peticion_productos.js"></script>
<!----------------------------------------------------------------------------------------->
    
    <script src="js/tabletoExcel.js"></script>

    <link rel="stylesheet" type="text/css" href="sweetalert/sweetalert2.min.css">
    <script type="text/javascript" src="sweetalert/sweetalert2.min.js" ></script>
		
	</head>
	
	<body>
		<header>
			<div class="alert alert-info" style="margin-left: 230px">
			<h2>BASE DE DATOS DE PRODUCTOS REGISTRADOS</h2>
			</div>
		</header>

		<section style="height: 50px; margin-left: 260px;">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" style="width: 350px;">
		</section>
		<br><br>
		<section style="margin-left: 260px; width: 80%;" id="tabla_resultado">
		
		</section>

		<section id="tabla_resultado">
		
		</section>
    
      <input type="hidden" id="usuarioVigente"  name="usuarioVigente" value="<?php echo $privilegios ?>"></input>
   
  </form>
</div>

<script type="text/javascript">
	//visibility: hidden;
//	$(document).ready(function(){
	    
      var element = document.getElementById('usuarioVigente');

          if(typeof element !== "undefined" && element.value == '1'){
            document.getElementById('contenedor').style.visibility = "visible";
            document.getElementById('mensaje').style.visibility = "hidden";
          }else{
            document.getElementById('contenedor').style.visibility = "hidden";
            document.getElementById('mensaje').style.visibility = "visible";
          }
	           
  /*  });
  });*/

</script>

<script>
		function myFunction() {
		 $(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#busqueda tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
		}
		</script>
		<script>
			$(document).ready(function(){
				
				$(document).on('click', '#Validar', function(e){
					
					var id= $(this).data('id');
					SwalConfirmacion(id);
					e.preventDefault();
				});
		
				
			});
			
		
				
				function SwalConfirmacion(id){
				
				swal({
					title: '¿Generar PDF?',
					text: "Se generará el archivo PDF del registro seleccionado",
					type: 'info',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si, Generalo!',
					showLoaderOnConfirm: true,
					  
					preConfirm: function() {
					  return new Promise(function(resolve) {
						   
						 $.ajax({
							   url: 'Formato_productos.php',
							type: 'POST',
							   data: {'id':id},
							   dataType: 'json'
						 })
						 .done(function(response){
							 swal('Generado!', response.message, response.status);
							 window.open('ArchivosSocios/CATÁLOGO_CAPACIDADES_PRODUCTOS.pdf');
							 location.reload();
						 })
						 .fail(function(jqXHR,response){
							 swal('Oops...', 'Algo salió mal vuelve a intentarlo mas tarde', 'error');
							//console.log(jqXHR);
                            var responseText = jQuery.parseJSON(jqXHR.responseText);
                            console.log(responseText);
						 });
					  });
					},
					allowOutsideClick: false			  
				});	
				
			}
			
		</script>

</html>