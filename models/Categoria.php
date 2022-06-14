<?php
require "../config/Connection.php";

class Categoria
{

    public function __construct()
    {
        
    }

    public function insertar($nombre,$descripcion)
    {
        $sql = "INSERT INTO categoria (nombre,descripcion,condicion)
        VALUES ('$nombre','$descripcion','1')";

        return ejecutarconsulta($sql);
    }

    public function editar($id,$nombre,$descripcion)
    {
        $sql = "UPDATE categoria SET nombre='$nombre',descripcion='$descripcion'
        WHERE idcategoria='$id'";

        return ejecutarconsulta($sql);
    }

    public function desactivar($id)
    {
        $sql = "UPDATE categoria SET condicion='0' 
        WHERE idcategoria='$id'";

        return ejecutarconsulta($sql);
    }

    public function activar($id)
    {
        $sql = "UPDATE categoria SET condicion='1' 
        WHERE idcategoria='$id'";

        return ejecutarconsulta($sql);
    }

    public function mostrar($id)
    {
        $sql = "SELECT * FROM categoria WHERE idcategoria='$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql="SELECT * FROM categoria";
        return ejecutarconsulta($sql);
    }
}
?>