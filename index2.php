<head>
	<title>Canacintra</title>
	<meta charset="utf-8">	
	<meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0" />
	<link rel="stylesheet" href="style.css"> 
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	<script src="https://use.fontawesome.com/7750d00bf0.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.1/dist/sweetalert2.all.min.js"></script>-->
<!-- Optional: include a polyfill for ES6 Promises for IE11 and Android browser 
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>-->

</head>
<!--DATOS DE CONEXIÓN A BASE DE DATOS-->
<?php
    $hostname_conexion = "www.canacintramonclova.com";
	$username_conexion = "canacin8_proye20";
	$password_conexion = "CDOufbu0fa!A";
	$name = "canacin8_proyectos";
	$db = new mysqli($hostname_conexion,$username_conexion,$password_conexion,$name,3306);
	$db->set_charset('utf8');

   if (isset($_SESSION['message']) && $_SESSION['message'])
        {
        printf('<b>%s</b>', $_SESSION['message']);
        unset($_SESSION['message']);
        }

        $queryEspecialidad = "SELECT Especialidad FROM sectores group by Especialidad order by IdEspecialidad";
        $resultadoEspecialidad = $db->query($queryEspecialidad);
?>


<div id="contenedor">
    <form class="suscripcion" action="upload.php" method="post" enctype="multipart/form-data" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!--<div class="etiqueta-roja">REGISTRO</div>-->
		<h1 class="titulo-grande">SOLICITUD DE REGISTRO</h1>

		<h1 class="titulo-rojo">I. DATOS GENERALES</h1>
		<input type="text" minlength="12" maxlength="13" name="RFC" style="text-transform:uppercase;" class="campo-chico" placeholder="RFC"  required size="13" pattern="[A-Z]{3,4}[0-9]{6}[A-Z0-9]{3}" title="Caracteres permitidos de 12 a 13" >
		<input type="text" minlength="11" maxlength="11" name="REGISTRO_PATRONAL" class="campo-chico" style="text-transform:uppercase;" placeholder="Registro Patronal (IMSS)" size="11" pattern="[A-Z]{1}[0-9]{10}" >
        

        <div action="#" id="formulario" >
    		<h1 class="titulo-rojo">I.I NOMBRE O DENOMINACIÓN SOCIAL</h1>
    		<ul class="lista-de-cuotas">
    		    <input type="radio" name="TipoDenominacion" id="Fisica" value="Fisica">
                <b for="Fisica">Física</b>
                <input for="Fisica" type="text" name="FisicaNombre" id="FisicaNombre" class="campo-chico2" style="text-transform:uppercase;" placeholder="" disabled required>
    		</ul>
    
    		<ul class="lista-de-cuotas">
    		    <input type="radio" name="TipoDenominacion" id="Moral" value="Moral">
                <b for="Moral">Moral</b>
                <input for="Fisica" type="text" name="MoralNombre" id="MoralNombre" class="campo-chico2" style="text-transform:uppercase;" placeholder="" disabled required >
            </ul>
            <ul class="lista-de-cuotas">
            <input type="text" name="Nombre_Comercial" class="campo-chico2" style="text-transform:uppercase;" placeholder="Nombre Comercial" required >
            </ul>
            <input type="hidden" name="NombreTipo" id="NombreTipo" value="" />
            <input type="hidden" name="NombreDenominacion" id="NombreDenominacion" value="" />
		    
        </div>


        <h1 class="titulo-rojo">I.II UBICACIÓN</h1>
        <input  type="text" name="Calle" class="campo-chico" style="text-transform:lowercase;" placeholder="Calle" required >
        <input  type="text" name="Colonia" class="campo-chico" style="text-transform:lowercase;" placeholder="Colonia" required >
        <input  type="text" name="Numero_Exterior" class="campo-chico" placeholder="Número Exterior" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width: 130px;" required >
        <input  type="text" name="Codigo_Postal" class="campo-chico" minlength="5" maxlength="5" placeholder="Código Postal" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width: 130px;" required >
        <input  type="text" name="Ciudad" class="campo-chico" placeholder="Ciudad" style="width: 180px; text-transform:uppercase;" required >
        <input  type="text" name="Estado" class="campo-chico" placeholder="Estado" style="width: 180px; text-transform:uppercase;" required >

        <h1 class="titulo-rojo">I.III ENTREVIALIDADES</h1>
        <input  type="text" name="Vialidad1" class="campo-chico" placeholder="Vialidad 1" style="width: 400px; text-transform:lowercase;" required >
        <input  type="text" name="Vialidad2" class="campo-chico" placeholder="Vialidad 2" style="width: 400px; text-transform:lowercase;" required >

        <div style="margin-top: 30px;">
            <b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccionar fotografía exterior del domicilio(.jpg):</b>
            <input type="file" name="uploadedFileFachada" accept="image/jpeg" required />
        </div>
        
        <div action="#" id="formulario" >
    		<h1 class="titulo-rojo">I.IV TAMAÑO DE LA EMPRESA</h1>
    		<ul class="lista-de-cuotas">
    		    <input type="radio" name="Tamaño" id="Micro" value="Micro">
                <b for="Micro">Micro (0-30)</b>
                <input type="radio" name="Tamaño" id="Pequeña" value="Pequeña">
                <b for="Pequeña">Pequeña (31-100)</b>
                <input type="radio" name="Tamaño" id="Mediana" value="Mediana">
                <b for="Mediana">Mediana (101-500)</b>
                <input type="radio" name="Tamaño" id="Grande" value="Grande">
                <b for="Grande">Grande (501-En Adelante)</b>
    		</ul>
        </div>
        <input type="hidden" name="TAMAÑO" id="TAMAÑO" value="" />

		 <div action="#" id="formulario" >
    		<h1 class="titulo-rojo">I.V VOLUMEN DE VENTAS EN EL ULTIMO AÑO</h1>
    		<ul class="lista-de-cuotas">
    		    <input type="radio" name="Volumen" id="MicroVolumen" value="MicroVolumen">
                <b for="Micro">$100 Mil-4 Mill</b>
                <input type="radio" name="Volumen" id="PequeñaVolumen" value="PequeñaVolumen">
                <b for="Pequeña">$5 Mill-100 Mill</b>
                <input type="radio" name="Volumen" id="MedianaVolumen" value="MedianaVolumen">
                <b for="Mediana">$101 Mill-260 Mill</b>
                <input type="radio" name="Volumen" id="GrandeVolumen" value="GrandeVolumen">
                <b for="Grande">$261 Mill-En adelante</b>
    		</ul>
        </div>
        <input type="hidden" name="VOLUMEN" id="VOLUMEN" value="" />

        <h1 class="titulo-rojo">I.VI NÚMERO DE PERSONAS QUE LABORAN</h1>

        <input  type="text" name="Administracion" class="campo-chico2" placeholder="Administración" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width: 120px;margin-top: 15px; margin-right: auto;" onkeyup="sumar();" required >
        <input  type="text" name="Produccion" class="campo-chico2" placeholder="Producción" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width: 116px;margin-top: 15px; margin-right: auto;" onkeyup="sumar();" required >
		<input  type="text" name="Mujeres" id="MujeresEmpleadas" class="campo-chico2" placeholder="Mujeres" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width: 116px;margin-top: 15px; margin-right: auto;" onkeyup="verificarH();" disabled>
        <input  type="text" name="Hombres" id="HombresEmpleados" class="campo-chico2" placeholder="Hombres" onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="width: 116px;margin-top: 15px; margin-right: auto;" onkeyup="verificarM();" disabled>
        <input  type="text" name="TotalEmpleados" id="TotalEmpleados" class="campo-chico" placeholder="Total"  style="width: 248px; margin-right: auto;" value="" onchange="calcularcuota();" disabled required >

        <input type="hidden" name="CuotaEmpleados" id="CuotaEmpleados" value="" />
        <input type="hidden" name="CantidadEmpleados" id="CantidadEmpleados" value="" />

        <div action="#" id="formulario" >
    		<ul class="lista-de-cuotas">
            <b name="PersonalSindicalizado" id="PersonalSindicalizado">Personal Sindicalizado</b>
    		    <input for="PersonalSindicalizado" type="radio" name="Sindicalizado" id="Si" value="Si">
                <b for="Si">Si</b>
                <input for="PersonalSindicalizado" type="radio" name="Sindicalizado" id="No" value="No">
                <b for="No">No</b>
                <input  type="text" name="NombreSindicato" id="NombreSindicato" class="campo-chico2" style="text-transform:lowercase;" placeholder="Nombre Sindicato" style="width: 395px; margin-left: 15px;" disabled required >
            </ul>
        </div>
        <input type="hidden" name="SINDI" id="SINDI" value="" />
        
        <h1 class="titulo-rojo">II. SECCIÓN Y RAMO</h1>
      
       
		    <div class="boton-gris-grande">SECCIÓN</div>
		    <select name="COMBO_SECCION" id="COMBO_SECCION" class="seleccion-grande-registro opciones" required>
                    <option value="">Selecciona una opción</option>
                    <?php while($row = $resultadoEspecialidad->fetch_assoc()) { ?>
    		        
    		        <option value="<?php echo $row['Especialidad']; ?>"><?php echo $row['Especialidad'];?></option>
    		        
    		        <?php } ?>

		    </select>
        
      
		    <div class="boton-gris-grande">RAMO</div>
		    <select name="COMBO_RAMO" id="COMBO_RAMO" class="seleccion-grande-registro opciones" required>
			    	<option value="">Selecciona una opción</option>
                    <option>No disponible</option>

		    </select>

            <h1 class="titulo-rojo">III. OFERTA Y DEMANDA</h1>
            <div class="boton-gris-grande">OFERTA</div>
          <div class="field_wrapper">
                <div>
                    <input type="text"class="campo-chico" style="text-transform:uppercase;" placeholder="Principales Produtos o Servicios que ofrece" required name="OFERTA[]" value=""/>
                    <a href="javascript:void(0);" class="add_button" title="Add field"><img style="height: 27px; margin-top: 17px;"src="Imagenes/add-icon.png"/></a>
                </div>
          </div>
          <div class="boton-gris-grande">DEMANDA</div>
          <div class="field_wrapper2">
                <div>
                    <input type="text" class="campo-chico" style="text-transform:uppercase;" placeholder="Principales Insumos que demanda" required name="DEMANDA[]" value=""/>
                    <a href="javascript:void(0);" class="add_button2" title="Add field"><img style="height: 27px; margin-top: 17px;"src="Imagenes/add-icon.png"/></a>
                </div>
          </div>
       <!-- <input type="text" name="OFERTA" class="campo-chico" Value="" placeholder="Principales Produtos o Servicios que ofrece" required >
        <input type="text" name="DEMANDA" class="campo-chico" Value="" placeholder="Principales Insumos que demanda" required >-->
    
        <h1 class="titulo-rojo">IV. CONTACTO</h1>
        <input type="tel" name="Telefono" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="campo-chico" placeholder="Télefono ej.866 123-45-67" required >
        <input type="text" max="35" name="Pagina_de_Internet" class="campo-chico" style="text-transform:lowercase;" placeholder="Página de Internet">
        <img class="icono-home" style="width: 50px;" src="Imagenes/facebook-logo.png">
        <input type="text" name="Facebook" class="campo-chico" placeholder="Facebook" style="width:290px; text-transform:lowercase;">
        <img class="icono-home" style="width: 50px;margin-bottom: 10px;" src="Imagenes/Logo-Twitter.png">
        <input type="text" name="Twitter"  class="campo-chico" placeholder="Twitter" style="width:290px; text-transform:lowercase;">
        <input type="text" name="NombreRepresentanteLegal" class="campo-chico" placeholder="Nombre del Representante Legal ej:(Ing. Ramiro Pérez)" style="width:500px; text-transform:uppercase;" required >
        <input type="email" name="CorreoRepresentanteLegal" class="campo-chico" placeholder="Correo del Representante Legal" style="width:500px; text-transform:lowercase;" required >
        <input type="text" name="NombreDeAsistenteDeRepresentanteLegal" class="campo-chico" placeholder="Nombre del Asistente del Representante Legal ej:(Ing. Ramiro Pérez)" style="width:500px; text-transform:uppercase;"  required >
        <input type="email" name="CorreoDeAsistenteDeRepresentanteLegal" class="campo-chico" placeholder="Correo del Asistente del Representante Legal"  style="width:500px; text-transform:lowercase;" required >
        <input type="text" min="2" max="3" name="ExtensionDeAsistenteDeRepresentanteLegal" class="campo-chico" placeholder="Extensión del Asistente del Representante Legal"  style="width:350px; text-transform:uppercase;" >
        <br><br>
        <h2 class="titulo-rojo-recibo">ATENCIÓN</h2>
        <br>
        <b>EN CASO DE NO CONTAR CON ALGUNO DE LOS SIGUIENTES CONTACTOS FAVOR DE AGREGAR DATOS DE UN RESPONSABLE O EN SU DEFECTO AL REPRESENTANTE LEGAL</b>
        <h1 class="titulo-rojo">IV.I CONTACTO DE RECURSOS HUMANOS</h1>
        <input type="text" name="NombreResponsableRecursosHumanos" class="campo-chico" placeholder="Nombre del Responsable de Recursos Humanos ej:(Ing. Ramiro Pérez)" style="width:500px; text-transform:uppercase;"  required >
        <input type="email" name="CorreoResponsableRecursosHumanos" class="campo-chico" placeholder="Correo del Responsable de Recursos Humanos" style="width:500px; text-transform:lowercase;" required >
        <input type="text" min="2" max="3" name="ExtensionResponsableRecurosHumanos" class="campo-chico" placeholder="Extensión o Teléfono de Contacto" style="width:350px; text-transform:uppercase;" >
        <h1 class="titulo-rojo">IV.II CONTACTO DE CAPACITACIÓN</h1>
        <input type="text" name="NombreResponsableCapacitacion" class="campo-chico" placeholder="Nombre del Responsable de Capacitación ej:(Ing. Ramiro Pérez)" style="width:500px; text-transform:uppercase;" required >
        <input type="email" name="CorreoResponsableCapacitacion" class="campo-chico" placeholder="Correo del Responsable de Capacitación" style="width:500px; text-transform:lowercase;" required >
        <input type="text" min="2" max="3" name="ExtensionResponsableCapacitacion" class="campo-chico" placeholder="Extensión o Teléfono de Contacto" style="width:350px; text-transform:uppercase;"  >
        <h1 class="titulo-rojo">IV.III CONTACTO DE CONTABILIDAD</h1>
        <input type="text" name="NombreResponsableContabilidad" class="campo-chico" placeholder="Nombre del Responsable de Contabilidad ej:(Ing. Ramiro Pérez)" style="width:500px; text-transform:uppercase;" required >
        <input type="email" name="CorreoResponsableContabilidad" class="campo-chico" placeholder="Correo del Responsable de Contabilidad" style="width:500px; text-transform:lowercase;" required >
        <input type="text" min="2" max="3" name="ExtensionResponsableContabilidad" class="campo-chico" placeholder="Extensión o Teléfono de Contacto"  style="width:350px; text-transform:uppercase;"  >
        <h1 class="titulo-rojo">IV.IV CONTACTO DE COMPRAS</h1>
        <input type="text" name="NombreResponsableCompras" class="campo-chico" placeholder="Nombre del Responsable de Compras ej:(Ing. Ramiro Pérez)" style="width:500px; text-transform:uppercase;" required >
        <input type="email" name="CorreoResponsableCompras" class="campo-chico" placeholder="Correo del Responsable de Compras" style="width:500px; text-transform:lowercase;" required >
        <input type="text" min="2" max="3" name="ExtensionResponsableCompras" class="campo-chico" placeholder="Extensión o Teléfono de Contacto" style="width:350px; text-transform:uppercase;" >

        <h1 class="titulo-rojo">V. INFORMACIÓN ADICIONAL</h1>
       
       <input type="text" name="MotivoAfiliacion" class="campo-chico" style="text-transform:lowercase;" placeholder="¿Cuál es el motivo de su afiliación a CANACINTRA?" required >
       <input type="text" name="ServiciosEsperados" class="campo-chico" style="text-transform:lowercase;" placeholder="¿Qué servicios espera recibir de la Cámara?" required >
      

       <!--<div class="columna-home">
       <a href="encuentroinfo.php"> <img class="icono-home" src="imagenes/upload.png" style="margin-top: 35px;"></a>
           <p class="texto-icono-home">
               Cargar logo de la empresa<br>
           </p>
       </div>-->
       
     
            <div style="margin-top: 30px;">
                <b style="font-family:'Work Sans', sans-serif; color: #444;">Seleccionar logo de la empresa(.png):</b>
                <input type="file" name="uploadedFileLogo" accept="image/x-png" required/>
            </div>
 
           <!-- <input type="submit" name="uploadBtn" value="Upload" />-->
     
           
            <input class="enviar" type="submit" name="Siguiente" style="margin-left: 500px;" value="Finalizar">
        
	</form>

<script type="text/javascript">
	
	$(document).ready(function(){
	    
        $('#Fisica').click(function(){
	           document.getElementById('NombreTipo').value = "Fisica";
               document.getElementById('MoralNombre').value = "";
	           //alert("FISICA SELECCIONADA");
	    });
	    $('#Moral').click(function(){
	           document.getElementById('NombreTipo').value = "Moral";
               document.getElementById('FisicaNombre').value = "";
	           //alert("MORAL SELECCIONADA");
	    });
        
        $('#Micro').click(function(){
	           document.getElementById('TAMAÑO').value = "Micro";
	           //alert("MICRO SELECCIONADA");
	    });
	    $('#Pequeña').click(function(){
	           document.getElementById('TAMAÑO').value = "Pequeña";
	           //alert("PEQUEÑA SELECCIONADA");
	    });
        $('#Mediana').click(function(){
	           document.getElementById('TAMAÑO').value = "Mediana";
	           //alert("MEDIANA SELECCIONADA");
	    });
	    $('#Grande').click(function(){
	           document.getElementById('TAMAÑO').value = "Grande";
	           //alert("GRANDE SELECCIONADA");
	    });
        
		$('#MicroVolumen').click(function(){
	           document.getElementById('VOLUMEN').value = "$100 Mil a 4 Millones";
	           //alert("MICRO SELECCIONADA");
	    });
	    $('#PequeñaVolumen').click(function(){
	           document.getElementById('VOLUMEN').value = "$5 Millones a 100 Millones";
	           //alert("PEQUEÑA SELECCIONADA");
	    });
        $('#MedianaVolumen').click(function(){
	           document.getElementById('VOLUMEN').value = "$101 Millones a 260 Millones";
	           //alert("MEDIANA SELECCIONADA");
	    });
	    $('#GrandeVolumen').click(function(){
	           document.getElementById('VOLUMEN').value = "$260 Millones en adelante";
	           //alert("GRANDE SELECCIONADA");
	    });

        $('#Si').click(function(){
	           document.getElementById('SINDI').value = "Si";
	           //alert("SI SELECCIONADO");
	    });
	    $('#No').click(function(){
	           document.getElementById('SINDI').value = "No";
	           //alert("NO SELECCIONADO");
	    });
	    
	});

    $(document).ready(function() {
          $("#FisicaNombre").change(function(){
            Especialidad = $(this).val();
            document.getElementById('NombreDenominacion').value = document.getElementById('FisicaNombre').value;
            })
     });
     $(document).ready(function() {
          $("#MoralNombre").change(function(){
            Especialidad = $(this).val();
            document.getElementById('NombreDenominacion').value = document.getElementById('MoralNombre').value;
            })
     });



function sumar() {

var total = 0;

        $(".campo-chico2").each(function() {

        if (isNaN(parseFloat($(this).val()))) {

            total += 0;

        } else {

            total += parseFloat($(this).val());

        }

        });

        //alert(total);
        document.getElementById('TotalEmpleados').value = total;
        document.getElementById('CantidadEmpleados').value = total;
    if(total != ""){

            document.getElementById('HombresEmpleados').disabled = false;
            document.getElementById('MujeresEmpleadas').disabled = false;

        if(total <= "10"){
                  document.getElementById('CuotaEmpleados').value = "3074";
                   //alert("2642");
              }
              else{
                    if(total <= "20"){
                    document.getElementById('CuotaEmpleados').value = "3432";
                    //alert("3074");
                    }
                    else{
                            if(total <= '50'){
                            document.getElementById('CuotaEmpleados').value = "7745";
                            //alert("7041");
                            }
                            else{
                                    if(total <= '70'){
                                    document.getElementById('CuotaEmpleados').value = "10439";
                                    //alert("9490");
                                    }
                                    else{
                                        if(total <= '150'){
                                        document.getElementById('CuotaEmpleados').value = "17676";
                                        //alert("17370");
                                        }
                                        else{
                                            if(total <= '300'){
                                            document.getElementById('CuotaEmpleados').value = "19164";
                                            //alert("18767");
                                            }
                                            else{
                                                if(total <= '500'){
                                                document.getElementById('CuotaEmpleados').value = "25954";
                                                //alert("25954");
                                                }
                                                else{
                                                    if(total <= '900'){
                                                    document.getElementById('CuotaEmpleados').value = "31145";
                                                    //alert("31145");
                                                    }
                                                    else{
                                                        document.getElementById('CuotaEmpleados').value = "40489";
                                                        //alert("40489");
                                                    }
                                                }
                                            }
                                        }
                                    }
                            }
                    }
              }
        }else{
            document.getElementById('HombresEmpleados').disabled = true;
            document.getElementById('MujeresEmpleadas').disabled = true;

            document.getElementById('HombresEmpleados').value = 0;
            document.getElementById('MujeresEmpleadas').value = 0;
        }
}

function verificarH() {

        var Total = parseInt(document.getElementById("CantidadEmpleados").value);
        var Mujeres = parseInt(document.getElementById("MujeresEmpleadas").value);
        var Hombres = parseInt(document.getElementById("HombresEmpleados").value);
        var TotalFinal = Hombres+Mujeres;


        if(Mujeres != Total){
            document.getElementById('HombresEmpleados').disabled = false;
        }else{
            document.getElementById('HombresEmpleados').disabled = true;
        }

 
        if (isNaN(Mujeres)) { 
             document.getElementById("HombresEmpleados").value = "";
        } else {

            var resultadoHombres = Total-Mujeres;
            document.getElementById("HombresEmpleados").value = resultadoHombres;

        }
}
function verificarM() {

        var Total = parseInt(document.getElementById("CantidadEmpleados").value);
        var Mujeres = parseInt(document.getElementById("MujeresEmpleadas").value);
        var Hombres = parseInt(document.getElementById("HombresEmpleados").value);

        if(Hombres != Total){
            document.getElementById('MujeresEmpleadas').disabled = false;
        }else{
            document.getElementById('MujeresEmpleadas').disabled = true;
        }

 
        if (isNaN(Hombres)) { 
             document.getElementById("MujeresEmpleadas").value = "";
        } else {
            var resultadoMujeres = Total-Hombres;
            document.getElementById("MujeresEmpleadas").value = resultadoMujeres;
        } 
}


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
   

    function updateStatus() 
			{
			  if (document.getElementById('Fisica').checked) 
			  	{
			    	document.getElementById('NombreTipo').Value = 'Fisica';
                    document.getElementById('FisicaNombre').disabled = false;
                    document.getElementById('FisicaNombre').focus();
                    document.getElementById('MoralNombre').disabled = true;
			    } else if(document.getElementById('Moral').checked)
			    {
			    	document.getElementById('NombreTipo').Value = 'Moral';
                    document.getElementById('MoralNombre').disabled = false;
                    document.getElementById('MoralNombre').focus();
                    document.getElementById('FisicaNombre').disabled = true;
			    }

                if (document.getElementById('Si').checked) 
			  	{
                    document.getElementById('NombreSindicato').disabled = false;
                    //document.getElementById('NombreSindicato').focus();
			    } else if(document.getElementById('No').checked)
			    {
                    document.getElementById('NombreSindicato').disabled = true;
                    document.getElementById('NombreSindicato').value = "";
			    }
			}

            
            document.getElementById('Fisica').addEventListener('change', updateStatus);
			document.getElementById('Moral').addEventListener('change', updateStatus);

            //document.getElementById('Micro').addEventListener('change',updateStatus);
			//document.getElementById('Pequeña').addEventListener('change',updateStatus);
            //document.getElementById('Mediana').addEventListener('change',updateStatus);
			//document.getElementById('Grande').addEventListener('change',updateStatus);

        function updateStatus2() 
			{
                if (document.getElementById('Si').checked) 
			  	{
                    document.getElementById('NombreSindicato').disabled = false;
                    document.getElementById('NombreSindicato').focus();
			    } else if(document.getElementById('No').checked)
			    {
                    document.getElementById('NombreSindicato').disabled = true;
                    document.getElementById('NombreSindicato').value = "";
			    }
			}
            document.getElementById('Si').addEventListener('change', updateStatus2);
			document.getElementById('No').addEventListener('change', updateStatus2);

            
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var addButton2 = $('.add_button2'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var wrapper2 = $('.field_wrapper2'); //Input field wrapper
            var fieldHTML = '<div><input type="text" class="campo-chico" placeholder="Principales Produtos o Servicios que ofrece" required name="OFERTA[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img style="height: 28px;margin-top: 17px;margin-left: 4px;" src="Imagenes/remove-icon.png"/></a></div>'; //New input field html 
            var fieldHTML2 = '<div><input type="text" class="campo-chico" placeholder="Principales Insumos que demanda" required name="DEMANDA[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img style="height: 28px;margin-top: 17px;margin-left: 4px;" src="Imagenes/remove-icon.png"/></a></div>'; //New input field html 
            var x = 1; //Initial field counter is 1
            $(addButton).click(function(){ //Once add button is clicked
                if(x < maxField){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                }
            });
            $(addButton2).click(function(){ //Once add button is clicked
                if(x < maxField){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper2).append(fieldHTML2); // Add field html
                }
            });
            $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
            $(wrapper2).on('click', '.remove_button', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

	
</script>
</div>

