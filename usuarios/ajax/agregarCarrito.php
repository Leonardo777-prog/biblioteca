<?php
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if (!empty($_SESSION['carrito']['id_carrito'])) {
    // Si el carrito esta definido lo asigno a una variable
    $idCarritoAgregar = $_SESSION['carrito']['id_carrito'];
} else {
    // si no esta definido, creamos un carrito
    $idUsuario = $_SESSION['User']['Id_Usuario'];
    $fecha = date('Y-m-d H:i:s');
    $sqlCrearCarrito = "INSERT INTO carrito (Id_Usuario, fecha, estado) VALUES (?,?,?);";
    $crearCarrito = prepare_query($conexion, $sqlCrearCarrito, [$idUsuario, $fecha, 0]);
    $_SESSION['carrito']['estado'] = 0;
    $_SESSION['carrito']['id_carrito'] = $crearCarrito->insert_id;
    $idCarritoAgregar = $_SESSION['carrito']['id_carrito'];
}

if (!empty($_REQUEST['idLibro']) && isset($_SESSION['User'])) {
    $idLibro = $_REQUEST['idLibro'];

    $sql = "SELECT COUNT(*) FROM det_carrito WHERE id_carrito = ? AND id_libro = ?";
    $detCounts = prepare_select($conexion, $sql, [$idCarritoAgregar, $idLibro]);
    if ($detCounts->num_rows > 0) {
        $detCount = $detCounts->fetch_assoc();
        if ($detCount['COUNT(*)'] > 0) {
            $errorCantidad = 'Solo un libro por persona';
        } else {
            $sql = "INSERT INTO biblioteca.det_carrito (id_carrito, id_libro, cantidad) VALUES (?, ?, ?)";
            prepare_query($conexion, $sql, [$idCarritoAgregar, $idLibro, 1]);
            $errorCantidad = '';
        }
    }
    $cantidadLibro = "SELECT count(*) from det_carrito where id_carrito =?";
    $cantidad = prepare_select($conexion, $cantidadLibro, [$idCarritoAgregar]);
    $cantidad = $cantidad->fetch_assoc();
    echo json_encode(['cantidad' => $cantidad['count(*)'], 'error' => $errorCantidad]);
}
