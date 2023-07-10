<?php

class ControladorReportes{

    static public function ctrMostrarProductosReporte($status){

        $respuesta = ModeloReportes::mdlMostrarInventarioActual($status);
        return $respuesta;

    }

}