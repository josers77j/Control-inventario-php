<?php
class ControladorInventario
{
    
    static public function ctrMostrarInventario($item, $valor)
    {
        $tabla = "tbl_inventario";
        $respuesta = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

        return $respuesta;
    }

    static public function crtCrearInventario($data)
    {
        date_default_timezone_set('America/Mexico_City');
            if (
                preg_match('/^[0-9 ]+$/', $data[0]) &&
                preg_match('/^[0-9 ]+$/', $data[1]) &&
                $data[1] > 0 &&
                $data[2] != null &&
                preg_match('/^[0-9 ]+$/', $data[4])
            ) {
                $tabla = "tbl_inventario";
                $datos = array( "codigoproducto" => $data[0], 
                                "cantidadinventario" => $data[1],
                                "fechallegadaproducto" => $data[2],
                                "fecharegistro" => $data[3],
                                "idstatus" => $data[4],
                                "token" => $data[5]);
                $respuesta = ModeloInventario::mdlIngresarInventario($tabla, $datos);
                
                return $respuesta;                
            }else{
                $respuesta = "error";
                return $respuesta;
            }
    }

    static public function ctrEditarInventario($data)
    {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[0]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $data[1]) &&
                preg_match('/^[0-9 ]+$/', $data[2])
            ) {
                $tabla = "tbl_inventario";

                $datos = array(
                    "nombre" => $data[0],
                    "descripcion" => $data[1],
                    "tbl_inventario" => $data[2]
                );
                $respuesta = ModeloInventario::mdlEditarInventario($tabla, $datos);

                return $respuesta;
            } else {
                $respuesta = "error";
                return $respuesta;
            }
        
    }

    static public function ctrAnularInventario($id)
    {
            $tabla = "tbl_inventario";
            $respuesta = ModeloInventario::mdlBorrarInventario($tabla, $id);
            return $respuesta;
    }
}
