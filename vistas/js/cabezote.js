$(document).ready(function () {
  var token = document.getElementById('token').getAttribute('data-id');
  cargarNotificaciones(token);
});

function cargarNotificaciones(token) {
  $.ajax({
      url: 'ajax/notificaciones.ajax.php?metodo=mostrar&token=' + token,
      type: 'GET',
      dataType: "json",
      success: function (respuesta) {
          var ul = $('#Listanotificaciones');
          var ulModal = $('#ListamodalNotificaciones');
          var countElement = $('#countNotify');
          var count = 0;

          if (respuesta.length > 0) {
              ulModal.append('<li class="small text-right" style="list-style-type: none;">' +
                  '<button class="btn btn-link removerNotificaciones" data-id="${dato.id_alerta}">' +
                  '<i class="fa fa-times-circle" style="font-size:16px;" aria-hidden="true"></i> Borrar todo' +
                  '</button>' +
                  '</li>');
          }else {
              ulModal.append('<li class="small text-center" style="list-style-type: none;">No hay notificaciones</li>');
          }

          // Generar el HTML de los elementos de lista
          var listItems = respuesta.slice(0, 5).map(function (dato) {
              var statusClass = getStatusClass(dato.relevancia);
              var status = getStatus(dato.relevancia);
              return `
            <li class="small">
              <a href="#">
                <div class="media">
                  <div class="media-body">
                    <h5 class="media-heading text-bold ${statusClass}">
                      Alerta: <span class=""><i class="fa fa-circle" aria-hidden="true"></i></span>
                      <button class=" btn-link pull-right removerNotificacion" data-id="${dato.id_alerta}">
                        <i class="fa fa-times-circle" style="font-size:16px;" aria-hidden="true"></i>
                      </button>
                    </h5>
                    <h5 class="mb-1">¡${dato.Mensaje}!</h5>
                    <p class="mb-0">
                      <span class="badge ${status}">Producto: ${dato.nombre}</span> |
                      <span class="badge ${status}">Cantidad: ${dato.cantidad}</span>
                    </p>
                  </div>
                </div>
              </a>
            </li>
            <li class="small divider"></li>
          `;
          });
          var listItemsModal = respuesta.map(function (dato) {
              var statusClass = getStatusClass(dato.relevancia);
              var status = getStatus(dato.relevancia);
              count++; // Incrementar el contador
              return `
              <li class="list-group-item small">
              <a href="#">
                <div class="media">
                  <div class="media-body">
                    <h5 class="media-heading text-bold ${statusClass}">
                      Alerta: <span class=""><i class="fa fa-circle" aria-hidden="true"></i></span>
                      <button class="btn btn-link removerNotificacion pull-right" data-id="${dato.id_alerta}">
                        <i class="fa fa-times-circle" style="font-size:16px;" aria-hidden="true"></i>
                      </button>
                    </h5>
                    <h5 class="mb-1">¡${dato.Mensaje}!</h5>
                    <p class="mb-0">
                      <span class="badge ${status}">Producto: ${dato.nombre}</span> |
                      <span class="badge ${status}">Cantidad: ${dato.cantidad}</span>
                    </p>
                  </div>
                </div>
              </a>
            </li>`;
          });


          // Agregar los elementos de lista al <ul>
          ul.append(listItems.join(''));
          ulModal.append(listItemsModal.join(''));
          // Agregar el enlace "See All Messages" al final de la lista
          

          // Verificar si hay elementos en la respuesta para mostrar los botones de "Borrar todo"
          if (respuesta.length > 0) {
              ul.append('<li><a href="#" data-toggle="modal" data-target="#modalNotificaciones">Ver todas las notificaciones</a></li>');
              ul.append('<li>' +
                  '<button class="btn btn-link removerNotificaciones" data-id="${dato.id_alerta}">' +
                  '<i class="fa fa-times-circle" style="font-size:16px;" aria-hidden="true"></i> Borrar todo' +
                  '</button>' +
                  '</li>');
          } else {
              ul.append('<li class="small text-center">No hay notificaciones</li>');
          }

          
          countElement.text(count);
      },
      error: function (respuesta) {
          mostrarError(response);
      }
  })
}

// Función para obtener la clase CSS según la relevancia
function getStatusClass(relevancia) {
  if (relevancia == 1) {
      return 'text-danger';
  } else if (relevancia == 2) {
      return 'text-warning';
  } else {
      return 'text-success';
  }
}
// Función para obtener la clase CSS según la relevancia
function getStatus(relevancia) {
  if (relevancia == 1) {
      return 'label-danger';
  } else if (relevancia == 2) {
      return 'label-warning';
  } else {
      return 'label-success';
  }
}

$(document).on('click', '.removerNotificacion', function (event) {
  event.stopPropagation();
  var id = $(this).data("id");
  $.ajax({
      url: 'ajax/notificaciones.ajax.php?metodo=desactivar&id=' + id,
      type: "GET",
      dataType: "json",
      success: function (respuesta) {
          var ulElement = document.getElementById("Listanotificaciones");
          ulElement.innerHTML = "";
          var ulModal = document.getElementById("ListamodalNotificaciones");
          ulModal.innerHTML = "";
          cargarNotificaciones(document.getElementById('token').getAttribute('data-id'));
          
      },
      error: function (respuesta) {
          mostrarError(respuesta);
      }

  })
});

$(document).on('click', '.removerNotificaciones', function (event) {
  event.preventDefault();
  var id = document.getElementById('token').getAttribute('data-id');
  swal({
      title: "Esta seguro de vaciar las notificaciones?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'cancelar',
      confirmButtonText: 'Vaciar!'
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          url: 'ajax/notificaciones.ajax.php?metodo=desactivartodo&id=' + id,
          type: "GET",
          dataType: "json",
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
            var ulElement = document.getElementById("Listanotificaciones");
          ulElement.innerHTML = "";
          var ulModal = document.getElementById("ListamodalNotificaciones");
          ulModal.innerHTML = "";
          cargarNotificaciones(document.getElementById('token').getAttribute('data-id'));
          },
          error: function (respuesta) {
            mostrarError();
          },
        });
      }
    });
});


$(document).on('show.bs.modal', '#modalId', function() {
  // Agregar la clase personalizada a la barra de desplazamiento del modal
  $('.modal-body').addClass('custom-scrollbar');
});

$(document).on('hidden.bs.modal', '#modalId', function() {
  // Eliminar la clase personalizada de la barra de desplazamiento del modal
  $('.modal-body').removeClass('custom-scrollbar');
});