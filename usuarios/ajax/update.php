<?php
session_start();
require_once '../../libs/conexion.php';
require_once '../../libs/funciones.php';
if(!empty($_POST['idUsuario']) && !empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['Dni']) && !empty($_POST['Email']) && !empty($_POST['Telefono']) && !empty($_POST['Domicilio']))
{
    $id_usuario =   $_POST['idUsuario'];
    $nombre     =   $_POST['Nombre'];
    $apellido   =   $_POST['Apellido'];
    $dni        =   $_POST['Dni'];
    $email      =   $_POST['Email'];
    $telefono   =   $_POST['Telefono'];
    $domicilio  =   $_POST['Domicilio'];

    $sql="UPDATE usuarios SET Nombre=?,Apellido=?,Dni=?,Email=?,Telefono=?,Domicilio=? WHERE Id_Usuario=?";
    $save=prepare_query($conexion,$sql,[$nombre,$apellido,$dni,$email,$telefono,$domicilio,$id_usuario]);

    if($save->error){
        echo "Error";
    }else{
        echo 'Exito';
    }
}

?>