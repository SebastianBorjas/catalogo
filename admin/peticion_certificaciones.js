$(obtener_registros());

function obtener_registros(certificaciones)
{
	$.ajax({
		url : 'consulta_certificaciones.php',
		type : 'POST',
		dataType : 'html',
		data : { certificaciones: certificaciones },
		})

	.done(function(resultado){
		$("#tabla_resultado").html(resultado);
	})
}

$(document).on('keyup', '#busqueda', function()
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
