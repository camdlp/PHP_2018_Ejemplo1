<?php

include 'misFunciones.php';


function limpiarPalabra($palabra) {
    //filtro muy básico para evitar la inyección SQL -> 'OR'1'='1
    $palabra = trim($palabra, "'");
    $palabra = trim($palabra, " ");
    $palabra = trim($palabra, "-");
    $palabra = trim($palabra, "´");
    $palabra = trim($palabra, "`");
    $palabra = trim($palabra, '"');
    return $palabra;
}

$mysqli = conectaBBDD();

$cajaNombre = limpiarPalabra($_POST['cajaNombre']);

$cajaPassword = limpiarPalabra($_POST['cajaPassword']);


//echo 'Has escrito el usuario '.$cajaNombre.' y la contraseña '.$cajaPassword;

$resultadoQuery = $mysqli->query("SELECT * FROM usuarios "
        . "WHERE nombreUsuario = '$cajaNombre' AND userPass = '$cajaPassword'");

$numUsuarios = $resultadoQuery->num_rows;

//for ($i = 0; $i < $numUsuarios; $i++){
//    $r = $resultadoQuery -> fetch_array();
//    echo $r['nombreUsuario'].'<br/>';
//    
//}

if ($numUsuarios > 0) {
    //muestro la pantalla de las aplcación
    require 'app.php';
} else {
    //muestro una pantalla de error
    require 'error.php';
}