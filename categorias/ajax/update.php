<?php
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if(!empty($_POST['idCategoria']) && !empty($_POST['nombre'])){
    $id = $_POST['idCategoria'];
    $nombre = $_POST['nombre'];

    $sql = "UPDATE categorias SET nombre = ? WHERE id_categoria = ?";
    $save = prepare_query($conexion, $sql, [$nombre, $id]);

    if($save->error){
        echo 'Error';
    }else{
        echo 'Exito';
    }
}

?>