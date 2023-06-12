<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{
    

    public function ajaxObtenerCategoria(){
        $item = "id_categoria";
        $valor = $_GET["id"];

        $respuesta = ControladorCategoria::ctrMostrarCategoria($item, $valor);
        echo json_encode($respuesta);
    }

    public function ajaxMostrarCategoria(){
        $item = null;
        $valor = null;
        $respuesta = ControladorCategoria::ctrMostrarCategoria($item,$valor);   
        echo json_encode($respuesta);
    }

    public function ajaxEliminarCategoria(){
        $id = $_GET["id"];
        $respuesta = ControladorCategoria::ctrBorrarCategoria($id);
        echo json_encode($respuesta);
    }

    public function ajaxNuevoCategoria(){
        $data = array($_POST["nuevoNombreCategoria"],$_POST["nuevoDescripcionCategoria"]);
        $respuesta = ControladorCategoria::crtCrearCategoria($data);
        echo json_encode($respuesta);
    }

    public function ajaxEditarCategoria(){
        $data = array($_POST["editarNombreCategoria"],$_POST["editarDescripcionCategoria"], $_POST["id"]);
        $respuesta = ControladorCategoria::ctrEditarCategoria($data);
        echo json_encode($respuesta);
    }

}

if (isset($_POST["metodo"])) {
    switch($_POST["metodo"]){
        case 'nuevo':
            $categoria = new AjaxCategorias();
            $categoria->ajaxNuevoCategoria();
        break;
        case 'editar':
            $categoria = new AjaxCategorias();
            $categoria->ajaxEditarCategoria();
        break;        
    } 
}
if (isset($_GET["metodo"])) {
    switch ($_GET["metodo"]) {
        case 'mostrar':
                $categoria = new AjaxCategorias();
                $categoria->ajaxMostrarCategoria();
            break;
        case 'obtener':
                $categoria = new AjaxCategorias();
                $categoria->ajaxObtenerCategoria();
            break;
        case 'eliminar':
                $categoria = new AjaxCategorias();
                $categoria->ajaxEliminarCategoria();
            break;    
    }
    
}

