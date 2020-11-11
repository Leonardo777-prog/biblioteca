<?php

function prepare_query($conexion, $sql, $campo, $tipo = ''){

    $tipo = $tipo ? $tipo : str_repeat('s', count($campo));
    $cmd = $conexion->prepare($sql);
    if(!empty($campo)){
        $cmd->bind_param($tipo, ...$campo);
        $cmd->execute();
    }else{
        $cmd->execute();
    }
    return $cmd;
}

function prepare_select($conexion, $sql, $campo = [], $tipo = ''){

    return prepare_query($conexion, $sql, $campo, $tipo)->get_result();
}
?>
