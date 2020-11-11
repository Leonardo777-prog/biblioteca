<?php 

require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if(!empty($_POST['idLibro'])){
    $id = $_POST['idLibro'];

    $sql = "DELETE FROM libros WHERE id_libro = ?";
    $save = prepare_query($conexion, $sql, [$id]);

    if($save->error){
        echo 'Error';
    }else{
        echo 'Exito';
    }
}

?>