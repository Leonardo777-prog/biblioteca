<?php
session_start();
require_once 'conexion.php';
require_once 'funciones.php';
$sql = "SELECT * FROM categorias";
$categorias = prepare_select($conexion, $sql);


if (!empty($_SESSION['User'])) {

    $idUsuario = $_SESSION['User']['Id_Usuario'];
    $estadoCarrito = "SELECT COUNT(*) from carrito where estado = 0 and Id_Usuario = $idUsuario";
    $estado = prepare_select($conexion, $estadoCarrito);
    $estado = $estado->fetch_assoc();
    if ($estado['COUNT(*)'] == 1) {
        $sqlCantidad = "SELECT count(*) from det_carrito where id_carrito = ?";
        $existProd = prepare_select($conexion, $sqlCantidad, [$_SESSION['carrito']['id_carrito']]);
        $existProd = $existProd->fetch_assoc();
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@400;700&family=Hind+Madurai:wght@400;700&display=swap" rel="stylesheet">
    <title>Tú Biblioteca</title>
    <link rel="stylesheet" href="/biblioteca2/assets/css/normalize.css">
    <link rel="stylesheet" href="/biblioteca2/assets/css/pushbar.css">
    <link rel="stylesheet" href="/biblioteca2/assets/css/style.css">
    <script src="https://kit.fontawesome.com/93249d5a1c.js" crossorigin="anonymous"></script>

</head>

<body>
    <header class="style__site">
        <div class="contenedor">
            <div class="barra">
                <div class="titulo">
                    <a href="http://localhost/biblioteca2/">
                        <h1>Tu<span class="fw__900">Biblioteca</span></h1>
                    </a>
                </div>
                <div class="items">
                    <?php if (isset($_SESSION['User'])) : ?>
                        <a href="#"><i class="fas fa-user"></i> <?= $_SESSION['User']['Nick'] ?></a>
                        <?php if (!empty($existProd['count(*)'])) : ?>
                            <a href="/biblioteca2/views/pedidos/detallePedidos.php"><i class="fas fa-book"></i> Pedidos <span id='numberDePedidos'><?= $existProd['count(*)'] ?></span></a>
                        <?php else : ?>
                            <a href="/biblioteca2/views/pedidos/detallePedidos.php" style="display: none;" id="itemPedidos"><i class="fas fa-book"></i> Pedidos <span id='numberDePedidos'></span></a>
                        <?php endif ?>
                        <a href="/biblioteca2/usuarios/update.php"><i class="fas fa-user-edit"></i> Editar Perfil</a>
                        <a href="/biblioteca2/acceso/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    <?php else : ?>
                        <a href="/biblioteca2/acceso/login.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                        <a href="/biblioteca2/acceso/register.php"><i class="fas fa-user-plus"></i> Registrarse</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="links__secundarios" id='links__secundarios'>
                <a href="/biblioteca2/index.php"><i class="fas fa-home"></i> Inicio</a>
                <ul class='drop'>
                    <a href="/biblioteca2/"><i class="fas fa-chevron-circle-down"></i> Categorías</a>
                    <div class="cat__drop">
                        <?php if ($categorias->num_rows > 0) : ?>
                            <?php while ($categoria = $categorias->fetch_assoc()) : ?>
                                <li><a href="" class='categoria__search' id="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></a></li>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </ul>
                <a href="/biblioteca2/section/contacto.php"><i class="fab fa-weixin"></i> Contacto</a>
                <?php if (isset($_SESSION['User'])) : ?>
                    <a href="/biblioteca2/section/sugerencias.php"><i class="fab fa-weixin"></i> Sugerencias</a>
                <?php endif; ?>
                <a href="/biblioteca2/section/masSobreNos.php"><i class="fas fa-info-circle"></i> Sobre Nosotros</a>
            </div>
        </div>
    </header>
    <?php if (isset($_SESSION['User']) && $_SESSION['User']['Rol'] == 'admin') : ?>
        <div class="sidebar" data-pushbar-target="bar__menu" id="openMenu">
            <i class="fas fa-ellipsis-v"></i>
        </div>
    <?php endif; ?>