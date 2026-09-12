<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require_once '../includes/conexion.php';

$id_avistamiento = $_GET['id'];


// BUSCAR EL AVISTAMIENTO

$sql_avistamiento = "SELECT Avistamientos.id_inmersion
                     FROM Avistamientos
                     INNER JOIN Inmersiones
                     ON Avistamientos.id_inmersion = Inmersiones.id_inmersion
                     WHERE Avistamientos.id_avistamiento = ?
                     AND Inmersiones.id_usuario = ?";

$stmt = $conexion->prepare($sql_avistamiento);
$stmt->bind_param("ss", $id_avistamiento, $_SESSION['id_usuario']);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows !== 1) {
    header("Location: logbook.php");
    exit;
}

$avistamiento = $resultado->fetch_assoc();


// ELIMINAR AVISTAMIENTO

$sql = "DELETE FROM Avistamientos
        WHERE id_avistamiento = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $id_avistamiento);

if ($stmt->execute()) {

    header("Location: inmersion.php?id=" . $avistamiento['id_inmersion']);
    exit;
}

?>