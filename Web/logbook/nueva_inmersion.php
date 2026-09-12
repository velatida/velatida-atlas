<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_inmersion = uniqid();
    $id_usuario = $_SESSION['id_usuario'];

    $fecha = $_POST['fecha'];
    $lugar = $_POST['lugar'];
    $centro_buceo = $_POST['centro_buceo'];
    $profundidad_max = $_POST['profundidad_max'];
    $duracion_min = $_POST['duracion_min'];
    $temperatura = $_POST['temperatura'];
    $comentarios = $_POST['comentarios'];

    $sql = "INSERT INTO Inmersiones
            (id_inmersion, id_usuario, fecha, lugar, centro_buceo,
             profundidad_max, duracion_min, temperatura, comentarios)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "sssssiids",
        $id_inmersion,
        $id_usuario,
        $fecha,
        $lugar,
        $centro_buceo,
        $profundidad_max,
        $duracion_min,
        $temperatura,
        $comentarios
    );

    if ($stmt->execute()) {
        header("Location: logbook.php");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook - Velatida Atlas</title>
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

    <h1>Nueva inmersión</h1>

    <hr>

    <h2>Añadir inmersión</h2>

        <form method="post">

            <label>
                Fecha:
                <input type="date" name="fecha" required>
            </label>

            <br><br>

            <label>
                Lugar:
                <input type="text" name="lugar">
            </label>

            <br><br>

            <label>
                Centro de buceo:
                <input type="text" name="centro_buceo">
            </label>

            <br><br>

            <label>
                Profundidad máxima:
                <input type="number" name="profundidad_max">
            </label>

            <br><br>

            <label>
                Duración (minutos):
                <input type="number" name="duracion_min">
            </label>

            <br><br>

            <label>
                Temperatura:
                <input type="number" step="0.1" name="temperatura">
            </label>

            <br><br>

            <label>
                Comentarios:
                <textarea name="comentarios"></textarea>
            </label>

            <br><br>

            <button class="boton-guardar-inmersion" type="submit">
                Guardar inmersión
            </button>

            </form>

            <br><br>

            <div class="botones-volver-perfil">

                <a class="boton-volver-perfil" href="logbook.php">
                    Volver al Logbook
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