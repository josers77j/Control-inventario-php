$(".tablas").on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			/* ================= Status ================== */

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

			/* ================= Role ================== */
/* 
			var datosCategoria = new FormData();
          	datosCategoria.append("idRole",respuesta["id_rol"]);

			$.ajax({

				url:"ajax/role.ajax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta){

					$(`#editarRol`).val(respuesta["id_rol"]);
					$(`#editarRol`).html(respuesta["nombre"]);
				}

			}) */
				

			$("#editarRol").val(respuesta["role"]);
			$("#editarUsuario").val(respuesta["usuario"]);
			$("#editarNombre").val(respuesta["nombres"]);
			$("#editarCorreo").val(respuesta["correo"]);
			$("#editarTelefono").val(respuesta["telefono"]);
			$("#passwordActual").val(respuesta["contrasenia"]);

			//Arreglar

		}

	});

})

$(".tablas").on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
 	datos.append("activarId", idUsuario);
  	datos.append("activarUsuario", estadoUsuario);

  	$.ajax({

	  url:"ajax/usuarios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      		if(window.matchMedia("(max-width:767px)").matches){

	      		 swal({
			      title: "El usuario ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "usuarios";
			        }
				});
	      	}
      }

  	})

  	if(estadoUsuario == 2){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoUsuario',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoUsuario',0);

  	}

})

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})
})

$(".tablas").on("click", ".btnEliminarUsuario", function(){

  var idUsuario = $(this).attr("idUsuario");
  var usuario = $(this).attr("usuario");

  swal({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario;
    }
  })

})

$(".recargarPagina").click(function(){
	location.reload();
})





