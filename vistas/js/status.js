$(".tablas").on("click", ".btnEditarStatus", function(){

	var idStatus = $(this).attr("idStatus");

	var datos = new FormData();
	datos.append("idStatus", idStatus);

	$.ajax({
		url: "ajax/status.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarNombreStatus").val(respuesta["nombre"]);
     		$("#idStatus").val(respuesta["id_status"]);

     	}

	})


})

$(".tablas").on("click", ".btnEliminarStatus", function(){

	 var idStatus = $(this).attr("idStatus");

	 swal({
	 	title: '¿Está seguro de borrar el status?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar status!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=status&idStatus="+idStatus;

	 	}

	 })

})