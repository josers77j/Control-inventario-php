$(".tablas").on("click", ".btnEditarPrograma", function(){

    var idPrograma = $(this).attr("idPrograma");

    var datos = new FormData();
    datos.append("idPrograma", idPrograma);

    $.ajax({
        url: "ajax/programas.ajax.php",
        method: "POST",
        data: datos,
        cache:false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
            console.log(respuesta);
            $("#editarNombrePrograma").val(respuesta["nombre"]);
            $("#editarDescripcionPrograma").val(respuesta["descripcion"]);
            $("#editarPresupuestoPrograma").val(respuesta["presupuesto"]);
            $("#editarfechaPrograma").val(respuesta["fecha"]);
            $("#idPrograma").val(respuesta["id_programa"]);
        }
    })
})


$(".tablas").on("click", ".btnEliminarPrograma", function(){
    var idPrograma = $(this).attr("idPrograma");  

    swal({
        title: "¿Esta seguro de borrar el programa?",
        Text: "¡Si no lo esta puede cancelar la accion!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor : '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Borrar categoria!'       
    }).then(function(result){
        if (result.value) {
            window.location = "index.php?ruta=programas&idPrograma=" + idPrograma;
        }
              
    })
})

