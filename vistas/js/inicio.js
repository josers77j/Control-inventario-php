$(document).ready(function () {
  cargarInicio();
  $('#dateRange').daterangepicker({
    opens: 'left',
    ranges: {
      'Hoy': [moment(), moment()],
      'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este Mes': [moment().startOf('month'), moment().endOf('month')],
      'Mes Pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
      'Hace un Año': [moment().subtract(1, 'year'), moment()]
    },
    locale: {
      format: 'YYYY/MM/DD',
      separator: ' - ',
      applyLabel: 'Aplicar',
      cancelLabel: 'Cancelar',
      fromLabel: 'Desde',
      toLabel: 'Hasta',
      customRangeLabel: 'Rango Personalizado',
      weekLabel: 'S',
      daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      firstDay: 1
    }
  }, function (start, end) {
    // Función de devolución de llamada al seleccionar el rango de fechas
    var startDate = start ? start.format('YYYY-MM-DD') : '0'; // Si es null, se establece en cero
    var endDate = end ? end.format('YYYY-MM-DD') : '0'; // Si es null, se establece en cero

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

  $("#fechaSwitch").change(function() {
    dateSwitch();
  });
  $("#tipoReporte").change(function () {
    dateSelected();
  });

});



function cargarInicio() {
  $.ajax({
    url: 'ajax/inicio.ajax.php?metodo=mostrar',
    type: "GET",
    dataType: "json",
    success: function (respuesta) {
      $("#data1").text(respuesta[0].contador);
      $("#data2").text(respuesta[1].contador);
      $("#data3").text(respuesta[2].contador);
      $("#data4").text(respuesta[3].contador);
    },
    error: function (respuesta) {
      mostrarError(respuesta);
    }
  });
}

function dateSelected(){
  var selectElement = document.getElementById('tipoReporte');
  var fechaInput = document.getElementById('dateRange');
  var switchElement = document.getElementById('fechaSwitch');

  if (selectElement.value === "1" || selectElement.value === "4") {
    fechaInput.disabled = true;
  } else {
    fechaInput.disabled = false;
    if (switchElement.checked) {
      fechaInput.disabled = true;
    } else {
      fechaInput.disabled = false;
    }
  }
}

function dateSwitch() {
  var selectElement = document.getElementById('tipoReporte');
  var fechaInput = document.getElementById('dateRange');
  var switchElement = document.getElementById('fechaSwitch');
  // Código para ejecutar cuando cambie el estado del switch
  console.log("Switch cambiado");
  if (selectElement.value === "1" || selectElement.value === "4") {
    fechaInput.disabled = true;
  } else {
    if (switchElement.checked) {
      fechaInput.disabled = true;
    } else {
      fechaInput.disabled = false;
    }
  }

}



//##############################################################
//Este codigo envia la data para poder generar los reportes.
//##############################################################
$("#FormReporte").submit(function(event) {
  event.preventDefault();
  var datos = $("#FormReporte").serialize();
  console.log("Datos a enviar: " + datos);

  // Verificar si existe dateRange en los datos
  if (datos.includes("dateRange")) {
    
  var fechaInicio = datos.split("dateRange=")[1].split("%20-%20")[0];
  var fechaFin = datos.split("dateRange=")[1].split("%20-%20")[1];

  // Convertir las fechas al formato adecuado (YYYY-MM-DD)
  var fechaInicioFormatted = fechaInicio.replace(/%2F/g, '-');
  var fechaFinFormatted = fechaFin.replace(/%2F/g, '-');

  // Eliminar los rangos de fecha anteriores
  datos = datos.replace(/&?dateRange=.*?(?=&|$)/, '');

  // Agregar las fechas convertidas a la variable data

  //###################################################
  //La variable data es la que sera enviada
  //puedes usar ajax para enviar la info al modulo de pdf
  //y del modulo pdf directamente al modelo u controlador
  //################################################### 
  var data = datos + "&fechainicio=" + fechaInicioFormatted + "&fechafin=" + fechaFinFormatted;

  console.log("Data a enviar: " + data);

  }else{
//####################################################################################
//en caso de no enviar fecha, entonces manda la info con la variable datos directamente
//####################################################################################
    datos
  }

  // Aquí puedes realizar el envío de la variable data
});





function mostrarError(respuesta) {
  swal({
    type: "error",
    title: "Error al procesar la información",
    showConfirmButton: true,
    confirmButtonText: "Cerrar",
    closeOnConfirm: false
  }).then(function (result) {
    if (result.value) { }
  });
}

