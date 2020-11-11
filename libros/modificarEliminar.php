<?php require_once '../libs/header.php';

if (!empty($_GET['id']) && $_SESSION['User']['Rol'] === 'admin') {
    $sql = "SELECT * FROM categorias";
    $categorias = prepare_select($conexion, $sql);

    $sql = "SELECT * FROM estados";
    $estados = prepare_select($conexion, $sql);

    $sql = "SELECT * FROM formatos";
    $formatos = prepare_select($conexion, $sql);

    // Obtenemos datos del libro actual
    $idLibro = $_GET['id'];
    $sql = "SELECT l.id_libro, l.titulo , l.autor , l.descripcion, l.id_categoria, l.id_formato, l.id_estado, i.nombre FROM libros l INNER JOIN imagenes i ON l.id_imagen = i.id_imagen WHERE l.id_libro = ?";
    
    $libros = prepare_select($conexion, $sql , [$idLibro]);

    if($libros->num_rows > 0){
        $libro = $libros->fetch_assoc();
    }

} else {
    header('Location: /biblioteca2/index.php');
}
?>

<main class="contenedor inicio">
    <h2 class="centrar__texto">Actualizar Libro</h2>
    <div class="columnas__girs--2">
        <div class="img__libro--detalle">
            <img src="/biblioteca2/libros/img/<?=$libro['nombre']?>" alt="">
        </div>
        <div class="detalles">
            <form action="#" id="formulario">
                <input type="hidden" name="idLibro" id="idLibro" value="<?=$libro['id_libro']?>">
            <h2><input type="text" name="titulo" id="titulo" value="<?=$libro['titulo']?>" class="inputCampo__radius1"></h2>
            <p class="format">Por <span class="autor"><input type="text" name="autor" id="autor" value="<?=$libro['autor']?>" class="inputCampo__radius1"></span></p>
            <div class="format">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria">
                    <?php if ($categorias->num_rows > 0) : ?>
                        <?php while ($categoria = $categorias->fetch_assoc()) : ?>
                            <?php if($libro['id_categoria'] === $categoria['id_categoria']): ?>
                                <option selected value="<?=$categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
                            <?php else: ?>
                                <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="format">
                <label for="formato">Formato:</label>
                <select name="formato" id="formato">
                    <?php if($formatos->num_rows > 0): ?>
                        <?php while($formato = $formatos->fetch_assoc()): ?>
                            <?php if($libro['id_formato'] === $formato['id_formato']): ?>
                                <option selected value="<?=$formato['id_formato'] ?>"><?= $formato['nombre'] ?></option>
                            <?php else: ?>
                                <option value="<?= $formato['id_formato'] ?>"><?= $formato['nombre'] ?></option>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div>
                <label for="estado">Estado:</label>
                <select name="estado" id="estado">
                    <option value="" selected disabled>Selecione un estado</option>
                    <?php if($estados->num_rows > 0): ?>
                        <?php while($estado = $estados->fetch_assoc()): ?>
                            <?php if($libro['id_estado'] === $estado['id_estado']): ?>
                                <option selected value="<?=$estado['id_estado'] ?>"><?= $estado['nombre'] ?></option>
                            <?php else: ?>
                                <option value="<?= $estado['id_estado'] ?>"><?= $estado['nombre'] ?></option>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            <h4>Sinopsis</h4>
            <textarea name="sinopsis" id="sinopsis" class="texarea"><?=$libro['descripcion']?>
            </textarea>
            <div style="margin-top: 1rem;">
                <input type="submit" value="Modificar" class="btn_l btn__celeste acciones">
                <a href="#" id="<?=$libro['id_libro']?>" class="btn_l btn__danger acciones">Eliminar</a>
            </div>
            </form>
        </div>
    </div>
</main>
<script src="/biblioteca2/js/ajax/libros/update.js"></script>
<script src="/biblioteca2/js/ajax/libros/eliminar.js"></script>
<?php require_once '../libs/footer.php'; ?>