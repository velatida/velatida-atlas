<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require_once '../includes/conexion.php';

$id_inmersion = $_GET['id'];


// DATOS DE LA INMERSIÓN

$sql_inmersion = "SELECT *
                  FROM Inmersiones
                  WHERE id_inmersion = ?
                  AND id_usuario = ?";

$stmt = $conexion->prepare($sql_inmersion);
$stmt->bind_param("ss", $id_inmersion, $_SESSION['id_usuario']);
$stmt->execute();

$resultado_inmersion = $stmt->get_result();

if ($resultado_inmersion->num_rows !== 1) {
    header("Location: logbook.php");
    exit;
}

$inmersion = $resultado_inmersion->fetch_assoc();


// ACTUALIZAR INMERSIÓN

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fecha = $_POST['fecha'];
    $lugar = $_POST['lugar'];
    $centro_buceo = $_POST['centro_buceo'];
    $profundidad_max = $_POST['profundidad_max'];
    $duracion_min = $_POST['duracion_min'];
    $temperatura = $_POST['temperatura'];
    $comentarios = $_POST['comentarios'];

    $sql = "UPDATE Inmersiones
            SET fecha = ?,
                lugar = ?,
                centro_buceo = ?,
                profundidad_max = ?,
                duracion_min = ?,
                temperatura = ?,
                comentarios = ?
            WHERE id_inmersion = ?
            AND id_usuario = ?";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "sssiiidss",
        $fecha,
        $lugar,
        $centro_buceo,
        $profundidad_max,
        $duracion_min,
        $temperatura,
        $comentarios,
        $id_inmersion,
        $_SESSION['id_usuario']
    );

    if ($stmt->execute()) {
        header("Location: inmersion.php?id=" . $id_inmersion);
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmersión | Velatida Atlas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <!-- CABECERA -->
    <header>
        <img src="../images/banner-header.png" alt="Banner header">
    </header>

    <!-- MENU PRINCIPAL -->
    <nav>
        <a href="../index.php">Inicio</a>
        <a href="../especies.php">Especies</a>
        <a href="logbook.php">Logbook</a>
        <a href="../proyecto.php">Proyecto</a>
    </nav>

    <!-- CONTENIDO -->
    <div class="contenedor">
    
        <main>
        
        <h1>Editar inmersión</h1>

            <hr>

            <form method="post">

                <label>
                    Fecha:
                    <input
                        type="date"
                        name="fecha"
                        value="<?php echo htmlspecialchars($inmersion['fecha']); ?>"
                        required
                    >
                </label>

                <br><br>

                <label>
                    Lugar:
                    <input
                        type="text"
                        name="lugar"
                        value="<?php echo htmlspecialchars($inmersion['lugar']); ?>"
                    >
                </label>

                <br><br>

                <label>
                    Centro de buceo:
                    <input
                        type="text"
                        name="centro_buceo"
                        value="<?php echo htmlspecialchars($inmersion['centro_buceo']); ?>"
                    >
                </label>

                <br><br>

                <label>
                    Profundidad máxima:
                    <input
                        type="number"
                        name="profundidad_max"
                        value="<?php echo htmlspecialchars($inmersion['profundidad_max']); ?>"
                    >
                </label>

                <br><br>

                <label>
                    Duración (minutos):
                    <input
                        type="number"
                        name="duracion_min"
                        value="<?php echo htmlspecialchars($inmersion['duracion_min']); ?>"
                    >
                </label>

                <br><br>

                <label>
                    Temperatura:
                    <input
                        type="number"
                        step="0.1"
                        name="temperatura"
                        value="<?php echo htmlspecialchars($inmersion['temperatura']); ?>"
                    >
                </label>

                <br><br>

                <label>
                    Comentarios:
                    <textarea name="comentarios"><?php echo htmlspecialchars($inmersion['comentarios']); ?></textarea>
                </label>

                <br><br>

                <button class="boton-guardar-inmersion" type="submit">
                    Guardar cambios
                </button>

            </form>

            <hr>

            <div class="botones-cancelar-edicion">

                <a
                    class="boton-cancelar-edicion"
                    href="inmersion.php?id=<?php echo $id_inmersion; ?>"
                >
                    Cancelar
                </a>

            </div>

        </main>


        <!-- BARRA LATERAL -->
       
        <?php include '../includes/sidebar.php'; ?>
        
    </div>

    <hr>

    <!-- PIE DE PAGINA -->
    <footer>
        <img src="../images/banner-footer.png" alt="Banner footer">
    </footer>

</body>

</html>