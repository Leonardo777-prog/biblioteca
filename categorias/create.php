<?php 
require_once '../libs/header.php';

if(isset($_REQUEST['nombre'])){
    $name = $_REQUEST['nombre'];
    $sql = "INSERT INTO categorias (nombre) VALUES (?)";
    $save = prepare_query($conexion, $sql,[$name]);  
    if($save->error){
        echo 'Error';
    }else{
        header('Location: index.php');
    }
}
?>

<main class="contenedor inicio">
    <h2 class="centrar__texto">Crear Categoria</h2>
    <div class="columnas__girs--6-6">
        <div>
            <img src="../assets/img/imagenes/undraw_Process_re_gws7.svg" alt="">
        </div>
        <div class="contacto">
            <form method='POST' action="create.php">
                <div class='usuario__update'>
                    <label>Nombre</label>
                    <input type="text"  name="nombre" id="nombre" id class='inputCampo__radius1'>
                </div>
                <input type='submit' class='btn_l btn__ok' value='Guardar' style='margin: 2rem 10rem;'>
            </form>
        </div>
    </div>
</main>

<?php require_once '../libs/footer.php'; ?>