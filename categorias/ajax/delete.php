<?php
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if($_POST['idCategoria']){
    $id = $_POST['idCategoria'];
    
    $sql = "DELETE FROM categorias WHERE id_categoria = ?";

    $save = prepare_query($conexion, $sql, [$id]);

    if($save->error){
        echo 'error al eliminar';
    }else{
        echo 'exito';
    }
}

?>