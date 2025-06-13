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

$query2 = $pdo->query("SELECT * From Empresa where estatusPrivilegios='1' AND idEmpresa='$idEmpresaLog'");
$resultado2 = $query2->fetch(PDO::FETCH_BOTH);
$privilegios = $resultado2['estatusPrivilegios'];

$sql = "SELECT * FROM Empresa";
$sentencia = $pdo->prepare($sql);
$sentencia -> execute();

$resultado = $sentencia->fetchAll();

$empresas_x_pagina = 10;

$total_empresas_db = $sentencia->rowCount();
$paginas = $total_empresas_db/10;
$paginas = ceil($paginas);

?>

<html>

	<div id="mensaje" style="visibility: visible; margin-left: 30em; width: 70%;" class="etiqueta-roja">
		<h1 style="color: #ffffff; font-weight: normal;  font-size: 1.5rem;"> NO CUENTAS CON PERMISOS PARA VISUALIZAR EL CATÁLOGO / YOU DON'T HAVE PERMISSIONS TO VIEW THE CATALOG</h1>
		<h2 style="color: #000000; font-weight: normal; font-size: 1.5rem"> CONTACTA AL EQUIPO DE CANACINTRA PARA QUE TE LO OTORGUEN</h2>
	</div>
	<div id="contenedor" style="max-width: fit-content; visibility: hidden; margin: 0;">
		<form class="suscripcion" style="width: 100%; margin-left:200px;" action="upload_Process.php" method="post" enctype="multipart/form-data" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />

			<head>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
				<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
				<script src="peticion.js"></script>
				<!----------------------------------------------------------------------------------------->
				<script src="js/tabletoExcel.js"></script>
				<meta lang="es">
				<meta charset="UTF-8">
				<link rel="stylesheet" type="text/css" href="sweetalert/sweetalert2.min.css">
				<script type="text/javascript" src="sweetalert/sweetalert2.min.js" ></script>
			</head>
			
			<body>
				<div class="" style="margin-left:100px;">
					<header>
						<div class="alert alert-info" style="width:50%; margin-left: 380px;">
							<h2>BASE DE DATOS DE EMPRESAS REGISTRADAS</h2>
						</div>
					</header>
					<br>
                    <div>
                        <a href="Formato4.php" class="btn btn-info" style="background-color: #D72525; margin-left:50%;  position: absolute;"><font color="WHITE">Generar Catalogo Corto</a>
					    <a href="Formato3.php" class="btn btn-info" style="background-color: #D72525; margin-left:66.4%;  position: absolute;"><font color="WHITE">Generar Catalogo Completo</a>
                    </div>

					<section style="height: 50px; ">
						<input autocomplete="off" type="text" onClick="return anular(); return true" name="busqueda" id="busqueda" placeholder="Buscar..." style="width: 350px; margin-left:35px;">
					</section>

					<section style=" width: 90%;" id="tabla_resultado">
					
					</section>

					<section id="tabla_resultado">
					
					</section>

					<input type="hidden" id="usuarioVigente"  name="usuarioVigente" value="<?php echo $privilegios ?>"></input>
				</div>
			</body>
		</form>
	</div>
</html>

<script type="text/javascript">
	    
      var element = document.getElementById('usuarioVigente');

          if(typeof element !== "undefined" && element.value == '1'){
            document.getElementById('contenedor').style.visibility = "visible";
            document.getElementById('mensaje').style.visibility = "hidden";
          }else{
            document.getElementById('contenedor').style.visibility = "hidden";
            document.getElementById('mensaje').style.visibility = "visible";
          }
</script>
	<script>
	//var filtro = null;

		function myFunction() {

		//filtro = document.getElementsByName("xFiltro")[0].value;
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

				$(document).on('click', '#Validar2', function(e){
					
					var id= $(this).data('id');
					SwalConfirmacion2(id);
					e.preventDefault();
				});
		
				
			});
		</script>

		<script type="text/javascript">
			function anular(){
				document.busqueda.text.value="Adios";
			}
		</script>

<!--
		<script>	
				function SwalConfirmacion(id){
				
				swal({
					title: '¿Generar archivo PDF corto?',
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
                               url: 'Formato.php',
							   type: 'POST',
							   data: {'id':id},
							   dataType: 'json'
						 })
						 .done(function(response){
							 swal('Generado!', response.message, response.status);
							 //window.open('ArchivosSocios/CATÁLOGO_CAPACIDADES_EMPRESA.pdf');
                             //window.open('ArchivosSocios/CATÁLOGO_CAPACIDADES_PROCESOS_V2.pdf');
							 window.open('ArchivosSocios/CATÁLOGO_CAPACIDADES_EMPRESA_CORTO.pdf');
							 location.reload();
						 })
						 .fail(function(jqXHR,response){
							 swal('Oops...', 'Algo salió mal vuelve a intentarlo mas tarde', 'error');
							console.log(jqXHR);
						 });
					  });
					},
					allowOutsideClick: false			  
				});	
			}
			
		</script>

<script>	
				function SwalConfirmacion2(id){
				
				swal({
					title: '¿Generar archivo PDF extenso?',
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
							   //url: 'Formato.php',
                               url: 'Formato2.php',
							   type: 'POST',
							   data: {'id':id},
							   dataType: 'json'
						 })
						 .done(function(response){
							 swal('Generado!', response.message, response.status);
							 window.location.href = "Formato2.php";
							 //location.reload();
						 })
						 .fail(function(jqXHR,response){
							 swal('Oops...', 'Algo salió mal vuelve a intentarlo mas tarde', 'error');
							console.log(jqXHR);
						 });
					  });
					},
					allowOutsideClick: false			  
				});	
			}
			
		</script>
<!--
<script>	
				function SwalConfirmacion2(id){
				
				swal({
					title: '¿Generar archivo PDF extenso?',
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

                               url: 'Formato2.php',
							   type: 'POST',
							   data: {'id':id},
							   dataType: 'json'
						 })
						 .then(function(response){
							 swal('Generado!', response.message, response.status);
							 window.location("ArchivosSocios/CATÁLOGO_CAPACIDADES_EMPRESA.pdf");
							 location.reload();
						 })
						 .fail(function(jqXHR,response){
							 swal('Oops...', 'Algo salió mal vuelve a intentarlo mas tarde', 'error');
							console.log(jqXHR);
						 });
					  });
					},
					allowOutsideClick: false			  
				});	
			}
			
		</script>

