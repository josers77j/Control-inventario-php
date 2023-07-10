
//cargamos los datos, comprobando que la ruta actual sea categorias
$(document).ready(function() {
  if (window.location.pathname.includes("categorias")) {
    cargarCategorias();
  }
});

function configurarDataTableCategoria(selector) {
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
$(document).on('click', '.editar-categoria', function() {
  $("#FormEditarcategoria")[0].reset();
  var idCategoria = $(this).data("id");
  
  $.ajax({
    url: "ajax/categorias.ajax.php?metodo=obtener&id=" + idCategoria,
    method: "GET",
    dataType: "json",
    success: function(respuesta) {
      $("#editarNombreCategoria").val(respuesta.nombre);
      $("#editarDescripcionCategoria").val(respuesta.descripcion);
      $("#FormEditarcategoria").attr("data-id", idCategoria);
    },
    error: function() {
      mostrarError();
    },
  });
});

//obtenemos el id del registro a eliminar y si el administrador desea eliminar dicho registro
$(document).on('click', '.eliminar-categoria', function() {
  var idCategoria = $(this).data("id");
  
  swal({
    title: "¿Está seguro de borrar la categoría?",
    text: "¡Si no lo está, puede cancelar la acción, de lo contrario no hay vuelta atras!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sí, borrar categoría!'       
  }).then(function(result) {
    if (result.value) {
      $.ajax({
        url: "ajax/categorias.ajax.php?metodo=eliminar&id=" + idCategoria,
        method: "GET",
        success: function(respuesta) {
          if (respuesta.includes("ok")) {
            swal({
              type: "success",
              title: "Categoria Eliminada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            var tablaCategorias = $('#tabla-categorias');
            tablaCategorias.DataTable().destroy();
            cargarCategorias();
          }else{
            mostrarError();
          }
        },
        error: function() {
          mostrarError();
        },
      });
    }
  });
});

$("#FormNuevacategoria").submit(function(event) {
  event.preventDefault();
  var datos = $("#FormNuevacategoria").serialize();
  datos += "&metodo=nuevo";
  $.ajax({
    url: "ajax/categorias.ajax.php",
    type: "POST",
    data: datos,
    success: function(respuesta) {
      if (respuesta.includes("ok")) {
        var tablaCategorias = $('#tabla-categorias');
        tablaCategorias.DataTable().destroy();
        swal({
          type: "success",
          title: "La categoria ha sido guardada correctamente",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
        }).then(function(result) {
          if (result.value) {}
        });
        $("#FormNuevacategoria")[0].reset();
        cargarCategorias();
      } else {
        mostrarError();
      }
    },
    error: function() {
      mostrarError();
    },
  });
});

$(document).on('click', '.actualizar-categoria', function(event) {
  event.preventDefault();
  var idCategoria = $("#FormEditarcategoria").attr("data-id");
  var datos = $("#FormEditarcategoria").serialize();
  datos += "&id=" +idCategoria + "&metodo=editar"
  $.ajax({
    url: "ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    dataType: "json",
    success: function(respuesta) {
      if (respuesta.includes("ok")) {
        var tablaCategorias = $('#tabla-categorias');
        tablaCategorias.DataTable().destroy();
        swal({
          type: "success",
          title: "La categoría ha sido actualizada correctamente",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
        }).then(function(result) {
          if (result.value) {}
        });
        $("#FormNuevacategoria")[0].reset();
        cargarCategorias();
      } else {
        mostrarError();
      }
      
    },
    error: function() {
      mostrarError();
    },
  });
});

function cargarCategorias() {
  configurarDataTableCategoria('#tabla-categorias'); // Configurar DataTable
  $.ajax({
    url: "ajax/categorias.ajax.php?metodo=mostrar",
    method: "GET",
    dataType: "json",
    success: function(respuesta) {
      var tablaCategorias = $('#tabla-categorias').DataTable();
      tablaCategorias.clear().draw();
      
      var contador = 1;
      $.each(respuesta, function(index, categoria) {
        var rowData = [
          contador,
          categoria.nombre,
          categoria.descripcion,
          '<div class="btn-group">' +
            '<button data-toggle="modal" data-target="#modalEditarCategoria" class="btn btn-warning editar-categoria" data-id="' + categoria.id_categoria + '">' +
            '<i class="fa fa-pencil"></i>' +
            '</button>' +
            '<button class="btn btn-danger eliminar-categoria" data-id="' + categoria.id_categoria + '">' +
            '<i class="fa fa-times"></i>' +
            '</button>' +
          '</div>'
        ];
        
        tablaCategorias.rows.add([rowData]);
        contador++;
      });

      tablaCategorias.draw();
      
    },
    error: function(respuesta) {
      mostrarError(respuesta);
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
  }).then(function(result) {
    if (result.value) {}
  });
}
