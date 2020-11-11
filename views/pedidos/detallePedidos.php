<?php
require_once '../../libs/header.php';

if (isset($_SESSION['User'])) {
    $idUsuario = $_SESSION['User']['Id_Usuario'];

    //todos los libros del det_carrito que pertenece al carrito en estado 0.
    $sql = "SELECT l.id_libro, l.titulo, l.autor, i.nombre FROM libros l 
            INNER JOIN det_carrito dc ON dc.id_libro = l.id_libro 
            INNER JOIN imagenes i ON i.id_imagen = l.id_imagen 
            INNER JOIN carrito c ON c.id_carrito = dc.id_carrito 
            WHERE c.Id_Usuario = ? AND c.estado = 0";

    $libros = prepare_select($conexion, $sql, [$idUsuario]);
} else {
    header('Location: /biblioteca2/acceso/login.php');
}

?>

<style>
    .pedido__res {
        margin-bottom: 3rem;
        background-color: #eee;
        border-radius: 3rem;
        padding: 2rem;
    }

    .img__pedido {
        width: 100px;
        height: 140px;
        text-align: center;
    }

    .contenedor__pedidos {
        margin-bottom: 3rem;
    }
</style>
<main class="contenedor inicio">
    <h2>Sus Reservas</h2>
    <button class="btn btn__ok acciones" id="reservarPedido">Reservar</button>
    <table class="tabla">
        <thead>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Acciones</th>
        </thead>
        <tbody id="tbody">
            <?php if ($libros->num_rows > 0) : ?>
                <?php while ($libro = $libros->fetch_assoc()) : ?>
                    <tr>
                        <td><img src="/biblioteca2/libros/img/<?= $libro['nombre'] ?>" alt="" class="img__pedido"></td>
                        <td>
                            <?= $libro['titulo'] ?>
                        </td>
                        <td>
                            <?= $libro['autor'] ?>
                        </td>
                        <td>
                            <button class="btn btn__danger acciones" data-id="<?= $libro['id_libro'] ?>">Cancelar</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
</main>
<script src="/biblioteca2/js/ajax/usuarios/cancelarCarrito.js"></script>
<script src="/biblioteca2/js/ajax/usuarios/reservar.js"></script>
<?php
require_once '../../libs/footer.php';
?>