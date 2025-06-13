<?php
session_start();
include_once "header.php";
include_once 'conexion.php';
include ("barra_lateral.php");
    
  $nombre = $_SESSION["USUARIO"];
  $clave = $_SESSION["PASSWORD"];

  $query21 = $pdo->query("Select * From Empresa where usuario='$nombre' AND contraseña='$clave'");
  $resultado = $query21->fetch(PDO::FETCH_BOTH);
//$resultado = mysqli_fetch_array($query21);
$idEmpresaLog = $resultado['idEmpresa'];

$direccion = "calle ".$resultado['calle']. "#".$resultado['num_exterior'].",".$resultado['colonia'].",".$resultado['ciudad'].",".$resultado['estado'];
   
$queryEspecialidad = "SELECT Especialidad FROM sectores group by Especialidad order by IdEspecialidad";
$resultadoEspecialidad = $pdo->query($queryEspecialidad);
?>

<html>
<head>
<script src="js/funciones.js"></script>
</head>
<div id="contenedor">
    <form class="suscripcion" action="update_empresa.php" method="post" enctype="multipart/form-data" style="width: 100%;" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!--<div class="etiqueta-roja">REGISTRO</div>-->
        <div class="etiqueta-roja" style="width: 35%; float:left">
		<h1 >PERFIL EMPRESA / COMPANY PROFILE</h1>
        </div>
        
    <input type="hidden" id="idEmpresa" name="idEmpresa" value="<?php echo $idEmpresaLog ?>"></input>
		<div style="width: 45%; height: 7em; margin-top: 0em; float:right; margin-right: 5em;">
		    <img style="max-width: 50%; max-height: 50%;margin-right: 20%;margin-left: 20%;margin-bottom: 2%;" src=ImagenesEmpresas/Logos/<?php echo $resultado['logo'] ?> >
		</div>

		<!--PRIMER BLOQUE-->
		<div style="width: 45%; float: left; height: 17em; margin-top: 5em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="RAZON_SOCIAL" >Razón social</h3>
			<input tabindex="1" type="text" maxlength="100" id="RAZON_SOCIAL" name="RAZON_SOCIAL" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="RAZÓN SOCIAL" value="<?php echo $resultado['nombreEmpresa'] ?>">

			<!--<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="DIRECCION" >Dirección</h3>
			<input tabindex="3" type="text" maxlength="100" id="DIRECCION" name="DIRECCION" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="Dirección" value="<?php echo $direccion ?>">-->


			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="ACTIVIDAD_PRINCIPAL" >Actividad principal / Main Activity (Español e Inglés)</h3>
			<textarea tabindex="2" type="text" maxlength="100" rows="3" id="ACTIVIDAD_PRINCIPAL" name="ACTIVIDAD_PRINCIPAL" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" placeholder="ACTIVIDAD PRINCIPAL"><?php echo $resultado['actividadPrincipal'] ?></textarea>
        
					<h3 class="titulo-rojo"  style="margin-top: 10px; color: #6d6b6b; width: max-content;" for="COMBO_SECCION" >SELECCIONE LA CLASIFICACIÓN A LA QUE PERETENEZCA LA EMPRESA</h3>
		    <select name="COMBO_SECCION" tabindex="5" id="COMBO_SECCION" name="COMBO_SECCION" class="seleccion-grande-registro opciones" style="width: 186%; margin-top: 5px;">
                    <option value="<?php echo $resultado['seccion'] ?>"><?php echo $resultado['seccion'] ?></option>
                    <?php while($row = $resultadoEspecialidad->fetch(PDO::FETCH_ASSOC)) { ?>
    		        
    		        <option value="<?php echo $row['Especialidad']; ?>"><?php echo $row['Especialidad'];?></option>
    		        
    		        <?php } ?>

		    </select>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b; width: max-content;" for="COMBO_RAMO" >SELECCIONE LA SUB CLASIFICACIÓN A LA QUE PERETENECE LA EMPRESA</h3>
		    <select name="COMBO_RAMO" tabindex="6" id="COMBO_RAMO" name ="COMBO_RAMO" class="seleccion-grande-registro opciones" style="width: 186%; margin-top: 5px;">
			    	<option value="<?php echo $resultado['ramo'] ?>"><?php echo $resultado['ramo'] ?></option>
                    <option>No disponible</option>

		    </select>
		</div>

		<!--SEGUNDO BLOQUE-->
		<div style="width: 45%; float: left; height: 17em; margin-top: 2em; margin-bottom: 2em;">
		<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="SITIO_WEB" >Sitio Web</h3>
		<input tabindex="5" type="text" maxlength="100" id="SITIO_WEB" name="SITIO_WEB" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="Sitio Web" value="<?php echo $resultado['sitioWeb'] ?>">

		<!--	<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="ACTIVIDAD_PRINCIPAL_INGLÉS" >Actividad principal / Main Activity (Inglés)</h3>
			<input tabindex="4" type="text" maxlength="100" id="ACTIVIDAD_PRINCIPAL_INGLÉS" name="ACTIVIDAD_PRINCIPAL_INGLÉS" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="MAIN ACTIVITY" value=" <?php echo $resultado['nombreEmpresa'] ?> ">-->

			<div style="margin-top: 30px;">
				<b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccionar logo de la empresa(.png):</b>
				<input tabindex="6" type="file" name="uploadedFileLogo" accept="image/x-png"/>
			</div>

		</div>



				<div style="margin-top: 34em;">
			<h2 class="titulo-grande" style="color:#e11327">Dirección de la empresa</h2>
		</div>

		<!--TERCER BLOQUE-->
		<div style="width: 45%; float: left; height: 15em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NOMBRE_CALLE" >Nombre de la calle</h3>
			<input tabindex="8" type="text" maxlength="100" id="NOMBRE_CALLE" name="NOMBRE_CALLE" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" class="campo-chico" placeholder="" value="<?php echo $resultado['calle'] ?>"  required>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="NUMERO_EXT" >Numero exterior</h3>
			<input tabindex="10" type="text" maxlength="100" id="NUMERO_EXT" name="NUMERO_EXT" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" class="campo-chico" placeholder="" value="<?php echo $resultado['num_exterior'] ?>" required>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CP" >Código postal (digite su CP y seleccionelo)</h3>
			<input tabindex="12" type="text" maxlength="100" id="CP" name="CP" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" class="campo-chico" placeholder="" maxlength= "5" value="<?php echo $resultado['cp'] ?>"  required>

		</div>

		<!--CUARTO BLOQUE-->
		<div style="width: 45%; float: left; height: 20em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="COLONIA">Colonia</h3>
			<input  type="text" maxlength="100" id="COLONIA" name="COLONIA" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" placeholder="" value="<?php echo $resultado['colonia'] ?>" required>
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="CIUDAD">Ciudad</h3>
			<input type="text" maxlength="100" id="CIUDAD" name="CIUDAD" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" placeholder="" value="<?php echo $resultado['ciudad'] ?>" required>
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="MUNICIPIO" >Municipio</h3>
			<input type="text" maxlength="100" id="MUNICIPIO" name="MUNICIPIO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" class="campo-chico" placeholder="" value="<?php echo $resultado['municipio'] ?>"  required>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="ESTADO" >Estado</h3>
			<input type="text" maxlength="100" id="ESTADO" name="ESTADO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" class="campo-chico" placeholder="" value="<?php echo $resultado['estado'] ?>" required>

		</div>

		<div style="margin-top: 21em;">
			<h2 class="titulo-grande" style="color:#e11327">Información de contacto</h2>
		</div>

		<!--TERCER BLOQUE-->
		<div style="width: 45%; float: left; height: 11em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="NOMBRES" >Nombre(s)</h3>
			<input tabindex="7" type="text" maxlength="100" id="NOMBRES" name="NOMBRES" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="NOMBRE(S)" value="<?php echo $resultado['nombre'] ?>">

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="CORREO" >Correo</h3>
			<!--<section id="label_resultado">
		
			</section>-->
			<input tabindex="9" type="text" maxlength="100" id="CORREO" name="CORREO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="CORREO" value="<?php echo $resultado['correo'] ?>">

		</div>

		<!--CUARTO BLOQUE-->
		<div style="width: 45%; float: left; height: 11em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="APELLIDO">Apellido(s)</h3>
			<input tabindex="8" type="text" maxlength="100" id="APELLIDO" name="APELLIDO" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" placeholder="Apellido(s)" value="<?php echo $resultado['apellido'] ?>">
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b" for="TELEFONO" >Teléfono</h3>
			<input tabindex="10" type="text" maxlength="100" id="TELEFONO" name="TELEFONO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px; width: 90%;" class="campo-chico" placeholder="Teléfono(s)"  value="<?php echo $resultado['telefono'] ?>">

		</div>

        <div style="margin-top: 13em;">
			<h2 class="titulo-grande" style="color:#e11327">Credenciales de acceso</h2>
		</div>

		<!-- QUINTO BLOQUE-->
		<div style="width: 45%; float: left; height: 11em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="USUARIO" >Usuario</h3>
			<input tabindex="7" type="text" maxlength="100" id="USUARIO" name="USUARIO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="USUARIO" value="<?php echo $resultado['usuario'] ?>">
		</div>

        <!-- QUINTO BLOQUE-->
		<div style="width: 45%; float: left; height: 11em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #6d6b6b;" for="CONTRASEÑA" >Contraseña</h3>
			<input tabindex="9" type="text" maxlength="100" id="CONTRASEÑA" name="CONTRASEÑA" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;  width: 90%;" class="campo-chico" placeholder="CONTRASEÑA" value="<?php echo $resultado['contraseña'] ?>">

		</div>

		     <input class="enviar" type="submit" name="Siguiente" style="margin-left: 500px;" value="Guardar cambios">
	</form>
</div>

<script>
		function myFunction() {
		 $(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#CORREO tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
		}
</script>
	
<script type="text/javascript">
	$(document).ready(function() {
          $("#COMBO_SECCION").change(function(){
            Especialidad = $(this).val();
         
             // alert(Especialidad);
              $.post("getSubEspecialidades.php", {Especialidad : Especialidad}, function(data){
                  $("#COMBO_RAMO").html(data);
                  //removeOptions(document.getElementById("ComboHora"));
                })
            })
     });
</script>
</html>
