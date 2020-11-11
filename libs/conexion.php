<?php
require_once 'config.php';

$conexion = new mysqli(HOST, USER, PASSWORD, DATABASE); 


if($conexion->connect_errno){
    echo 'No se conecto, error: '.$conexion->connect_error; 
}else{
    echo ''; 
}


?>