<?php
require_once "../models/Categoria.php";

$categoria = new Categoria();

$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
        if (empty($idcategoria)){
            $result = $categoria->insertar($nombre,$descripcion);
            echo $result ? "Categoría registrada" : "No se pudo registrar categoría";
        }
        else {
            $result = $categoria->editar($idcategoria,$nombre,$descripcion);
            echo $result ? "Categoría actualizada" : "No se pudo actualizar categoría";
        }
    break;
    case 'desactivar':
        $result = $categoria->desactivar($idcategoria);
        echo $result ? "Categoría desactivada" : "No se pudo desactivar categoría";
    break;
    case 'activar':
        $result = $categoria->activar($idcategoria);
        echo $result ? "Categoría activada" : "No se pudo activar categoría";
    break;
    case 'mostrar':
        $result = $categoria->mostrar($idcategoria);
        echo json_encode($result);
    break;
    case 'listar':
        $result = $categoria->listar();
        $data = Array();

        while($reg=$result->fetch_object())
        {
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->descripcion,
                "3"=>($reg->condicion)?'<span class="label bg-green">Activada</span>':'<span class="label bg-red">Desactivada</span>'
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data
        );
        echo json_encode($results);

    break;
}
?>