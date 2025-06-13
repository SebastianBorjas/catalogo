$(obtener_registros());

function obtener_registros(procesos)
{
	$.ajax({
		url : 'consulta_procesos.php',
		type : 'POST',
		dataType : 'html',
		data : { procesos: procesos },
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
