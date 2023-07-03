const newLocal = '.sidebar-menu';
$(newLocal).tree()

$(".tablas").DataTable({

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	}
});

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
$('[data-mask]').inputmask()

if(window.matchMedia("(max-width:767px)").matches){
	$("body").removeClass('sidebar-collapse');
}else{
	$("body").addClass('sidebar-collapse');
}

$(document).ready(function() {
	$('#date-range').daterangepicker({
	  opens: 'left',
	  ranges: {
		'Today': [moment(), moment()],
		'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		'Last 7 Days': [moment().subtract(6, 'days'), moment()],
		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		'This Month': [moment().startOf('month'), moment().endOf('month')],
		'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	  }
	}, function(start, end) {
	  // Función de devolución de llamada al seleccionar el rango de fechas
	  var startDate = start.format('YYYY-MM-DD');
	  var endDate = end.format('YYYY-MM-DD');
  
	  // Diferenciar las fechas seleccionadas
	  if (startDate !== endDate) {
		// Las fechas seleccionadas son diferentes, aplicar estilos o realizar acciones adicionales
		console.log(startDate);
		console.log(endDate);
		
		console.log('Fechas diferentes seleccionadas');
		// Aquí puedes aplicar estilos o realizar otras acciones específicas
	  } else {
		// Las fechas seleccionadas son iguales, puedes realizar acciones adicionales si es necesario
		console.log(startDate);
		
		console.log('Misma fecha seleccionada');
		// Aquí puedes aplicar estilos o realizar otras acciones específicas
	  }
	});
  });
  