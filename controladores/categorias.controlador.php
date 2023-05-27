<?php
class ControladorCategoria
{
    static public function crtCrearCategoria()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreCategoria"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcionCategoria"])
            ) {
                $tabla = "tbl_categoria";
                $datos = array("nombre" => $_POST["nuevoNombreCategoria"], "descripcion" => $_POST["nuevoDescripcionCategoria"]);
                $respuesta = ModeloCategorias::mdlIngresarCategorias($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
					swal({
						  type: "success",
						  title: "La categoria ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {}
                                    window.location = "categorias";
								})

					</script>';
                }
            } else {
                echo '<script>
					swal({
						  type: "error",
						  title: "¡La categoria no puede estar vacia y/o incluir caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {}
							window.location = "categorias";        
						})
			  	</script>';
            }
        }
    }

    static public function ctrMostrarCategoria($item, $valor)
    {
        $tabla = "tbl_categoria";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrEditarCategoria()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreCategoria"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionCategoria"])
            ) {
                $tabla = "tbl_categoria";

                $datos = array(
                    "nombre" => $_POST["editarNombreCategoria"],
                    "descripcion" => $_POST["editarDescripcionCategoria"],
                    "id_categoria" => $_POST["idCategoria"]
                );
                $respuesta = ModeloCategorias::mdlEditarCategorias($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

					swal({
						  type: "success",
						  title: "La categoria ha sido modificada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value){}
                                    window.location = "categorias";
								})

					</script>';
                }
            } else {
                echo '<script>
                swal({
                      type: "error",
                      title: "La categoria no puede estar vacía y/o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value){}
                        window.location = "categorias";
                    })
              </script>';
            }
        }
    }

    static public function ctrBorrarCategoria()
    {
        if (isset($_GET["idCategoria"])) {
            $tabla = "tbl_categoria";
            $datos = $_GET["idCategoria"];

            $respuesta = ModeloCategorias::mdlBorrarCategorias($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>

            
            swal({
                  type: "success",
                  title: "La categoria ha sido borrada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {}
                            window.location = "categorias";
                        })
            </script>';
            }
        }
    }
}
