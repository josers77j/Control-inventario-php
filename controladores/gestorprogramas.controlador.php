<?php
class ControladorGestorProductos
{
    static public function ctrMostrarGestorProductos($item, $valor)
    {
        $tabla = "tbl_programa_productos";
        $respuesta = ModeloGestorProgramas::mdlMostrarGestorProgramas($tabla, $item, $valor);

        return $respuesta;
    }

    static public function crtCrearGestorProductos($data)
    {
            if (
                preg_match('/^[0-9 ]+$/', $data[0]) &&
                preg_match('/^[0-9 ]+$/', $data[1]) &&
                $data[2] != null &&
                $data[3] != null &&
                preg_match('/^[0-9 ]+$/', $data[4])
            ) {
                $tabla = "tbl_inventario";
                $datos = array( "codigoproducto" => $data[0], 
                                "cantidadinventario" => $data[1],
                                "fechallegadaproducto" => $data[2],
                                "fecharegistro" => $data[3],
                                "idstatus" => $data[4]);
                $respuesta = ModeloGestorProgramas::mdlIngresarGestorProgramas($datos);
                
                return $respuesta;                
            }else{
                $respuesta = "error";
                return $respuesta;
            }
    }


    static public function ctrAnularGestorProductos($id)
    {
            
            $respuesta = ModeloGestorProgramas::mdlAnularGestorProgramas($id);
            return $respuesta;
    }
    //para buscar productos en base a lo que teclees 
    static public function ctrBuscarProducto($buscar)
    {
        return $respuesta = ModeloGestorProgramas::mdlBuscarProducto($buscar);
    }
    //para buscar los programas en base a lo que teclees  
    static public function ctrBuscarPrograma($buscar)
    {
        return $respuesta = ModeloGestorProgramas::mdlBuscarPrograma($buscar);
    }

    static public function ctrMostrarDetalleProducto($idProgramaProducto)
    {
        return $respuesta = ModeloGestorProgramas::mdlMostrarDetalleProducto($idProgramaProducto);
    }

    static public function ctrAgregarDetalleProducto($data)
    {
        if (
                preg_match('/^[0-9 ]+$/', $data[0]) &&
                preg_match('/^[0-9 ]+$/', $data[1]) &&
                $data[1] > 0 &&
                preg_match('/^[0-9 ]+$/', $data[2])
        ) {
            $datos = array( "producto" => $data[0], 
            "cantidad" => $data[1],
            "idprogramaproducto" => $data[2]);
        return $respuesta = ModeloGestorProgramas::mdlAgregarDetalleProducto($datos);
        }else
        {
            return "error";
        }
    }

    static public function ctrEliminarDetalleProductos($id)
    {
            
            
            return $respuesta = ModeloGestorProgramas::mdlEliminarDetalleProgramas($id);;
    }
}
