
//cargamos los datos, comprobando que la ruta actual sea inventario
$(document).ready(function () {
  if (window.location.pathname.includes("inventario")) {
    tablaInventario = $('#tabla-inventarios');
    tablaInventarioInactivos = $('#tabla-inventarios-inactivos')
    cargarInventario();
  }
});

function configurarDataTableInventario(selector) {
  $(selector).DataTable({
    language: {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}


//traemos los campos que necesitemos mostrar en el formulario de editar
$(document).on('click', '.editar-inventario', function () {
  $("#FormEditarinventario")[0].reset();
  var idInventario = $(this).data("id");

  $.ajax({
    url: "ajax/inventario.ajax.php?metodo=obtener&id=" + idInventario,
    method: "GET",
    dataType: "json",
    success: function (respuesta) {
      $("#editarProductoInventario").val(respuesta.codigo_producto);
      $("#editarCantidadInventario").val(respuesta.cantidad);
      $("#editarFechallegadaInventario").val(respuesta.fecha_llegada_producto);
      $("#editarFechaemisionInventario").val(respuesta.fecha_registro);
      $("#editarStatusInventario").val(respuesta.id_status);

      $("#FormEditarinventario").attr("data-id", idInventario);
    },
    error: function () {
      mostrarError();
    },
  });
});

//obtenemos el id del registro a eliminar y si el administrador desea eliminar dicho registro
$(document).on('click', '.eliminar-inventario', function () {
  var idInventario = $(this).data("id");

  swal({
    title: "¿Está seguro de anular este registro de inventario?",
    text: "¡La cantidad de producto volvera a como era antes de este registro, asegurese de esta accion, no hay vuelta atras!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'cancelar',
    confirmButtonText: '¡Sí, anular!'
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: "ajax/inventario.ajax.php?metodo=anular&id=" + idInventario,
        method: "GET",
        success: function (respuesta) {
         if (respuesta.includes("ok")) {
          swal({
            type: "success",
            title: "Registro anulado Correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
          }).then(function (result) {
            if (result.value) { }
          });
          var ulElement = document.getElementById("Listanotificaciones");
          ulElement.innerHTML = "";
          var ulModal = document.getElementById("ListamodalNotificaciones");
            ulModal.innerHTML = "";
          cargarNotificaciones(document.getElementById('token').getAttribute('data-id'));
          var tablaInventario = $('#tabla-inventarios');
          tablaInventario.DataTable().destroy();

          cargarInventario();
         }else{
          mostrarError(respuesta);
         }
        },
        error: function (respuesta) {
          mostrarError(respuesta);
        },
      });
    }
  });
});

$("#FormNuevainventario").submit(function (event) {
  event.preventDefault();
  var datos = $("#FormNuevainventario").serialize();
  datos += "&metodo=nuevo";
  $.ajax({
    url: "ajax/inventario.ajax.php",
    type: "POST",
    data: datos,
    success: function (respuesta) {
      if (respuesta.includes("ok")) {

        swal({
          type: "success",
          title: "Inventario añadido correctamente",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
        }).then(function (result) {
          if (result.value) { }
        });
        $("#FormNuevainventario")[0].reset();
        var ulElement = document.getElementById("Listanotificaciones");
        ulElement.innerHTML = "";
        var ulModal = document.getElementById("ListamodalNotificaciones");
        ulModal.innerHTML = "";
        cargarNotificaciones(document.getElementById('token').getAttribute('data-id'));
        cargarInventario();
      } else {
        mostrarError();
      }
    },
    error: function () {
      mostrarError();
    },
  });
});




function cargarInventario() {
  if (tablaInventario && $.fn.DataTable.isDataTable('#tabla-inventarios')) {
    // Si el DataTable ya ha sido inicializado, destruirlo antes de crear uno nuevo
    tablaInventario.DataTable().destroy();
  }

  if (tablaInventarioInactivos && $.fn.DataTable.isDataTable('#tabla-inventarios-inactivos')) {
    // Si el DataTable de inventarios inactivos ya ha sido inicializado, destruirlo antes de crear uno nuevo
    tablaInventarioInactivos.DataTable().destroy();
  }

  configurarDataTableInventario('#tabla-inventarios'); // Configurar DataTable para la tabla de inventarios activos
  configurarDataTableInventario('#tabla-inventarios-inactivos'); // Configurar DataTable para la tabla de inventarios inactivos

  $.ajax({
    url: "ajax/inventario.ajax.php?metodo=mostrar",
    method: "GET",
    dataType: "json",
    success: function (respuesta) {

      var tablaInventario = $('#tabla-inventarios').DataTable();
      var tablaInventarioInactivos = $('#tabla-inventarios-inactivos').DataTable();

      tablaInventario.clear().draw();
      tablaInventarioInactivos.clear().draw();

      var contadorA = 1;
      var contadorI = 1;
      $.each(respuesta, function (index, inventario) {
        if (inventario.status == "Inactivo") {
          var rowData = [
            contadorA,
            inventario.producto,
            inventario.codigo_producto,
            inventario.cantidad,
            inventario.fecha_llegada_producto,
            inventario.fecha_registro,
            inventario.usuario,
            '<div class="btn-group">' +
            '<button data-toggle="modal" data-target="#modalEditarInventario" class="btn btn-info editar-inventario" data-id="' + inventario.id_inventario + '">' +
            '<i class="fa fa-info-circle" aria-hidden="true"></i>' +
            '</button>' +
            '</div>'
          ];
          contadorA++;
          tablaInventarioInactivos.rows.add([rowData]);
        } else {
          var rowData = [
            contadorI,
            inventario.producto,
            inventario.codigo_producto,
            inventario.cantidad,
            inventario.fecha_llegada_producto,
            inventario.fecha_registro,
            inventario.usuario,
            '<div class="btn-group">' +
            '<button data-toggle="modal" data-target="#modalEditarInventario" class="btn btn-info editar-inventario" data-id="' + inventario.id_inventario + '">' +
            '<i class="fa fa-info-circle" aria-hidden="true"></i>' +
            '</button>' +
            '<button class="btn btn-danger eliminar-inventario" data-id="' + inventario.id_inventario + '">' +
            '<i class="fa fa-times"></i>' +
            '</button>' +
            '</div>'
          ];


          contadorI++;
          tablaInventario.rows.add([rowData]);
        }

      });

      tablaInventario.draw();
      tablaInventarioInactivos.draw();
    },
    error: function (respuesta) {
      mostrarError();
    },
  });
}



function mostrarError(respuesta) {
var mensaje = ""
  if (respuesta.includes("INSFP330")) {
    var mensaje = "Ya hay stock en uso de este producto, debe eliminar dicho stock para realizar esta accion"
  }

  swal({
    type: "error",
    title: "Error al procesar la información",
    text: mensaje,
    showConfirmButton: true,
    confirmButtonText: "Cerrar",
    closeOnConfirm: false
  }).then(function (result) {
    if (result.value) { }
  });
}


$(".btnImprimirInventario").on("click", function () {

  window.open("extensiones/tcpdf/pdf/inventario.php", "_blank");

})

$(".btnImprimirInventarioInactivo").on("click", function () {

  window.open("extensiones/tcpdf/pdf/inventario-inactivo.php", "_blank");

})
