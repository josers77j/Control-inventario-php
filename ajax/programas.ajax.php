<?php
require_once "../controladores/programas.controlador.php";
require_once "../modelos/programas.modelo.php";

class AjaxProgramas{
    public $idPrograma;

    public function ajaxEditarPrograma(){
        $item = "id_programa";
        $valor = $this->idPrograma;

        $respuesta = ControladorProgramas::ctrMostrarPrograma($item, $valor);
        echo json_encode($respuesta);
    }
}
if (isset($_POST["idPrograma"])) {
    $programa = new AjaxProgramas();
    $programa->idPrograma = $_POST["idPrograma"];
    $programa->ajaxEditarPrograma();
}
?>