$(obtener_registros());

function obtener_registros(clientes)
{
	$.ajax({
		url : 'consulta_clientes.php',
		type : 'POST',
		dataType : 'html',
		data : { clientes: clientes },
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
