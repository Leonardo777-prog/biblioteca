<?php
require_once '../libs/header.php';
$sql = "SELECT s.*,u.Nick FROM sugerencias s inner join usuarios u where s.Id_Usuario=  u.Id_Usuario order by rand() LIMIT 3";

$comentarios = prepare_select($conexion, $sql);
$com = 1;
?>
<main class="contenedor inicio">
    <h2 class="centrar__texto">Por Favor mandanos tu sugerencia</h2>
    <div class="columnas__girs--6-6">
        <img src="/biblioteca2/assets/img/imagenes/undraw_Process_re_gws7.svg" alt="">
        <div>
            <?php if ($comentarios->num_rows > 0) : ?>
                <?php while ($comentario = $comentarios->fetch_assoc()) : ?>
                    <div class="comentario__Sugerencia" id="<?= "comentario$com" ?>">
                        <div class="perfil__comentario">
                            <img src="./51+NUIgEc9L._AC_UL600_SR462,600_.jpg" alt="" class="foto__comentario">
                            <span class="name__usuario--comentaio"><?= $comentario['Nick'] ?></span>
                        </div>
                        <p>
                            <?= $comentario['sugerencia'] ?>
                        </p>
                    </div>
                    <?php $com++ ?>
                <?php endwhile ?>
            <?php endif ?>
            <div>
                <div class="perfil__comentario">
                    <img src="./51+NUIgEc9L._AC_UL600_SR462,600_.jpg" id="foto__usuario" class="foto__comentario">
                    <span class="name__usuario--comentaio" id="<?= $_SESSION['User']['Id_Usuario'] ?>"><?= $_SESSION['User']['Nick'] ?></span>
                    <input type="hidden" value="<?= $_SESSION['User']['Id_Usuario'] ?>" id="idUsuario">
                </div>
                <textarea class="comentario__ingresar" id="sugerencia"></textarea>
                <button class="btn_l btn__ok" id="guararSugerencias">Comentar</button>
            </div>
        </div>
    </div>
</main>
<script src="/biblioteca2/js/ajax/sugerencia/agregarSugerencia.js"></script>
<?php
require_once '../libs/footer.php';
?>