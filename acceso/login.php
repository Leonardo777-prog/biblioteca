<?php require_once '../libs/header.php';

if(!empty($_POST['Email']) && !empty($_POST['Clave']))
{   
    
    $email = $_POST['Email'];
    $clave = $_POST['Clave'];
    $sql="SELECT * FROM usuarios WHERE Email=?";
    $usuarios=prepare_select($conexion,$sql,[$email]);
    
    if($usuarios->num_rows > 0){
        $usuario = $usuarios->fetch_assoc();
        if($usuario['Clave'] == $clave){
            $_SESSION['User'] = $usuario;
            $idUsuario = $_SESSION['User']['Id_Usuario'];
            $sqlExistenciaCarrito = "SELECT estado, id_carrito
            from carrito
            where estado = 0
            and Id_Usuario = $idUsuario";
            $carrito = prepare_select($conexion, $sqlExistenciaCarrito);
            if ($carrito->num_rows > 0) {
                $carrito = $carrito->fetch_assoc();
                $_SESSION['carrito'] = $carrito;
            }
            header('Location: /biblioteca2/index.php');
        }
    }
    
}
?>
<main class="contenedor inicio">
    <div class="card">
        <div class="header__card">
            <h2 class="fw__400 no__margin">Inicio de Sesion</h2>
        </div>
        <div class="body__card">
            <form action="login.php" method="POST">
                <div class="acces__grup">
                    <input type="text" name="Email" id="Email" placeholder="Email" class="campo__input" required>
                </div>
                <div class="acces__grup">
                    <input type="password" name="Clave" id="Clave" placeholder="Contraseña" class="campo__input" required>
                </div>
                <input type="submit" name="Enviar" value="Ingresar" class="btn btn__ingresar">
            </form>
            <div class="body__card--footer">
                <p>¿No Eres Miembro? <span><a href="" class="click">Click Aqui</a></span></p>
            </div>
        </div>
    </div>
</main>
<?php require_once '../libs/footer.php' ?>