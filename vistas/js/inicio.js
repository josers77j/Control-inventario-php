$(document).ready(function () {
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
    }, function (start, end) {
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

$("#FormReporte").submit(function(event) {
    event.preventDefault();
    var datos = $("#FormReporte").serialize();
    console.log("Datos a enviar: " + datos);
    var fechaInicio = datos.split("rango-fecha=")[1].split("%20-%20")[0];
    var fechaFin = datos.split("rango-fecha=")[1].split("%20-%20")[1];
  
    // Convertir las fechas al formato adecuado (YYYY-MM-DD)
    var fechaInicioFormatted = fechaInicio.replace(/%2F/g, '-');
    var fechaFinFormatted = fechaFin.replace(/%2F/g, '-');
  
    console.log("Fecha de inicio: " + fechaInicioFormatted);
    console.log("Fecha de fin: " + fechaFinFormatted);
  
    // Eliminar los rangos de fecha anteriores
    datos = datos.replace(/&?rango-fecha=.*?(?=&|$)/, '');
  
    // Agregar las fechas convertidas a la variable data
    var data = datos + "&fechainicio=" + fechaInicioFormatted + "&fechafin=" + fechaFinFormatted;
  
    console.log("Data a enviar: " + data);
  
    // Aquí puedes realizar el envío de la variable data
  });
  
  
  