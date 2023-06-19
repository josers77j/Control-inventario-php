
//cargamos los datos, comprobando que la ruta actual sea gestorPrograma
$(document).ready(function () {
    if (window.location.pathname.includes("gestor-programas")) {
        tablaGestorProgramas = $('#tabla-gestor-programas');
        cargarGestorPrograma();
        finderProduct("");
        $("#buscarProducto").keyup(function () {
            var buscar = $(this).val();
            finderProduct(buscar);

        });
    }
});


function configurarDataTableGestorProgramas(selector) {
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

// Llamar a la función AJAX desde el evento click
$(document).on('click', '.detalle-programas', function() {
    var idProgramaProducto = $(this).data("id");
    obtenerDetalleProgramas(idProgramaProducto);
  });

//nos dirigimos hacia detalle programas, para añadir productos al programa 

// Definir la función AJAX en un método aparte
function obtenerDetalleProgramas(idProgramaProducto) {
    $.ajax({
      url: 'ajax/gestor-programas.ajax.php?metodo=detalle&idProgramaProducto=' + idProgramaProducto,
      type: "GET",
      dataType: "json",
      success: function(respuesta) {
        $("#FormAgregarDetalleProducto").attr("data-id", idProgramaProducto);
        // Limpiar contenido actual de la tabla
        $('#tabla-detalle tbody').empty();
  
        // Recorrer los datos recibidos y agregar filas a la tabla
        $.each(respuesta, function(index, programa) {
          var fila = '<tr>' +
            '<td>' + (index + 1) + '</td>' +
            '<td>' + programa.producto + '</td>' +
            '<td>' + programa.cantidad + '</td>' +
            '<td>' + programa.precio_unitario + '</td>' +
            '<td>' + programa.importe + '</td>' +
            "<td>" + '<button class="btn btn-danger borrar-detalleproducto" data-id="' + programa.id_detalle_programa_productos + '">' +
            '<i class="fa fa-times"></i>' +
            '</button>' +
            '</tr>';
  
          $('#tabla-detalle tbody').append(fila);
        });
      },
      error: function(respuesta) {
        mostrarError();
      }
    });
  }


function cargarGestorPrograma() {
    if (tablaGestorProgramas && $.fn.DataTable.isDataTable('#tabla-gestor-programas')) {
        // Si el DataTable ya ha sido inicializado, destruirlo antes de crear uno nuevo
        tablaGestorProgramas.DataTable().destroy();
    }
    configurarDataTableGestorProgramas('#tabla-gestor-programas'); // Configurar DataTable
    $.ajax({
        url: "ajax/gestor-programas.ajax.php?metodo=mostrar",
        method: "GET",
        dataType: "json",
        success: function (respuesta) {

            var tablaGestorProgramas = $('#tabla-gestor-programas').DataTable();

            tablaGestorProgramas.clear().draw();

            var contador = 1;
            $.each(respuesta, function (index, gestorPrograma) {
                if (gestorPrograma.status == "Inactivo") {
                    var rowData = [
                        contador,
                        gestorPrograma.programa,
                        gestorPrograma.costo,
                        gestorPrograma.cantidad,
                        gestorPrograma.fechacreacion,
                        gestorPrograma.usuario,
                        gestorPrograma.status,
                        '<div class="btn-group">' +
                        '<button data-toggle="modal" data-target="#modalEditarGestorInventario" class="btn btn-info editar-gestor-programas" data-id="' + gestorPrograma.id_programa_productos + '">' +
                        '<i class="fa fa-info-circle" aria-hidden="true"></i>' +
                        '</button>' +
                        '</div>'
                    ];
                } else {
                    var rowData = [
                        contador,
                        gestorPrograma.programa,
                        gestorPrograma.costo,
                        gestorPrograma.cantidad,
                        gestorPrograma.fechacreacion,
                        gestorPrograma.usuario,
                        gestorPrograma.status,
                        '<div class="btn-group">' +
                        '<button data-toggle="modal" data-target="#modalAgregarDetalleProducto" class="btn btn-primary detalle-programas" data-id="' + gestorPrograma.id_programa_productos + '">' +
                        '<i class="fa fa-puzzle-piece" aria-hidden="true"></i>' +
                        '</button>' +
                        '<button data-toggle="modal" data-target="#modalInfoGestorProgramas" class="btn btn-info editar-gestor-programas" data-id="' + gestorPrograma.id_programa_productos + '">' +
                        '<i class="fa fa-info-circle" aria-hidden="true"></i>' +
                        '</button>' +
                        '<button class="btn btn-danger eliminar-gestor-programas" data-id="' + gestorPrograma.id_gestorPrograma + '">' +
                        '<i class="fa fa-times"></i>' +
                        '</button>' +
                        '</div>'
                    ];
                }


                tablaGestorProgramas.rows.add([rowData]);
                contador++;
            });

            tablaGestorProgramas.draw();
        },
        error: function (respuesta) {
            mostrarError();
        },
    });
}


function mostrarError() {
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

function finderProduct(buscar) {
    $.ajax({
        url: 'ajax/gestor-programas.ajax.php?metodo=buscar&buscar=' + buscar,
        type: "GET",
        dataType: "json",
        success: function (respuesta) {
            var selectOptions = '<option value="">Seleccionar producto</option>';
            $.each(respuesta, function (index, gestorPrograma) {
                selectOptions += '<option value="' + gestorPrograma.codigo_producto + '">' + gestorPrograma.nombre + '</option>';
            });
            $("#nuevoProductoInventario").html(selectOptions);
        },
        error: function (respuesta) {
            mostrarError();
        }
    });

}

$("#agregarDetalleProducto").click(function (event) {
    event.preventDefault(); // Prevenir el envío del formulario por defecto
  
    var idProgramaProducto = $("#FormAgregarDetalleProducto").attr("data-id");
    var data = $("#FormAgregarDetalleProducto").serialize();
    data += "&idprogramaproducto=" + idProgramaProducto + "&metodo=agregar";
  
    $.ajax({
      url: "ajax/gestor-programas.ajax.php",
      method: "POST",
      data: data,
      success: function (response) {
        if (response.includes("ok")) {
            swal({
                type: "success",
                title: "Producto Agregado Correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
              })
              $('#FormAgregarDetalleProducto')[0].reset();
              obtenerDetalleProgramas(idProgramaProducto);
              cargarGestorPrograma();
        }else{
            mostrarError();
        }
      },
      error: function (xhr, status, error) {
        mostrarError();
      }
    });
  });
  

$(document).on('click', '.borrar-detalleproducto', function () {
    var idDetalleProducto = $(this).data("id");
    var idProgramaProducto = $("#FormAgregarDetalleProducto").attr("data-id");

    swal({
        title: "¿Desea eliminar el producto de la lista actual?",
        text: "¡Puede cancelar esta accion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'cancelar',
        confirmButtonText: '¡Sí, Eliminar!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: "ajax/gestor-programas.ajax.php?metodo=eliminar&id=" + idDetalleProducto,
                method: "GET",
                success: function (respuesta) {
                    swal({
                        type: "success",
                        title: "Registro anulado Correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then(function (result) {
                        if (result.value) { }
                    });
                    var tablaGestorProgramas = $('#tabla-gestor-programas');
                    tablaGestorProgramas.DataTable().destroy();
                    cargarGestorPrograma();
                    obtenerDetalleProgramas(idProgramaProducto);
                },
                error: function () {
                    mostrarError();
                },
            });
        }
    });
});


//traemos los campos que necesitemos mostrar en el formulario de editar
// $(document).on('click', '.editar-gestor-programas', function () {
//     $("#FormEditarinventario")[0].reset();
//     var idInventario = $(this).data("id");

//     $.ajax({
//         url: "ajax/gestor-programas.ajax.php?metodo=obtener&id=" + idInventario,
//         method: "GET",
//         dataType: "json",
//         success: function (respuesta) {
//             $("#editarProductoInventario").val(respuesta.codigo_producto);
//             $("#editarCantidadInventario").val(respuesta.cantidad);
//             $("#editarFechallegadaInventario").val(respuesta.fecha_llegada_producto);
//             $("#editarFechaemisionInventario").val(respuesta.fecha_registro);
//             $("#editarStatusInventario").val(respuesta.id_status);

//             $("#FormEditarinventario").attr("data-id", idInventario);
//         },
//         error: function () {
//             mostrarError();
//         },
//     });
// });

//obtenemos el id del registro a eliminar y si el administrador desea eliminar dicho registro
// $(document).on('click', '.eliminar-inventario', function () {
//     var idInventario = $(this).data("id");

//     swal({
//         title: "¿Está seguro de anular este registro de inventario?",
//         text: "¡La cantidad de producto volvera a como era antes de este registro, asegurese de esta accion, no hay vuelta atras!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         cancelButtonText: 'cancelar',
//         confirmButtonText: '¡Sí, anular!'
//     }).then(function (result) {
//         if (result.value) {
//             $.ajax({
//                 url: "ajax/gestor-programas.ajax.php?metodo=anular&id=" + idInventario,
//                 method: "GET",
//                 success: function (respuesta) {
//                     swal({
//                         type: "success",
//                         title: "Registro anulado Correctamente",
//                         showConfirmButton: true,
//                         confirmButtonText: "Cerrar",
//                         closeOnConfirm: false
//                     }).then(function (result) {
//                         if (result.value) { }
//                     });
//                     var tablaGestorProgramas = $('#tabla-gestor-programas');
//                     tablaGestorProgramas.DataTable().destroy();
//                     cargarGestorPrograma();
//                 },
//                 error: function () {
//                     mostrarError();
//                 },
//             });
//         }
//     });
// });

// $("#FormNuevagestorinventario").submit(function (event) {
//     event.preventDefault();
//     var datos = $("#FormNuevagestorinventario").serialize();
//     datos += "&metodo=nuevo";
//     $.ajax({
//         url: "ajax/gestor-programas.ajax.php",
//         type: "POST",
//         data: datos,
//         success: function (respuesta) {
//             if (respuesta.includes("ok")) {

//                 swal({
//                     type: "success",
//                     title: "Inventario añadido correctamente",
//                     showConfirmButton: true,
//                     confirmButtonText: "Cerrar",
//                     closeOnConfirm: false
//                 }).then(function (result) {
//                     if (result.value) { }
//                 });
//                 $("#FormNuevagestorinventario")[0].reset();
//                 $(".close").click();

//                 cargarGestorPrograma();
//             } else {
//                 mostrarError();
//             }
//         },
//         error: function () {
//             mostrarError();
//         },
//     });
// });