<?php
require_once "../controladores/programas.controlador.php";
require_once "../modelos/programas.modelo.php";

class AjaxProgramas{


    public function ajaxObtenerPrograma(){
        $item = "id_Programa";
        $valor = $_GET["id"];

        $respuesta = ControladorProgramas::ctrMostrarPrograma($item, $valor);
        echo json_encode($respuesta);
    }

    public function ajaxMostrarPrograma(){
        $item = null;
        $valor = null;
        $respuesta = ControladorProgramas::ctrMostrarPrograma($item,$valor);   
        echo json_encode($respuesta);
    }

    public function ajaxAnularPrograma(){
        $id = $_GET["id"];
        $respuesta = ControladorProgramas::ctrBorrarPrograma($id);
        echo json_encode($respuesta);
    }

    public function ajaxNuevoPrograma(){
        $data = array(
            $_POST["nuevoNombrePrograma"],
            $_POST["nuevoDescripcionPrograma"],
            $_POST["nuevoPresupuestoPrograma"]);
        $respuesta = ControladorProgramas::crtCrearPrograma($data);
        echo json_encode($respuesta);
    }

    public function ajaxEditarPrograma(){
        $data = array(
            $_POST["editarNombrePrograma"],
            $_POST["editarDescripcionPrograma"],
            $_POST["editarPresupuestoPrograma"],
            $_POST["id"]);
        $respuesta = ControladorProgramas::ctrEditarPrograma($data);
        echo json_encode($respuesta);
    }

}


if (isset($_POST["metodo"])) {
    switch($_POST["metodo"]){
        case 'nuevo':
            $Programa = new AjaxProgramas();
            $Programa->ajaxNuevoPrograma();
        break;
        case 'editar':
            $Programa = new AjaxProgramas();
            $Programa->ajaxEditarPrograma();
        break;        
    } 
}
if (isset($_GET["metodo"])) {
    switch ($_GET["metodo"]) {
        case 'mostrar':
                $Programa = new AjaxProgramas();
                $Programa->ajaxMostrarPrograma();
            break;
        case 'obtener':
                $Programa = new AjaxProgramas();
                $Programa->ajaxObtenerPrograma();
            break;
        case 'anular':
                $Programa = new AjaxProgramas();
                $Programa->ajaxAnularPrograma();
            break;    
    }
}
