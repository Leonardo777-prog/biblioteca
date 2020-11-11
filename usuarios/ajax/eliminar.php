<?php
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if(!empty($_POST['idUsuario'])){

    $idUsuario = $_POST['idUsuario']; 

    $sql = "UPDATE usuarios SET Estado = 0 WHERE Id_Usuario = ?";
    $save = prepare_query($conexion, $sql, [$idUsuario]);

    if($save->error){
        echo 'Error';
    }else{
        echo 'Exito';
    }
}
?>