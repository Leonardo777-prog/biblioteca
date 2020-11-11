<?php 
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';
if(!empty($_REQUEST['libros'])){
    $busqueda = $_REQUEST['libros'];
    $sql="SELECT l.id_libro, l.titulo, i.nombre, i.path FROM libros l INNER JOIN imagenes i ON l.id_imagen = i.id_imagen where l.titulo like '%".$busqueda."%'";
} else {
    $sql="SELECT l.id_libro, l.titulo, i.nombre, i.path FROM libros l INNER JOIN imagenes i ON l.id_imagen = i.id_imagen";
}

$libros = prepare_select($conexion, $sql);


?>
        <?php if($libros->num_rows > 0): ?>
            <?php while($libro = $libros->fetch_assoc()): ?>
                <div class="libro">
                    <div class="libro__imagen">
                        <a href="/biblioteca2/libros/modificarEliminar.php?id=<?=$libro['id_libro']?>"><img src="/biblioteca2/libros/img/<?=$libro['nombre']?>" alt="Imagen del libro"></a>
                    </div>
                    <div class="titulo__libro">
                        <h3><?=$libro['titulo']?></h3>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php else : ?>
            <div class='alert alert__danger' style='grid-column:1 / 5'>No se encontaron coincidencias ¯\_(ツ)_/¯, Pero tienes otras buenas opciones</div>
        <?php endif; ?>