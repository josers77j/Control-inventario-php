var perfilOculto = $("#perfilOculto").val();

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
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

} );

$("#nuevaCategoria").change(function(){

	var idCategoria = $(this).val();

	var datos = new FormData();
  	datos.append("idCategoria", idCategoria);

  	$.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

      	if(!respuesta){

      		var nuevoCodigo = idCategoria+"01";
      		$("#nuevoCodigoProducto").val(nuevoCodigo);

      	}else{

      		var nuevoCodigo = Number(respuesta["codigo_producto"]) + 1;
          	$("#nuevoCodigoProducto").val(nuevoCodigo);
      	}
      }
  	})

})


function convertLinuxDate(linux_date) {
    //linux_date = "2001-01-02"
    var arrDate = linux_date.split("-");
    return arrDate[1] + "/" +arrDate[2] + "/" + arrDate[0];
}
//returns 01/02/2001

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
        /** ================ CATEGORIAS =================== **/

          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["id_categoria"]);
                  $("#editarCategoria").html(respuesta["categoria"]);

              }

          })
          
            /** ================ STATUS =================== **/

            var datosCategoria = new FormData();
          	datosCategoria.append("idStatus",respuesta["id_status"]);

			$.ajax({

				url:"ajax/status.ajax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta){


					$(`#${respuesta["nombre"]}`).val(respuesta["id_status"]);
					$(`#${respuesta["nombre"]}`).html(respuesta["nombre"]);
				}

			})

           $("#editarCodigoProducto").val(respuesta["codigo_producto"]);
           $("#editarNombreProducto").val(respuesta["nombre"]);
		   $("#editarPrecioUnitarioProducto").val(respuesta["precio_unitario"]);
           $("#editarCantidadProducto").val(respuesta["cantidad"]);
           $("#editarNumeroContratoProducto").val(respuesta["numero_contrato"]);
           $("#editarNumeroOfertaCompraProducto").val(respuesta["numero_oferta_compra"]);
           $("#editarFechaRecepcionProducto").val(respuesta["fecha_recepcion"]);

      }

  })

})

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	swal({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=productos&idProducto="+idProducto;

        }


	})

})
	
