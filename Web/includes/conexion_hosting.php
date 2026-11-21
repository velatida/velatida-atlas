<?php

$servidor = "sql202.infinityfree.com";
$usuario = "if0_43434400";
$password = "Reggada69";
$base_datos = "if0_43434400_XXX";

$conexion = new mysqli(
    $servidor,
    $usuario,
    $password,
    $base_datos
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");

?>