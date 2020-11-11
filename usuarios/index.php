<?php require_once '../libs/header.php';

$sql = "SELECT Id_Usuario, Nombre, Dni, Email FROM usuarios WHERE Estado = 1";
$usuarios = prepare_select($conexion, $sql);
?>

<main class="contenedor inicio">
    <header class="header__block">
        <div></div>
        <h2 class="centrar__texto">Control de Usuarios</h2>
        <div></div>
    </header>
  
    <table class="tabla">
        <thead>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Email</th>
            <th>Acciones</th>
        </thead>
        <tbody id="tbody">
            <?php if($usuarios->num_rows > 0): ?>
                <?php while($usuario = $usuarios->fetch_assoc()): ?>
                    <tr>
                        <td><?=$usuario['Nombre']?></td>
                        <td><?=$usuario['Dni']?></td>
                        <td><?=$usuario['Email']?></td>
                        <td><button class="btn btn__danger acciones"><a class="delete" href="#" id="<?=$usuario['Id_Usuario']?>">Eliminar</a></button></td>
                    </tr>
                <?php endwhile; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>
<script src="/biblioteca2/js/ajax/usuarios/eliminar.js"></script>
<?php require_once '../libs/footer.php' ?>