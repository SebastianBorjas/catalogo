<?php
//session_start();
//include("hederAdmin.php");
//if(!empty($_SESSION["USUARIO"]))
	//header("Location: index.php");

	$hostname_conexion = "localhost";
	$username_conexion = "root";
	$password_conexion = "";
	$name = "canacintra";
	$db = new mysqli($hostname_conexion,$username_conexion,$password_conexion,$name,3306);
	$db->set_charset('utf8');
	$and="";
  	//$nombre=$_POST['myInput'];
    //$pago=$_POST['xpago'];
   
    
?>
<html>
<head>
	<title>Registros</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!----------------------------------------------------------------------------------------->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/tabletoExcel.js"></script>
    <!------------------------------------------------------------------------------------------>
    <link rel="stylesheet" type="text/css" href="sweetalert/sweetalert2.min.css">
    <script type="text/javascript" src="sweetalert/sweetalert2.min.js" ></script>
   <!--<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>-->
   <!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
 
</head>
<body>
    <br>
<div style="margin-bottom: 1%; margin-left: 1%;">
<form method="post">
 <input type="text" name="myInput" onkeyup="myFunction()" placeholder="DENOMINACIÓN SOCIAL" title="Type in a name" width=20px>
 <select name="xstatus" >
    <option value="">Estatus de vigencia</option>
    <option value"1">Activo</option>
    <option value"0">Inactivo</option>
 </select>
 <button name="buscar" type="submit"  class="btn btn-info"><span class="glyphicon glyphicon-search">
        BUSCAR</span> </button>
 <button type="button" onclick="tableToExcel('myTable', 'REGISTROS')" class="btn btn-success ">
 <span class="glyphicon glyphicon-download-alt">
     Exportar a Excel
 </span>
 </button>
 
</form> 
</div>
    
    <br>

<!----------------- TABLA------------->
<div>
<div class="table-responsive">
<!-- Table  -->
<table  class="table table-striped table-bordered" width="100%" id="myTable"  cellpaddig="10">
  <!-- Table head -->
  <thead >
    <tr>
      
      <th class="text-center" style="background-color:232A44"><i  aria-hidden="true"><font color="WHITE"></i>DENOMINACIÓN SOCIAL</th>
	  <th class="text-center" style="background-color:232A44"><i  aria-hidden="true"><font color="WHITE"></i>NOMBRE COMERCIAL</th>
      <th class="text-center" style="background-color:232A44"><i  aria-hidden="true"><font color="WHITE"></i>TIPO</th>
      <th class="text-center" style="background-color:232A44"><i  aria-hidden="true"><font color="WHITE"></i>RFC</th>
      <th class="text-center" style="background-color:232A44"><i  aria-hidden="true"><font color="WHITE"></i>REGISTRO PATRONAL</th>
	  <th class="text-center" style="background-color:232A44"><i  aria-hidden="true"><font color="WHITE"></i>CUOTA</th>
      <th class="text-center" style="background-color:232A44"><i  aria-hidden="true"><font color="WHITE"></i>FECHA REGISTRO</th>
    </tr>
  </thead>
  <!-- Table head -->

  <!-- Table body -->
  <tbody>
      	<?php
		  
		//////////////Boton buscar/////////////
		if(isset($_POST['buscar']))
		{
		    if(empty($_POST['xstatus']))
		    {
		        "ESTATUS='".$nombre."%'";
		    }
		    else if (empty($_POST['myInput']))
		    {
		        $and=" AND EMPRESA like'".$nombre."%'";
		    }
		    else
		    {
		        $and=" AND EMPRESA like'".$nombre."%'&& PAGO='".$pago."'";
		    }
		}

		

	    $resultado = $GLOBALS['db'] -> query("SELECT * FROM socio WHERE ESTATUS='1'");
	    if(mysqli_num_rows($resultado)==0)
	    {
	        $mensaje="<h1>NO HAY REGISTROS CON ESE CRITERIO";
	    }
	  	while($fila = $resultado -> fetch_array()){
	    ?>
    <tr>
     
            	<td class="text-center"><?php echo $fila['Nombre_DenominacionSocial'] ?></td>
            	<td class="text-center"><?php echo $fila['NombreComercial'] ?></td>
				<td class="text-center"><?php echo $fila['TipoNombre_DenominacionSocial'] ?></td>
				<td class="text-center"><?php echo $fila['RFC'] ?></td>
				<td class="text-center"><?php echo $fila['RegistroPatronal'] ?></td>
				<td class="text-center">$<?php echo $fila['Cuota'] ?>.00</td>
				<td class="text-center"><?php echo $fila['FechaSolicitud'] ?></td>
				
			<!--	<td class="text-center" bgcolor="yellow"><?php //echo $fila['FECHA_INSCRIPCION'] ?></td>
				<td class="text-center"><?php //echo //$fila['CONFERENCIA'] ?></td>
				<td bgcolor="red"><?php //echo $fila['PAGO'] ?></td>-->
				<td class="text-center">
                    <a class="btn btn-info" id="Validar" data-id="<?php echo $fila["IdSocio"];?>">PDF <span class="glyphicon glyphicon-download"></span></a>    
			    </td>
				<!--<td class="text-center">
				    <a class="btn btn-warning" id="Correo" data-id="<?php //echo $fila["IdSocio"];?>"><span class="glyphicon glyphicon-envelope"></span></a>
				</td>
				<td class="text-center"> 
		            <a class="btn btn-sm btn-danger" id="delete_product" data-id="<?php //echo $fila["IdSocio"]; ?>" data-name="<?php //echo $fila["NOMBRE"]; ?>" data-empresa="<?php //echo $fila["EMPRESA_PERSONAL"]; ?>" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a>
		        </td>-->
    </tr>      
    	<?php }
    //	echo $mensaje;
	?>
  </tbody> 
  <!-- Table body -->
</table>
<!-- Table  -->
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
<script>
	$(document).ready(function(){
		
		/*$(document).on('click', '#delete_product', function(e){
			
			var productId = $(this).data('id');
			var name = $(this).data('name');
			var empresa = $(this).data('empresa');
			SwalDelete(productId,name,empresa);
			e.preventDefault();
		});*/
		$(document).on('click', '#Validar', function(e){
			
			var id= $(this).data('id');
			SwalConfirmacion(id);
	    	e.preventDefault();
		});
	/*	$(document).on('click', '#Correo', function(e){
			
			var id= $(this).data('id');
			SwalCorreo(id);
			alert(email);
			e.preventDefault();
		});*/
		
	});
	
/*	function SwalDelete(productId,name,empresa){
		
		swal({
			title: 'Estas Seguro?',
			text: "Se eliminara de manera permanente!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Eliminalo!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: 'eliminar.php',
			    	type: 'POST',
			       	data: {'id':productId,'name':name,'empresa':empresa},
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('Eliminado!', response.message, response.status);
			     	location.reload();
			     })
			     .fail(function(){
			     	swal('Oops...', 'Algo salio mal vuelve a intentarlo mas tarde', 'error');
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	
		
	}*/
		
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
			   		url: 'Formato.php',
			    	type: 'POST',
			       	data: {'id':id},
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('Generado!', response.message, response.status);
					 window.open('ArchivosSocios/PDFSocio.pdf');
			     	location.reload();
			     })
			     .fail(function(jqXHR,response){
			     	swal('Oops...', 'Algo salio mal vuelve a intentarlo mas tarde', 'error');
			        console.log(jqXHR);
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	
		
	}
	/*function SwalCorreo(id,name,apellido,empresa,email){
		
		swal({
			title: 'Estas Seguro?',
			text: "Se enviará un concentrado de la citas al registro seleccionado",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, Envialo!',
			showLoaderOnConfirm: true,
			  
			preConfirm: function() {
			  return new Promise(function(resolve) {
			       
			     $.ajax({
			   		url: 'envio.php',
			    	type: 'POST',
			       	data: {'id':id,'name':name,'apellido':apellido,'empresa':empresa,'email':email},
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	swal('Enviado!', response.message, response.status);
			     	location.reload();
			     })
			     .fail(function(jqXHR,response){
			     	swal('Oops...', 'Algo salio mal vuelve a intentarlo mas tarde', 'error');
			     	console.log(jqXHR);
			     	console.log(response);
			     });
			  });
		    },
			allowOutsideClick: false			  
		});	
		
	}*/
</script>
</html>
