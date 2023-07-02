<?php
class ControladorGestorProductos
{
    static public function ctrMostrarGestorProductos($valor)
    {
        $respuesta = ModeloGestorProgramas::mdlMostrarGestorProgramas($valor);

        return $respuesta;
    }

    static public function crtCrearGestorProductos($data)
    {
            if (
                preg_match('/^[0-9 ]+$/', $data[0]) &&
                preg_match('/^[0-9 ]+$/', $data[1])
            ) {
                $datos = array( "id_usuario" => $data[1],
                                "id_programa" => $data[0],
                                "fecha" => date("Y-m-d"),
                                "total" => 0,
                                "cantidad" => 0,
                                "id_status" => 1);
                $respuesta = ModeloGestorProgramas::mdlIngresarGestorProgramas($datos);
                
                return $respuesta;                
            }else{
                $respuesta = "error";
                return $respuesta;
            }
    }

    static public function crtEditarGestorProductos($data)
    {
            if (
                preg_match('/^[0-9 ]+$/', $data[0]) &&
                preg_match('/^[0-9 ]+$/', $data[1]) &&
                preg_match('/^[-+]?[0-9]+(\.[0-9]+)?$/', $data[2]) &&
                preg_match('/^[0-9 ]+$/', $data[3])
            ) {
                $datos = array( "id_programa" => $data[0],
                                "cantidad" => $data[1],
                                "total" => $data[2],
                                "idProgramaProducto" => $data[3]);

                $respuesta = ModeloGestorProgramas::mdlEditarGestorProgramas($datos);
                
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

    static public function ctrObtenerPresupuesto($id)
    {
        return $respuesta = ModeloGestorProgramas::mdlObtenerPresupuesto($id);
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
