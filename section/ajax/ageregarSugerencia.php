<?php

require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';

$sugerencia = $_REQUEST['sugerencia'];
$idusuario = $_REQUEST['idLibro'];

$sql = "INSERT INTO biblioteca.sugerencias (Id_Usuario, sugerencia) VALUES (?, ?);";
$nombreCon = "SELECT Nick FROM biblioteca.usuarios where Id_Usuario = $idusuario;";
$insertSugerencia = prepare_query($conexion, $sql, [$idusuario, $sugerencia]);
$nombre = prepare_select($conexion, $nombreCon);
$nombre = $nombre->fetch_assoc();
?>
<div class="perfil__comentario">
    <img src="./51+NUIgEc9L._AC_UL600_SR462,600_.jpg" alt="" class="foto__comentario">
    <span class="name__usuario--comentaio"><?= $nombre['Nick'] ?></span>
</div>
<p>
    <?= $sugerencia ?>
</p>