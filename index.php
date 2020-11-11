<?php require_once './libs/header.php';
$sql = "SELECT l.id_libro, l.titulo, i.nombre, i.path FROM libros l INNER JOIN imagenes i ON l.id_imagen = i.id_imagen";

$libros = prepare_select($conexion, $sql);


?>
<main class="contenedor inicio">

    <header class="header__block">
        <div></div>
        <h2 id='tituloIndex'>Libros Populares</h2>
        <input type="text" name="buscadorDeLibros" id="buscadorDeLibros" class="campo__input" placeholder="Buscar">
    </header>
    <div class="libros__contenedor">
        <?php if ($libros->num_rows > 0) : ?>
            <?php while ($libro = $libros->fetch_assoc()) : ?>
                <div class="libro">
                    <div class="libro__imagen">
                        <a href=<?= "views/libros/detalleLibro.php?idLibro=$libro[id_libro]" ?>>
                            <img src="/biblioteca2/libros/img/<?= $libro['nombre'] ?>" alt="Imagen del libro">
                        </a>
                    </div>
                    <div class="titulo__libro">
                        <h3><?= $libro['titulo'] ?></h3>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>
<script src="/biblioteca2/js/ajax/libros/buscadorlibros.js"></script>
<?php require_once './libs/footer.php'; ?>