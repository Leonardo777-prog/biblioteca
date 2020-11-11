<?php
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

$sql = "UPDATE biblioteca.carrito SET estado = '1' WHERE (id_carrito = ?)";

$confirmar = prepare_query($conexion, $sql, [$_SESSION['carrito']['id_carrito']]);

unset($_SESSION['carrito']['id_carrito']);

if ($confirmar->error) {
    echo 0;
} else {
    echo 1;
}

