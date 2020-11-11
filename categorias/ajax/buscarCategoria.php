<?php
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

if($_REQUEST['idCategoria']){
    $id = $_REQUEST['idCategoria'];
    // SELECT l.* FROM libros l INNER JOIN categorias c ON l.id_categoria = c.id_categoria WHERE c.id_categoria = 5; 
    $sql="SELECT l.id_libro, l.titulo, i.nombre FROM libros l INNER JOIN imagenes i ON l.id_imagen = i.id_imagen WHERE l.id_categoria = ?";
    $libros = prepare_select($conexion, $sql, [$id]);
    // var_dump($libros);
}

?>
<?php if($libros->num_rows > 0): ?>
            <?php while($libro = $libros->fetch_assoc()): ?>
                <div class="libro">
                    <div class="libro__imagen">
                        <img src="/biblioteca2/libros/img/<?=$libro['nombre']?>" alt="Imagen del libro">
                    </div>
                    <div class="titulo__libro">
                        <h3><?=$libro['titulo']?></h3>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>