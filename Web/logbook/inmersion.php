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


// AVISTAMIENTOS DE LA INMERSIÓN

$sql_avistamientos = "SELECT 
                            Avistamientos.*,
                            Especies.nombre_comun,
                            Especies.nombre_cientifico
                       FROM Avistamientos
                       INNER JOIN Especies
                       ON Avistamientos.id_especie = Especies.id_especie
                       WHERE Avistamientos.id_inmersion = ?";

$stmt_avistamientos = $conexion->prepare($sql_avistamientos);
$stmt_avistamientos->bind_param("s", $id_inmersion);
$stmt_avistamientos->execute();

$resultado_avistamientos = $stmt_avistamientos->get_result();

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

        <h1>Inmersión</h1>

        <hr>

        <h2>
            <?php echo htmlspecialchars($inmersion['lugar']); ?>
        </h2>

        <div class="datos-inmersion">

        <p>
            <strong>Fecha:</strong>
            <?php echo htmlspecialchars($inmersion['fecha']); ?>
        </p>

        <p>
            <strong>Centro de buceo:</strong>
            <?php echo htmlspecialchars($inmersion['centro_buceo']); ?>
        </p>

        <p>
            <strong>Profundidad máxima:</strong>
            <?php echo htmlspecialchars($inmersion['profundidad_max']); ?> m
        </p>

        <p>
            <strong>Duración:</strong>
            <?php echo htmlspecialchars($inmersion['duracion_min']); ?> minutos
        </p>

        <p>
            <strong>Temperatura:</strong>
            <?php echo htmlspecialchars($inmersion['temperatura']); ?> °C
        </p>

        <p>
            <strong>Comentarios:</strong>
            <?php echo htmlspecialchars($inmersion['comentarios']); ?>
        </p>

        </div>

        <div class="botones-registro-inmersion">

            <a class="boton-editar-inmersion" href="editar_inmersion.php?id=<?php echo $id_inmersion; ?>">
                Editar
            </a>

            <a class="boton-eliminar-inmersion"
            href="eliminar_inmersion.php?id=<?php echo $id_inmersion; ?>"
            onclick="return confirm('¿Seguro que quieres eliminar esta inmersión?');">
                Eliminar
            </a>

        </div>

        <hr>


        <!-- AVISTAMIENTOS -->

        <h2>Avistamientos</h2>


        <?php if ($resultado_avistamientos->num_rows === 0) { ?>

            <p>
                Todavía no hay avistamientos registrados en esta inmersión.
            </p>

        <?php } else { ?>

            <?php while ($avistamiento = $resultado_avistamientos->fetch_assoc()) { ?>

                <article>

                <div class="tabla-avistamiento">

                    <div class="nombre-avistamiento">

                    <h3>
                        <?php echo htmlspecialchars($avistamiento['nombre_comun']); ?>
                    </h3>

                    </div>

                    <div class="datos-avistamiento">

                    <p>
                        <strong>Nombre científico:</strong>
                        <?php echo htmlspecialchars($avistamiento['nombre_cientifico']); ?>
                    </p>

                    <p>
                        <strong>Profundidad:</strong>
                        <?php echo htmlspecialchars($avistamiento['profundidad']); ?> m
                    </p>

                    <p>
                        <strong>Cantidad:</strong>
                        <?php echo htmlspecialchars($avistamiento['cantidad']); ?>
                    </p>

                    <p>
                        <strong>Observaciones:</strong>
                        <?php echo htmlspecialchars($avistamiento['observaciones']); ?>
                    </p>

                    </div>

                    <div class="botones-edicion-avistamiento">

                        <a class="boton-editar-avistamiento"
                        href="editar_avistamiento.php?id=<?php echo $avistamiento['id_avistamiento']; ?>">
                            Editar
                        </a>

                        <a class="boton-eliminar-avistamiento"
                        href="eliminar_avistamiento.php?id=<?php echo $avistamiento['id_avistamiento']; ?>"
                        onclick="return confirm('¿Seguro que quieres eliminar este avistamiento?');">
                            Eliminar
                        </a>

                    </div>

                </article>

            <?php } ?>

        <?php } ?>

        <hr>

        <div class="botones-inmersion">

            <a class="boton-anadir-avistamiento" href="nuevo_avistamiento.php?id_inmersion=<?php echo $id_inmersion; ?>">
                Añadir avistamiento
            </a>

            <a class="boton-volver-logbook" href="logbook.php">
                Volver al Logbook
            </a>

        </div>

    </main>


        <!-- BARRA LATERAL -->
        
        <?php include '../includes/sidebar.php'; ?>

        </aside>

    </div>

    <hr>

    <!-- PIE DE PAGINA -->
    <footer>
        <img src="../images/banner-footer.png" alt="Banner footer">
    </footer>

</body>

</html>