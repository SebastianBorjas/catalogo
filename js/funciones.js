$(obtener_registros());

function obtener_registros(correo)
{
	$.ajax({
		url : './consulta.php',
		type : 'POST',
		dataType : 'html',
		data : { correo: correo },
		})

	.done(function(resultado){
		$("#label_resultado").html(resultado);
	})
}

$(document).on('keyup', '#CORREO', function()
{
	var valorBusqueda=$(this).val();
	if (valorBusqueda!="")
	{
		obtener_registros(valorBusqueda);
	}
	else
		{
			obtener_registros();
		}
});



function agregaform(datos){
	d=datos.split('||');

	$('#idProceso').val(d[0]);
  //document.getElementById("idProceso").value=d[1];
	$('#idNombreProceso').val(d[1]);
  //Equipo descripción
	$('#idNombreProceso2').val(d[2]);
	$('#idCantidadEquipos').val(d[3]);
  $('#idCapacidadProduccion').val(d[4]);
  $('#idCantidadOperadores').val(d[6]);

  //$('#edit').modal('show');
	/*	$('#efirstname').val(first);
		$('#elastname').val(last);
		$('#eaddress').val(address);*/
  //$('#idImagen').val(d[8]);	
}

function actualizaDatos(){

    	idProcesoActual=$('#idProceso').val();
			nombreProceso=$('#idNombreProceso').val();
      nombreProceso2=$('#idNombreProceso2').val();
			//des=$('#idCapacidadProduccion2').val();
      //prueba=$('#idCantidadEquipos2').val();
      cantidadEquipos2=$('#idCantidadEquipos').val();
			capacidad=$('#idCapacidadProduccion').val();
			cantidadOperadores=$('#idCantidadOperadores').val();
			imagen=$('#idImagen').val();
			//imagen=$('#idImagen')[0].files[0];
			
			$.ajax({
			   		url: 'updateProcess.php',
			    	type: 'POST',
			       	data: {'idProcesoActual':idProcesoActual,'nombreProceso':nombreProceso,'nombreProceso2':nombreProceso2,'cantidadEquipos2':cantidadEquipos2,'capacidad':capacidad,'cantidadOperadores':cantidadOperadores,'imagen':imagen},
			       	dataType: 'json'
			     })
			     .done(function(response){
			     	//swal('¡Rechazada!', response.message, response.status);
			     	alertify.success('El proceso se modificó correctamente');
					 location.reload();
			     })
			     .fail(function(){
			     	//swal('Oops...', 'Algo salio mal vuelve a intentarlo mas tarde', 'error');
					alertify.error('Ocurrió un error, intentelo más tarde.')			     
				 });

	/*id=$('#idMotivoRechazo').val();
	motivo=$('#idMotivoRechazoTexto').val();

		cadena= "id=" + id +
			"&motivo=" + motivo;

			$.ajax({
					type: "POST",
			   		url: "rechazar.php",
			       	data:cadena,
			       	success:function(r){
						   if(r==1){
							   alertify.success('La cita se envió al consejo de CANACINTRA Monclova para su validación.');
								location.reload();						   
						   }else{
							   alertify.error('Ocurrió un error, intentelo más tarde. :c')
							   //location.reload();
						   }
					   }
			     });*/
}

$(function() {
    $('#CP').on('keyup', function() {
        var cp = $('#CP').val();
        var url = 'buscar_cp.php';
        $.ajax({
            type: 'POST',
            url: url,
            data: 'cp=' + cp,
            success: function(datos) {
                $('#agrega-registros').html(datos);
            }
        });
        return false;
    });
});



