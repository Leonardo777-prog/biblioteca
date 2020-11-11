<?php require_once '../libs/header.php';

$sql = "SELECT * FROM categorias";
$categorias = prepare_select($conexion, $sql);


$sql = "SELECT * FROM formatos";
$formatos = prepare_select($conexion, $sql);


$sql = "SELECT * FROM estados";
$estados = prepare_select($conexion, $sql);

// Obtener datos del POST
if(!empty($_POST['titulo']) && !empty($_POST['categoria']) && !empty($_POST['formato']) && !empty($_POST['estado']) && !empty($_POST['sinopsis']) && !empty($_POST['autor']) && !empty($_FILES['fileimagen'])){

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $categoria = $_POST['categoria'];
    $formato = $_POST['formato'];
    $estado = $_POST['estado'];
    $sinopsis = $_POST['sinopsis'];

    // Datos imagen
    $filename = $_FILES['fileimagen']['name'];
    
    $path = $_SERVER['DOCUMENT_ROOT'].'/biblioteca2/libros/img';

    move_uploaded_file($_FILES['fileimagen']['tmp_name'], $path .'/'.$filename);


    $sql = "INSERT INTO imagenes (nombre, path, principal ) VALUES (?, ?, 1)";
    $save = prepare_query($conexion, $sql, [$filename, $path]);

    if($save->error){
        echo 'Error';
    }else{
        $idImagen = $save->insert_id;

        $sql = "INSERT INTO libros (titulo, descripcion, autor, id_categoria, id_estado, id_imagen, id_formato) VALUES (?,?,?,?,?,?,?)";

        $save = prepare_query($conexion, $sql, [$titulo, $sinopsis, $autor, $categoria, $estado, $idImagen, $formato]);
    
    
        if($save->error){
            echo 'Guarda bien gato';
        }else{
            header('Location: index.php');
        }
    }



}

?>

<main class="contenedor inicio">
    <h2 class="centrar__texto" style="margin: 1rem;">Crear Libro</h2>
    <div class="columnas__girs--2">
        <div class="img__libro--detalle">
            <img src="/biblioteca2/assets/img/imagenes/amante%20de%20libro.svg" alt="">
        </div>
        <div class="detalles">
            <form action="create.php" method="POST" enctype="multipart/form-data">
                <h2><input type="text" name="titulo" id="titulo" placeholder="TITULO DE LIBRO..." class="inputCampo__radius1" required></h2>
                <p class="format">Por <span class="autor"><input type="text" placeholder="AUTOR..." name="autor" id="autor" class="inputCampo__radius1" required></span></p>
                <div class="format">
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria">
                        <option selected disabled>Selecione una categoria</option>
                        <?php if ($categorias->num_rows > 0) : ?>
                            <?php while ($categoria = $categorias->fetch_assoc()) : ?>
                                <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="format">
                    <label for="categoria">Formato:</label>
                    <select name="formato" id="formato">
                        <option selected disabled>Selecione un formato</option>
                        <?php if ($formatos->num_rows > 0) : ?>
                            <?php while ($formato = $formatos->fetch_assoc()) : ?>
                                <option value="<?= $formato['id_formato'] ?>"><?= $formato['nombre'] ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="format">
                    <label for="fileimagen">Imagen:</label>
                    <input type='file' name="fileimagen">
                </div>
                <div>
                    <label for="categoria">Estado:</label>
                    <select name="estado" id="estado">
                        <option selected disabled>Selecione un estado</option>
                        <?php if ($estados->num_rows > 0) : ?>
                            <?php while ($estado = $estados->fetch_assoc()) : ?>
                                <option value="<?= $estado['id_estado'] ?>"><?= $estado['nombre'] ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <h4>Sinopsis</h4>
                <textarea name="sinopsis" id="sinopsis" class="texarea">
            </textarea>
                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn__ok acciones">Crear</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once '../libs/footer.php'; ?>