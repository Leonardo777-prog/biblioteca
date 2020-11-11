<?php 
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if(!empty($_POST['idLibro']) && isset($_SESSION['User'])){


    $idUsuario = $_SESSION['User']['Id_Usuario'];
    $idLibro = $_POST['idLibro'];
    $idCarrito = $_SESSION['carrito']['id_carrito'];

    $sql = "DELETE FROM det_carrito WHERE id_carrito = ? AND id_libro = ?";

    $save = prepare_query($conexion, $sql, [$idCarrito, $idLibro]);

    if($save->error){
        echo 'error';
    }else{
        echo 'exito';
    }

}


?>