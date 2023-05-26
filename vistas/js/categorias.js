$(".tablas").on("click", ".btnEditarCategoria", function(){

    var idCategoria = $(this).attr("idCategoria");

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({
        url: "ajax/categorias.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
            console.log(respuesta);
            $("#editarNombreCategoria").val(respuesta["nombre"]);
            $("#editarDescripcionCategoria").val(respuesta["descripcion"]);
            $("#idCategoria").val(respuesta["id_categoria"]);
        }


    })
})


$(".tablas").on("click", ".btnEliminarCategoria", function(){
    var idCategoria = $(this).attr("idCategoria");  

    swal({
        title: "¿Esta seguro de borrar la categoria?",
        Text: "¡Si no lo esta puede cancelar la accion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Borrar categoria!'       
    }).then(function(result){
        if (result.value) {
            window.location = "index.php?ruta=categorias&idCategoria=" + idCategoria;
        }
              
    })
})

