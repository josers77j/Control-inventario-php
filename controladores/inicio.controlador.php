<?php
class ControladorInicio
{
    
    static public function ctrMostrarInicio()
    {
        return $respuesta = ModeloInicio::mdlMostrarInicio();
    }

    static public function ctrMostrarBanner()
    {
        return $respuesta = ModeloInicio::mdlMostrarBanner();
    }
}
