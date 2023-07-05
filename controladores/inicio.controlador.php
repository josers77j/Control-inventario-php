<?php
class ControladorInicio
{
    
    static public function ctrMostrarInicio()
    {
        return $respuesta = ModeloInicio::mdlMostrarInicio();
    }
}
