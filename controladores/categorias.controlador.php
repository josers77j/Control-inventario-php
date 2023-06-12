<?php
class ControladorCategoria
{
    static public function ctrMostrarCategoria($item, $valor)
    {
        $tabla = "tbl_categoria";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;
    }

    static public function crtCrearCategoria($data)
    {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[0]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[1])
            ) {
                $tabla = "tbl_categoria";
                $datos = array("nombre" => $data[0], "descripcion" => $data[1]);
                $respuesta = ModeloCategorias::mdlIngresarCategorias($tabla, $datos);
                
                return $respuesta;                
            }else{
                $respuesta = "error";
                return $respuesta;
            }
    }

    static public function ctrEditarCategoria($data)
    {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[0]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[1]) &&
                preg_match('/^[0-9 ]+$/', $data[2])
            ) {
                $tabla = "tbl_categoria";

                $datos = array(
                    "nombre" => $data[0],
                    "descripcion" => $data[1],
                    "id_categoria" => $data[2]
                );
                $respuesta = ModeloCategorias::mdlEditarCategorias($tabla, $datos);

                return $respuesta;
            } else {
                $respuesta = "error";
                return $respuesta;
            }
        
    }

    static public function ctrBorrarCategoria($id)
    {
            $tabla = "tbl_categoria";
            $respuesta = ModeloCategorias::mdlBorrarCategorias($tabla, $id);
            return $respuesta;
    }
}
