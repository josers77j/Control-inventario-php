<?php
class ControladorProgramas
{

    static public function ctrMostrarPrograma($item, $valor)
    {
        $tabla = "tbl_programa";
        $respuesta = ModeloProgramas::mdlMostrarProgramas($tabla, $item, $valor);

        return $respuesta;
    }

    static public function crtCrearPrograma($data)
    {
        date_default_timezone_set('America/Mexico_City');
        if (isset($_POST["nuevoNombrePrograma"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[0]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ,. ]+$/', $data[1]) &&
                preg_match('/^[-+]?[0-9]+(\.[0-9]+)?$/', $data[2]) &&
                $data[2] > 0
            ) {
                $tabla = "tbl_programa";

                $datos = array(
                    "nombre" => $data[0],
                    "descripcion" => $data[1],
                    "presupuesto" => $data[2],
                    "fecha" => date("Y-m-d"),
                    "id_status" => 1
                );

                $respuesta = ModeloProgramas::mdlIngresarProgramas($tabla, $datos);

                if ($respuesta == "ok") {
                    return "ok";
                }
            } else {
                return "Error Controller";
            }
        }
    }



    static public function ctrEditarPrograma($data)
    {

     
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[0]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ,. ]+$/', $data[1]) &&
                preg_match('/^[-+]?[0-9]+(\.[0-9]+)?$/', $data[2]) &&
                $data[2] > 0
            ) {
                $tabla = "tbl_programa";

                $datos = array(
                    "nombre" => $data[0],
                    "descripcion" => $data[1],
                    "presupuesto" => $data[2],
                    "id_programa" => $data[3]
                );
                $respuesta = ModeloProgramas::mdlEditarProgramas($tabla, $datos);

                if ($respuesta == "ok") {
                   return "ok";
                }
            } else {
                return "error controller";
            }
        
    }

    static public function ctrBorrarPrograma($id)
    {
        if (
            preg_match('/^[0-9 ]+$/', $id)   
                      
        ) {
            $respuesta = ModeloProgramas::mdlBorrarProgramas($id);
            if ($respuesta == "ok") {
               return "ok";
            }
        }else{
            return "error";
        }        
    }
}
