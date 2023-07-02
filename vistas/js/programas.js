//cargamos los datos, comprobando que la ruta actual sea programa
$(document).ready(function() {
    if (window.location.pathname.includes("programas")) {
      tablaPrograma = $('#tabla-programas');
      tablaProgramaInactivos = $('#tabla-programas-inactivos');
      cargarPrograma();
    }
  });
  
  function configurarDataTablePrograma(selector) {
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
  $(document).on('click', '.editar-programa', function() {
    $("#FormEditarprograma")[0].reset();
    var idPrograma = $(this).data("id");
  
    $.ajax({
      url: "ajax/programas.ajax.php?metodo=obtener&id=" + idPrograma ,
      method: "GET",
      dataType: "json",
      success: function(respuesta) {
        $("#editarNombrePrograma").val(respuesta.nombre);
        $("#editarPresupuestoPrograma").val(respuesta.presupuesto);
        $("#editarDescripcionPrograma").val(respuesta.descripcion);
        $("#editarfechaPrograma").val(respuesta.fecha);
        $("#editarStatusPrograma").val(respuesta.id_status);
  
        $("#FormEditarprograma").attr("data-id", idPrograma);
      },
      error: function() {
        mostrarError(respuesta);
      },
    });
  });
  
  $(document).on('click', '.editar', function(event) {
    event.preventDefault();
    var idPrograma = $("#FormEditarprograma").attr("data-id");
    var datos = $("#FormEditarprograma").serialize();
    datos += "&id=" +idPrograma + "&metodo=editar"
    $.ajax({
      url: "ajax/programas.ajax.php",
      method: "POST",
      data: datos,
      dataType: "json",
      success: function(respuesta) {
        if (respuesta.includes("ok")) {
  
          swal({
            type: "success",
            title: "Programa Modificado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
          }).then(function(result) {
            if (result.value) {}
          });
          $("#FormNuevaprograma")[0].reset();
          $(".close").click();
  
          cargarPrograma();
        } else {
          mostrarError(respuesta);
        }
        
      },
      error: function(respuesta) {
        mostrarError(respuesta);
      },
    });
  });

  //obtenemos el id del registro a eliminar y si el administrador desea eliminar dicho registro
  $(document).on('click', '.eliminar-programa', function() {
    var idPrograma = $(this).data("id");
  
    swal({
      title: "¿Está seguro de anular este registro de programa?",
      text: "¡La cantidad de producto volverá a como era antes de este registro, asegúrese de esta acción, no hay vuelta atrás!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'cancelar',
      confirmButtonText: '¡Sí, anular!'       
    }).then(function(result) {
      if (result.value) {
        $.ajax({
          url: "ajax/programas.ajax.php?metodo=anular&id=" + idPrograma,
          method: "GET",
          success: function(respuesta) {          
            if (respuesta.includes("ok")) {
              swal({
                type: "success",
                title: "Registro anulado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
              })
              cargarPrograma();
            } else {
              mostrarError(respuesta);
            }
          },
          error: function(respuesta) {
            mostrarError(respuesta);
          },
        });
      }
    });
  });
  
  $("#FormNuevaprograma").submit(function(event) {
    event.preventDefault();
    var datos = $("#FormNuevaprograma").serialize();
    datos += "&metodo=nuevo";
    $.ajax({
      url: "ajax/programas.ajax.php",
      type: "POST",
      data: datos,
      success: function(respuesta) {
        if (respuesta.includes("ok")) {
  
          swal({
            type: "success",
            title: "Programa añadido correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
          }).then(function(result) {
            if (result.value) {}
          });
          $("#FormNuevaprograma")[0].reset();
          $(".close").click();
  
          cargarPrograma();
        } else {
          mostrarError(respuesta);
        }
      },
      error: function(respuesta) {
        mostrarError(respuesta);
      },
    });
  });
  
  
  
  function cargarPrograma() {
    if (tablaPrograma && $.fn.DataTable.isDataTable('#tabla-programas')) {
      // Si el DataTable ya ha sido inicializado, destruirlo antes de crear uno nuevo
      tablaPrograma.DataTable().destroy();
    }
  
    if (tablaProgramaInactivos && $.fn.DataTable.isDataTable('#tabla-programas-inactivos')) {
      // Si el DataTable de programas inactivos ya ha sido inicializado, destruirlo antes de crear uno nuevo
      tablaProgramaInactivos.DataTable().destroy();
    }
  
    configurarDataTablePrograma('#tabla-programas'); // Configurar DataTable para la tabla de programas activos
    configurarDataTablePrograma('#tabla-programas-inactivos'); // Configurar DataTable para la tabla de programas inactivos
  
    $.ajax({
      url: "ajax/programas.ajax.php?metodo=mostrar",
      method: "GET",
      dataType: "json",
      success: function(respuesta) {
  
        var tablaPrograma = $('#tabla-programas').DataTable();
        var tablaProgramaInactivos = $('#tabla-programas-inactivos').DataTable();
  
        tablaPrograma.clear().draw();
        tablaProgramaInactivos.clear().draw();
  
        var contadorA = 1;
        var contadorI = 1;
        $.each(respuesta, function(index, programa) {
          if (programa.status == "Inactivo") {
            var rowData = [
              contadorA,
              programa.nombre,
              programa.descripcion,
              programa.presupuesto,
              programa.fecha,
              programa.status,
              '<div class="btn-group">' +
                '<button data-toggle="modal" data-target="#modalEditarPrograma" class="btn btn-info editar-programa" data-id="' + programa.id_programa + '">' +
                '<i class="fa fa-info-circle" aria-hidden="true"></i>' +
                '</button>' + 
              '</div>'
            ];
            contadorA++;
            tablaProgramaInactivos.rows.add([rowData]);
          } else {
            var rowData = [
                contadorA,
                programa.nombre,
                programa.descripcion,
                programa.presupuesto,
                programa.fecha,
                programa.status,
              '<div class="btn-group">' + 
                '<button data-toggle="modal" data-target="#modalEditarPrograma" class="btn btn-warning editar-programa" data-id="' + programa.id_programa + '">' +
                '<i class="fa fa-pencil"></i>' +
                '</button>' + 
                '<button class="btn btn-danger eliminar-programa" data-id="' + programa.id_programa + '">' +
                '<i class="fa fa-times"></i>' +
                '</button>' +
              '</div>'
            ];
  
  
            contadorI++;  
            tablaPrograma.rows.add([rowData]);
          }
  
        });
  
        tablaPrograma.draw();
        tablaProgramaInactivos.draw();
      },
      error: function(respuesta) {
        mostrarError(respuesta);
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
    }).then(function(result) {
      if (result.value) {}
    });
  }
  