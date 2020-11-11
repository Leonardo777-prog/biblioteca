<?php

require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if(!empty($_POST['idLibro']) && !empty($_POST['titulo']) && !empty($_POST['autor']) && !empty($_POST['categoria']) && !empty($_POST['formato']) && !empty($_POST['estado']) && !empty($_POST['sinopsis'])){
    $id = $_POST['idLibro'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $formato = $_POST['formato'];
    $estado = $_POST['estado'];
    $sinopsis = $_POST['sinopsis'];

    $sql = "UPDATE libros SET titulo = ? , descripcion = ?, autor = ?, id_categoria = ?, id_estado = ?, id_formato = ? WHERE id_libro = ?";

    $save = prepare_query($conexion, $sql, [$titulo, $sinopsis, $autor, $categoria, $estado, $formato, $id]);

    if($save->error){
        echo 'error';
    }else{
        echo 'exito';
    }
}

?>