<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

include '../includes/conexion.php';

$sql_inmersiones = "SELECT *
                    FROM Inmersiones
                    WHERE id_usuario = ?
                    ORDER BY fecha DESC";

$stmt = $conexion->prepare($sql_inmersiones);
$stmt->bind_param("s", $_SESSION['id_usuario']);
$stmt->execute();

$resultado_inmersiones = $stmt->get_result();

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

            <h1>Logbook</h1>

            <hr>

            <h2>
                Hola, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
            </h2>

            <p>
                Registro de mis aventuras bajo el mar.
            </p>

            <hr>

            <?php while ($inmersion = $resultado_inmersiones->fetch_assoc()) { ?>

                <!-- INMERSION --> 

                <section class="inmersion">

                    <h3>
                        Inmersión - 
                        <?php echo date('d/m/Y', strtotime($inmersion['fecha'])); ?>
                    </h3>

                    <p>
                        <?php echo htmlspecialchars($inmersion['lugar']); ?>
                    </p>

                    <a class="boton-secundario-inmersion"
                    href="inmersion.php?id=<?php echo $inmersion['id_inmersion']; ?>">
                        Ver inmersión
                    </a>

                </section>

                <hr>

            <?php } ?>

            <div class="botones-logbook">

                <a class="boton-nueva-inmersion" href="nueva_inmersion.php">
                    Nueva inmersión
                </a>

                <a class="boton-cerrar-sesion" href="logout.php">
                    Cerrar sesión
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