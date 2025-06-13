<?php
include 'conexion.php';

$result = $db->query("SELECT DISTINCT (cp) FROM Sepomex WHERE `estado` = 'Coahuila de Zaragoza' ");
$array = array();
if($result){
	while ($row = mysqli_fetch_array($result)) {
		$cp = utf8_encode($row['cp']);
		array_push($array, $cp); //codigos postales
	}
}

$queryEspecialidad = "SELECT Especialidad FROM sectores group by Especialidad order by IdEspecialidad";
$resultadoEspecialidad = $db->query($queryEspecialidad);

$query22 = $db->query("select * from Empresa order by idEmpresa desc limit 1");
$resultado2 = mysqli_fetch_array($query22);
$NumeroEmpresa = $resultado2['idEmpresa'];
$SiguienteEmpresa = $NumeroEmpresa + '1';

?>
<head>
	<title>Register page</title>
	<meta charset="utf-8">	
	<meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
	<link rel="stylesheet" href="style.css"> 
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="librerias/jquery-ui.css">

	<script src="https://use.fontawesome.com/7750d00bf0.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
	<script src="js/funciones.js"></script>

	<script type="text/javascript" src="librerias/jquery-ui.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.1/dist/sweetalert2.all.min.js"></script>-->
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser 
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>-->

</head>	
<!--DATOS DE CONEXIÓN A BASE DE DATOS-->
<?php
    /*$hostname_conexion = "www.canacintramonclova.com";
	$username_conexion = "canacin8_proye20";
	$password_conexion = "CDOufbu0fa!A";
	$name = "canacin8_proyectos";
	$db = new mysqli($hostname_conexion,$username_conexion,$password_conexion,$name,3306);
	$db->set_charset('utf8');*/

	include 'conexion.php';

?>

<body style="background-image: url(&quot;Imagenes/3e26db88-e640-4409-9cd0-29d31d9a7f60.jpg&quot;); background-attachment: fixed;background-repeat: no-repeat;background-size: cover;">
<div id="contenedor" style="background-color: rgb(140 140 140 / 28%); height: 85em;">
    <form class="suscripcion" action="upload.php" method="post" enctype="multipart/form-data" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!--<div class="etiqueta-roja">REGISTRO</div>-->
        <div class="etiqueta-roja" style="width: 35%;">
		<h1 >NUEVO REGISTRO</h1>
        </div>
    <input type="hidden" id="idNumeroEmpresa" name="idNumeroEmpresa" value="<?php echo $SiguienteEmpresa ?>"></input>
		<!--PRIMER BLOQUE-->
		<div style="width: 50%; float: left; height: 25em; margin-top: 5em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="RAZON_SOCIAL" >Razón social (Máximo 50 caracteres)</h3>
			<input tabindex="1" type="text" maxlength="100" id="RAZON_SOCIAL" name="RAZON_SOCIAL" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="RAZÓN SOCIAL"  required>

			<!--<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="DIRECCION" >Dirección</h3>
			<input tabindex="3" type="text" maxlength="100" id="DIRECCION" name="DIRECCION" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="Dirección"  required>-->
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="SITIO_WEB" >Sitio Web (Máximo 40 caracteres)</h3>
			<input tabindex="3" type="text" maxlength="40" id="SITIO_WEB" name="SITIO_WEB" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="Sitio Web"  required>

			<h3 class="titulo-rojo"  style="margin-top: 10px; color: #000000; width: max-content;" for="COMBO_SECCION" >SELECCIONE LA CLASIFICACIÓN A LA QUE PERETENEZCA LA EMPRESA</h3>
		    <select name="COMBO_SECCION" tabindex="5" id="COMBO_SECCION" name="COMBO_SECCION" class="seleccion-grande-registro opciones" required style="width: 186%; margin-top: 5px;">
                    <option value="">Selecciona una opción</option>
                    <?php while($row = $resultadoEspecialidad->fetch_assoc()) { ?>
    		        
    		        <option value="<?php echo $row['Especialidad']; ?>"><?php echo $row['Especialidad'];?></option>
    		        
    		        <?php } ?>

		    </select>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000; width: max-content;" for="COMBO_RAMO" >SELECCIONE LA SUB CLASIFICACIÓN A LA QUE PERETENECE LA EMPRESA</h3>
		    <select name="COMBO_RAMO" tabindex="6" id="COMBO_RAMO" name ="COMBO_RAMO" class="seleccion-grande-registro opciones" required style="width: 186%; margin-top: 5px;">
			    	<option value="">Selecciona una opción</option>
                    <option>No disponible</option>

		    </select>

			<div style="margin-top: 30px;">
				<b style="font-family:'Work Sans', sans-serif; color: #000000;">Seleccionar logo de la empresa(.png):</b>
				<input tabindex="7" type="file" name="uploadedFileLogo" accept="image/x-png" required/>
			</div>

		</div>

		<!--SEGUNDO BLOQUE-->
		<div style="width: 50%; float: left; height: 25em; margin-top: 5em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000; width: max-content;" for="ACTIVIDAD_PRINCIPAL_ESPAÑOL" >Actividad principal / Main Activity (Español) (Máximo 25 caracteres)</h3>
			<input tabindex="2" type="text" maxlength="25" id="ACTIVIDAD_PRINCIPAL_ESPAÑOL" name="ACTIVIDAD_PRINCIPAL_ESPAÑOL" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" placeholder="ACTIVIDAD PRINCIPAL" required>
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000; width: max-content;" for="ACTIVIDAD_PRINCIPAL_INGLÉS" >Actividad principal / Main Activity (Inglés) (Maximum 25 characters)</h3>
			<input tabindex="4" type="text" maxlength="25" id="ACTIVIDAD_PRINCIPAL_INGLÉS" name="ACTIVIDAD_PRINCIPAL_INGLÉS" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="MAIN ACTIVITY"  required>


		</div>
		
		<div style="margin-top: 32em;">
			<h2 class="titulo-grande" style="color:#e11327">Dirección de la empresa</h2>
		</div>

		<!--TERCER BLOQUE-->
		<div style="width: 50%; float: left; height: 15em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="NOMBRE_CALLE" >Nombre de la calle</h3>
			<input tabindex="8" type="text" maxlength="100" id="NOMBRE_CALLE" name="NOMBRE_CALLE" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder=""  required>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="NUMERO_EXT" >Numero exterior</h3>
			<input tabindex="10" type="text" maxlength="100" id="NUMERO_EXT" name="NUMERO_EXT" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder=""  required>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="CP" >Código postal (digite su CP y seleccionelo)</h3>
			<input tabindex="12" type="text" maxlength="100" id="CP" name="CP" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="" maxlength= "5"  required>

		</div>

		<!--CUARTO BLOQUE-->
		<div style="width: 50%; float: left; height: 20em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000; width: max-content;" for="COLONIA" >SELECCIONE LA COLONIA</h3>
		    <select name="COLONIA" tabindex="6" id="COLONIA"  class="seleccion-grande-registro opciones" required style="text-transform:uppercase; width: 85%; margin-top: 5px;">
			    	<option value="">Selecciona una opción</option>
                    <option>No disponible</option>
		    </select>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="CIUDAD">Ciudad</h3>
			<input type="text" maxlength="100" id="CIUDAD" name="CIUDAD" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" placeholder="" required>
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="MUNICIPIO" >Municipio</h3>
			<input type="text" maxlength="100" id="MUNICIPIO" name="MUNICIPIO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder=""  required>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="ESTADO" >Estado</h3>
			<input type="text" maxlength="100" id="ESTADO" name="ESTADO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder=""  required>

		</div>

		<div style="margin-top: 21em;">
			<h2 class="titulo-grande" style="color:#e11327">Información de contacto</h2>
		</div>

		<!--QUINTO BLOQUE-->
		<div style="width: 50%; float: left; height: 11em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="NOMBRES" >Nombre(s) (Máximo 20 caracteres)</h3>
			<input tabindex="15" type="text" maxlength="20" id="NOMBRES" name="NOMBRES" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="NOMBRE(S)"  required>

			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="CORREO" >Correo (Máximo 40 caracteres)</h3>
			<input tabindex="17" type="email" maxlength="40" id="CORREO" name="CORREO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="CORREO"  required>

		</div>

		<!--SEXTO BLOQUE-->
		<div style="width: 50%; float: left; height: 11em;">
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="APELLIDO">Apellido(s) (Máximo 20 caracteres)</h3>
			<input tabindex="16" type="text" maxlength="20" id="APELLIDO" name="APELLIDO" class="campo-chico" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" placeholder="Apellido(s)" required>
        
			<h3 class="titulo-rojo" style="margin-top: 10px; color: #000000" for="TELEFONO" >Teléfono (Máximo 10 dígitos)</h3>
			<input tabindex="18" type="text" maxlength="10" id="TELEFONO" name="TELEFONO" style="text-transform:uppercase; margin-top: 5px; margin-bottom: 10px;" class="campo-chico" placeholder="Teléfono"  required>

		</div>

		<div class="aviso-privacidad">
			<input type="checkbox" name="AvisoP" id="AvisoP" required>
			<b for="AvisoP">Acepta el <a href="AVISO DE PRIVACIDAD.pdf" target="_blank">aviso de privacidad.</a> En CANACINTRA delegación monclova protegemos tu información confidencial.</b>
			<br>
        </div>

		     <input class="enviar" tabindex="19" type="submit" name="Siguiente" style="margin-left: 500px;" value="Registrar">
	</form>

	<!-- Messenger plugin de chat Code -->
    <div id="fb-root"></div>

    <!-- Your plugin de chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "600733856678706");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

</div>

<script type="text/javascript">
	$(document).ready(function () {
		var items = <?= json_encode($array) ?>

		$("#CP").autocomplete({
			source: items,
			select: function (event, item){
				//console.log(item);
				var params ={
					cp: item.item.value
				};
				$.get("getDireccion.php", params, function(response){
					//console.log(response);
					var json = JSON.parse(response);
					if (json.status == 200) {
						  $("#COLONIA").val(json.asentamiento);
						  //$("#prueba").html(json.asentamiento);
						  $("#CIUDAD").val(json.ciudad);
						  $("#MUNICIPIO").val(json.municipio);
						  $("#ESTADO").val(json.estado);
					}else {

					}
				}); //ajax
			}
		});
	});
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

<script type="text/javascript">
	$(document).ready(function() {
          $("#CP").change(function(){
            CP = $(this).val();
         
              $('#COLONIA').append("<option value='' >SELECCIONE UNA OPCIÓN</option>");
             // alert(Especialidad);
              $.post("get_colonias.php", {CP : CP}, function(data){
                  $("#COLONIA").html(data);
                  //removeOptions(document.getElementById("ComboHora"));
                })
            })
     });
</script>

</body>
