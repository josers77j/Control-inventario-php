<?php
class ControladorProgramas
{

    static public function ctrMostrarPrograma($item, $valor)
    {
        $tabla = "tbl_programa";
        $respuesta = ModeloProgramas::mdlMostrarProgramas($tabla, $item, $valor);

        return $respuesta;
    }

    static public function crtCrearPrograma()
    {
        if (isset($_POST["nuevoNombrePrograma"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombrePrograma"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcionPrograma"]) &&
                preg_match('/^[-+]?[0-9]+(\.[0-9]+)?$/', $_POST["nuevoPresupuestoPrograma"])
            ) {
                $tabla = "tbl_programa";

                $datos = array(
                    "nombre" => $_POST["nuevoNombrePrograma"],
                    "descripcion" => $_POST["nuevoDescripcionPrograma"],
                    "presupuesto" => $_POST["nuevoPresupuestoPrograma"],
                    "fecha" => $_POST["nuevofechaPrograma"]
                );

                $respuesta = ModeloProgramas::mdlIngresarProgramas($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
					swal({
						  type: "success",
						  title: "El programa ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {}
                                    window.location = "programas";
								})

					</script>';
                }
            } else {
                echo '<script>
                    swal({
                          type: "error",
                          title: "¡El programa no puede estar vacio y/o incluir caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {}
                            window.location = "programas";        
                        })
                  </script>';
            }
        }
    }



    static public function ctrEditarPrograma()
    {

        if (isset($_POST["editarNombrePrograma"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombrePrograma"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcionPrograma"]) &&
                preg_match('/^[-+]?[0-9]+(\.[0-9]+)?$/', $_POST["editarPresupuestoPrograma"])
            ) {
                $tabla = "tbl_programa";

                $datos = array(
                    "nombre" => $_POST["editarNombrePrograma"],
                    "descripcion" => $_POST["editarDescripcionPrograma"],
                    "presupuesto" => $_POST["editarPresupuestoPrograma"],
                    "fecha" => $_POST["editarfechaPrograma"],
                    "id_programa" => $_POST["idPrograma"]
                );
                $respuesta = ModeloProgramas::mdlEditarProgramas($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

					swal({
						  type: "success",
						  title: "El programa ha sido modificado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value){}
                                    window.location = "programas";
								})

					</script>';
                }
            } else {
                echo '<script>
                swal({
                      type: "error",
                      title: "El programa no puede estar vacío y/o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value){}
                        window.location = "programas";
                    })
              </script>';
            }
        }
    }

    static public function ctrBorrarPrograma()
    {
        if (isset($_GET["idPrograma"])) {
            $tabla = "tbl_programa";
            $datos = $_GET["idPrograma"];

            $respuesta = ModeloProgramas::mdlBorrarProgramas($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>

            
            swal({
                  type: "success",
                  title: "La programa ha sido borrada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {}
                            window.location = "programas";
                        })
            </script>';
            }
        }
    }
}
