$(".tablas").on("click", ".btnEditarRole", function(){

	var idRole = $(this).attr("idRole");

	var datos = new FormData();
	datos.append("idRole", idRole);

	$.ajax({
		url: "ajax/role.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarNombreRole").val(respuesta["nombre"]);
            $("#editarDescripcionRole").val(respuesta["descripcion"]);
     		$("#idRole").val(respuesta["id_rol"]);
            
     	}

	})


})

$(".tablas").on("click", ".btnEliminarRole", function(){

	 var idRole = $(this).attr("idRole");

	 swal({
	 	title: '¿Está seguro de borrar el role?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar role!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=role&idRole="+idRole;

	 	}

	 })

})