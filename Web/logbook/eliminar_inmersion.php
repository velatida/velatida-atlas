<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require_once '../includes/conexion.php';

$id_inmersion = $_GET['id'];
$id_usuario = $_SESSION['id_usuario'];


// ELIMINAR AVISTAMIENTOS DE LA INMERSIÓN

$sql_avistamientos = "DELETE FROM Avistamientos
                       WHERE id_inmersion = ?";

$stmt_avistamientos = $conexion->prepare($sql_avistamientos);
$stmt_avistamientos->bind_param("s", $id_inmersion);
$stmt_avistamientos->execute();


// ELIMINAR INMERSIÓN

$sql_inmersion = "DELETE FROM Inmersiones
                  WHERE id_inmersion = ?
                  AND id_usuario = ?";

$stmt_inmersion = $conexion->prepare($sql_inmersion);
$stmt_inmersion->bind_param("ss", $id_inmersion, $id_usuario);

if ($stmt_inmersion->execute()) {
    header("Location: logbook.php");
    exit;
}

?>
