<?php
include("header.php");
include "barra_lateral.php"
?>
<html lang="es">
	<head>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="peticion_productos.js"></script>
<!----------------------------------------------------------------------------------------->
 <!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script src="js/tabletoExcel.js"></script>

    <link rel="stylesheet" type="text/css" href="sweetalert/sweetalert2.min.css">
    <script type="text/javascript" src="sweetalert/sweetalert2.min.js" ></script>
   <!--<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>-->
   <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
		
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

	</body>
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


