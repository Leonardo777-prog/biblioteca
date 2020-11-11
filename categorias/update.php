<?php 
require_once '../libs/header.php';

if(!empty($_GET['idCategoria']) && $_SESSION['User']['Rol'] === 'admin'){
    
    $idCategoria = $_GET['idCategoria'];

    $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
    $categorias = prepare_select($conexion, $sql, [$idCategoria]);

    if($categorias->num_rows > 0){
        $categoria = $categorias->fetch_assoc();
    }

    
}else{
    header('Location: /biblioteca2/index.php');
}
?>

<main class="contenedor inicio">
    <h2 class="centrar__texto">Editar Categoria</h2>
    <div class="columnas__girs--6-6">
        <div>
            <img src="../assets/img/imagenes/undraw_reading_time_gvg0.svg" alt="">
        </div>
        <div class="contacto">
            <form method='#' action="#" id="formulario">
                <input type="hidden" name="idCategoria" id="idCategoria" value="<?=$categoria['id_categoria']?>">
                <div class='usuario__update'>
                    <label>Nombre</label>
                    <input type="text" value="<?=$categoria['nombre']?>" name="nombre" id="nombre" class='inputCampo__radius1'>
                </div>
                <input type='submit' class='btn_l btn__ok' value='Modificar' style='margin: 2rem 10rem;'>
            </form>
        </div>
    </div>
</main>
<script src="/biblioteca2/js/ajax/categorias/update.js"></script>
<?php require_once '../libs/footer.php'; ?>