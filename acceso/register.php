<?php 
require_once '../libs/header.php';
if(isset($_POST['Registrar']) && !empty($_POST['NickName']) && !empty($_POST['Clave']) && !empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['Email']))
{
    $NickName   =   $_POST['NickName'];
    $Clave      =   $_POST['Clave'];
    $Nombre     =   $_POST['Nombre'];
    $Apellido   =   $_POST['Apellido'];
    $Email      =   $_POST['Email'];

    $sql="Insert into usuarios(Nick,Clave,Nombre,Apellido,Email) values(?,?,?,?,?)";
    $cmd=prepare_query($conexion,$sql,[$NickName,$Clave,$Nombre,$Apellido,$Email]);

    if($cmd->error){
        echo 'Error';
    }else{
        header("location: login.php");
    }
}
?>
<main class="contenedor inicio">
    <div class="card">
        <div class="header__card">
            <h2 class="fw__400 no__margin">Registrarse</h2>
        </div>
        <div class="body__card">
            <form action="register.php" method="POST" id="formulario">
                <div class="acces__grup">
                    <input type="text" name="NickName" id="NickName" placeholder="Nombre Usuario" class="campo__input" required>
                </div>
                <div class="acces__grup">
                    <input type="text" name="Nombre" id="Nombre" placeholder="Nombre" class="campo__input" required>
                </div>
                <div class="acces__grup">
                    <input type="text" name="Apellido" id="Apellido" placeholder="Apellido" class="campo__input" required>
                </div>
                <div class="acces__grup">
                    <input type="email" name="Email" id="Email" placeholder="Email" class="campo__input" required>
                </div>
                <div class="acces__grup">
                    <input type="password" name="Clave" id="Clave" placeholder="Contraseña" class="campo__input" required>
                </div>
                <input type="submit" name="Registrar" class="btn btn__ingresar" value="Registrarse">
            </form>
            <div class="body__card--footer">
                <p>¿No Eres Miembro? <span><a href="/biblioteca2/acceso/login.php" class="click">Click Aqui</a></span></p>
            </div>
        </div>
    </div>
</main>
<?php require_once '../libs/footer.php' ?>