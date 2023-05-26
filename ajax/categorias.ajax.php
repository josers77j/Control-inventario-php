<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{
    public $idCategoria;

    public function ajaxEditarCategoria(){
        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorCategoria::ctrMostrarCategoria($item, $valor);
        echo json_encode($respuesta);
    }
}
if (isset($_POST["idCategoria"])) {
    $categoria = new ajaxCategorias();
    $categoria->idCategoria = $_POST["idCategoria"];
    $categoria->ajaxEditarCategoria();
}
?>