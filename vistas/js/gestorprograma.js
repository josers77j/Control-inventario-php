//cargamos los datos, comprobando que la ruta actual sea gestorPrograma
$(document).ready(function () {
    if (window.location.pathname.includes("gestorprograma")) {
        tablaGestorProgramas = $('#tabla-gestorprogramas');
        tablaGestorInactivos = $('#tabla-gestor-inactivo');
        cargarGestorPrograma();


        finderProduct("");
        $("#buscarProducto").keyup(function () {
            finderProduct($(this).val());
        });

        finderProgram("");
        FillingProgram("");
        $("#buscarPrograma").keyup(function () {
            finderProgram($(this).val());
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
$(document).on('click', '.detalle-programas', function () {
    var idProgramaProducto = $(this).data("id");
    obtenerDetalleProgramas(idProgramaProducto);
});

$(document).on('click', '.detalle-programas-info', function () {
    var idProgramaProducto = $(this).data("id");
    obtenerDetalleProgramasInfo(idProgramaProducto);
});

//nos dirigimos hacia detalle programas, para añadir productos al programa 

// Definir la función AJAX en un método aparte
function obtenerDetalleProgramas(idProgramaProducto) {
    $.ajax({
        url: 'ajax/gestorprogramas.ajax.php?metodo=detalle&idProgramaProducto=' + idProgramaProducto,
        type: "GET",
        dataType: "json",
        success: function (respuesta) {
            $("#FormAgregarDetalleProducto").attr("data-id", idProgramaProducto);
            // Limpiar contenido actual de la tabla
            $('#tabla-detalle tbody').empty();
            // Recorrer los datos recibidos y agregar filas a la tabla
            $.each(respuesta, function (index, programa) {
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
        error: function (respuesta) {
            mostrarError();
        }
    });
}

function obtenerDetalleProgramasInfo(idProgramaProducto) {
    $.ajax({
        url: 'ajax/gestorprogramas.ajax.php?metodo=detalle&idProgramaProducto=' + idProgramaProducto,
        type: "GET",
        dataType: "json",
        success: function (respuesta) {
            // Limpiar contenido actual de la tabla
            $('#tabla-info tbody').empty();
            // Recorrer los datos recibidos y agregar filas a la tabla
            $.each(respuesta, function (index, programa) {
                var fila = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + programa.producto + '</td>' +
                    '<td>' + programa.cantidad + '</td>' +
                    '<td>' + programa.precio_unitario + '</td>' +
                    '<td>' + programa.importe + '</td>';                   

                $('#tabla-info tbody').append(fila);
            });
        },
        error: function (respuesta) {
            mostrarError();
        }
    });
}
  
  

function cargarGestorPrograma() {
    if (tablaGestorProgramas && $.fn.DataTable.isDataTable('#tabla-gestorprogramas')) {
        // Si el DataTable ya ha sido inicializado, destruirlo antes de crear uno nuevo
        tablaGestorProgramas.DataTable().destroy();
    }
    if (tablaGestorInactivos && $.fn.DataTable.isDataTable('#tabla-gestor-inactivo')) {
        // Si el DataTable de programas inactivos ya ha sido inicializado, destruirlo antes de crear uno nuevo
        tablaGestorInactivos.DataTable().destroy();

    }
    configurarDataTableGestorProgramas('#tabla-gestorprogramas'); // Configurar DataTable
    configurarDataTableGestorProgramas('#tabla-gestor-inactivo');
    $.ajax({
        url: "ajax/gestorprogramas.ajax.php?metodo=mostrar",
        method: "GET",
        dataType: "json",
        success: function (respuesta) {
            var tablaGestor = $('#tabla-gestorprogramas').DataTable();
            var tablaGestorInactivos = $('#tabla-gestor-inactivo').DataTable();

            tablaGestor.clear().draw();
            tablaGestorInactivos.clear().draw();

            var contadorA = 1;
            var contadorB = 1;

            $.each(respuesta, function (index, gestorPrograma) {

                if (gestorPrograma.status == "Inactivo") {
                    var rowData = [
                        contadorA,
                        gestorPrograma.programa,
                        gestorPrograma.costo,
                        gestorPrograma.cantidad,
                        gestorPrograma.fechacreacion,
                        gestorPrograma.usuario,
                        gestorPrograma.status,
                        '<div class="btn-group">' +
                        '<button data-toggle="modal" data-target="#modalInfoGestorProgramas" class="btn btn-info detalle-programas-info" data-id="' + gestorPrograma.id_programa_productos + '">' +
                        '<i class="fa fa-info-circle" aria-hidden="true"></i>' +
                        '</button>' +
                        '</div>'
                    ];
                    contadorA++;
                    tablaGestorInactivos.rows.add([rowData]);
                } else {
                    var rowData = [
                        contadorB,
                        gestorPrograma.programa,
                        gestorPrograma.costo,
                        gestorPrograma.cantidad,
                        gestorPrograma.fechacreacion,
                        gestorPrograma.usuario,
                        gestorPrograma.status,
                        '<div class="dropdown dropleft"><button class="btn btn-default dropdown-toggle fillingInfo" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-th-large" aria-hidden="true"></i><span class="caret"></span></button><ul class="dropdown-menu" aria-labelledby="dropdownMenu1"><div class="btn-group">' +
                        '<button data-toggle="modal" data-target="#modalAgregarDetalleProducto" class="btn btn-primary detalle-programas" data-id="' + gestorPrograma.id_programa_productos + '">' +
                        '<i class="fa fa-puzzle-piece" aria-hidden="true"></i>' +
                        '</button>' +                      
                        '<button data-toggle="modal" data-target="#modalEditarGestorPrograma" class="btn btn-warning editar-gestorPrograma" data-id="' + gestorPrograma.id_programa_productos + '">' +
                        '<i class="fa fa-pencil"></i>' +
                        '</button>' +
                        '<button class="btn btn-success eliminar-gestorprogramas" data-id="' + gestorPrograma.id_programa_productos + '">' +
                        '<i class="fa fa-check-square-o" aria-hidden="true"></i>' +
                        '</button>' +
                        '</div></ul></div>'
                    ];
                    contadorB++;
                    tablaGestor.rows.add([rowData]);
                }



            });

            tablaGestor.draw();
            tablaGestorInactivos.draw();
        },
        error: function (respuesta) {
            mostrarError();
        },
    });
}


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

function finderProduct(buscar) {
    $.ajax({
        url: 'ajax/gestorprogramas.ajax.php?metodo=product&buscar=' + buscar,
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
            mostrarError(respuesta);
        }
    });

}

function finderProgram(buscar) {
    $.ajax({
        url: 'ajax/gestorprogramas.ajax.php?metodo=program&buscar=' + buscar,
        type: "GET",
        dataType: "json",
        success: function (respuesta) {
            var selectOptions = '<option value="">Seleccionar Programa</option>';
            $.each(respuesta, function (index, programa) {
                selectOptions += '<option value="' + programa.id_programa + '">' + programa.nombre + '</option>';
            });
            $("#nuevoNombrePrograma").html(selectOptions);
         
        },
        error: function (respuesta) {
            mostrarError();
        }
    });

}

function FillingProgram(buscar) {
    $.ajax({
        url: 'ajax/gestorprogramas.ajax.php?metodo=program&buscar=' + buscar,
        type: "GET",
        dataType: "json",
        success: function (respuesta) {
            var selectOptions = '<option value="">Seleccionar Programa</option>';
            $.each(respuesta, function (index, programa) {
                selectOptions += '<option value="' + programa.id_programa + '">' + programa.nombre + '</option>';
            });
           
            $("#editarNombrePrograma").html(selectOptions);
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
        url: "ajax/gestorprogramas.ajax.php",
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
                $("#info2").text("$ 0.00");
                $("#info1").text("0");
                finderProduct("");
                cargarGestorPrograma();
                
            } else {
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
                url: "ajax/gestorprogramas.ajax.php?metodo=eliminar&id=" + idDetalleProducto,
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
                    var tablaGestorProgramas = $('#tabla-gestorprogramas');
                    tablaGestorProgramas.DataTable().destroy();
                    finderProduct("");
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

$(document).on('click', '.eliminar-gestorprogramas', function () {
    var idGestorPrograma = $(this).data("id");

    swal({
        title: "Desea finalizar el programa?",
        text: "¡Si no esta seguro, puede cancelar esta accion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'cancelar',
        confirmButtonText: '¡Sí, Finalizar!'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: "ajax/gestorprogramas.ajax.php?metodo=anular&id=" + idGestorPrograma,
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
                        var tablaGestorProgramas = $('#tabla-gestor-programas');
                        tablaGestorProgramas.DataTable().destroy();
                        cargarGestorPrograma();
                    } else {
                        mostrarError(respuesta)
                    }
                },
                error: function (respuesta) {
                    mostrarError(respuesta);
                },
            });
        }
    });
});


$("#FormNuevagestorinventario").submit(function (event) {
    event.preventDefault();
    var datos = $("#FormNuevagestorinventario").serialize();
    datos += "&metodo=nuevo";
    $.ajax({
        url: "ajax/gestorprogramas.ajax.php",
        type: "POST",
        data: datos,
        success: function (respuesta) {
            if (respuesta.includes("ok")) {
                swal({
                    type: "success",
                    title: "Nuevo gestor de programa creado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                })
                $("#FormNuevagestorinventario")[0].reset();
                $(".close").click();

                cargarGestorPrograma();
            } else {
                mostrarError();
            }
        },
        error: function () {
            mostrarError();
        },
    });
});

//traemos los campos que necesitemos mostrar en el formulario de editar
$(document).on('click', '.editar-gestorPrograma', function() {
    $("#FormEditarGestorProgramas")[0].reset();
    var idProgramaProducto = $(this).data("id");
  
    $.ajax({
      url: "ajax/gestorprogramas.ajax.php?metodo=obtener&id=" + idProgramaProducto ,
      method: "GET",
      dataType: "json",
      success: function(respuesta) {
        $("#editarNombrePrograma").val(respuesta.id_programa);
        $("#editarCostoGestor").val(respuesta.total);
        $("#editarCantidadGestor").val(respuesta.cantidad);
  
        $("#FormEditarGestorProgramas").attr("data-id", idProgramaProducto);
      },
      error: function() {
        mostrarError(respuesta);
      },
    });
  });

$("#FormEditarGestorProgramas").submit(function (event) {
    event.preventDefault();
    var idProgramaProducto = $("#FormEditarGestorProgramas").attr("data-id");
    var datos = $("#FormEditarGestorProgramas").serialize();
    datos += "&metodo=editar&id="+idProgramaProducto;
    $.ajax({
        url: "ajax/gestorprogramas.ajax.php",
        type: "POST",
        data: datos,
        success: function (respuesta) {
            if (respuesta.includes("ok")) {
                swal({
                    type: "success",
                    title: "Gestor de programa modificado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                })
                $("#FormEditarGestorProgramas")[0].reset();
                $(".close").click();

                cargarGestorPrograma();
            } else {
                mostrarError();
            }
        },
        error: function () {
            mostrarError();
        },
    });
});

$(document).on('click', '.detalle-programas', function () {
    var id = $(this).data('id');
 
    $.ajax({
        url: "ajax/gestorprogramas.ajax.php?metodo=presupuesto&id=" + id ,
        method: "GET",
        dataType: "json",
        success: function(respuesta) {               
            $("#info3").text("$ "+respuesta[0].presupuesto);
        },
        error: function(respuesta) {
          mostrarError(respuesta);
        },
      });
});

$('#nuevoProductoInventario').change(function() {
    // Obtener el valor seleccionado
    var buscar = $(this).val();
     // Verificar si el valor seleccionado está vacío
     if (buscar === '') {
        $("#info2").text("$ 0.00"); // Asignar valor predeterminado de 0
        $("#info1").text("0");
    }else{
        $.ajax({
            url: 'ajax/gestorprogramas.ajax.php?metodo=product&buscar=' + buscar,
            type: "GET",
            dataType: "json",
            success: function (respuesta) {
                $("#info2").text("$ " + respuesta[0].precio_unitario);              
                $("#info1").text(respuesta[0].cantidad);
            },
            error: function (respuesta) {
                mostrarError(respuesta);
            }
        });
    }
    
    
});
