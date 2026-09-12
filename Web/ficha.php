<?php

require_once 'includes/conexion.php';

$id_especie = $_GET['id'] ?? '';

$sql = "SELECT * FROM Especies WHERE id_especie = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $id_especie);
$stmt->execute();

$resultado = $stmt->get_result();

$especie = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de especie - Velatida Atlas</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- CABECERA -->
    <header>
        <img src="images/banner-header.png" alt="Banner header">
    </header>

    <!-- MENU PRINCIPAL -->
    <nav>
        <a href="index.php">Inicio</a>
        <a href="especies.php">Especies</a>
        <a href="logbook/logbook.php">Logbook</a>
        <a href="proyecto.php">Proyecto</a>
    </nav>

    <!-- CONTENIDO -->
    <div class="contenedor">

        <main>

        <h1>Ficha</h1>

        <hr>

            <?php if ($especie) { ?>

                <!-- FICHA DE LA ESPECIE -->

                    <section class="foto-ficha">

                        <img
                            src="<?php echo $especie['imagen_url']; ?>"
                            alt="<?php echo $especie['nombre_comun']; ?>"
                        >

                    </section>

                    <h2>
                        <?php echo $especie['nombre_comun']; ?>
                    </h2>

                    <section class="ficha-especie">
                        
                    <p>
                        <em>
                            <?php echo $especie['nombre_cientifico']; ?>
                        </em>
                    </p>

                    <p>
                        <strong>Grupo:</strong>
                        <?php echo $especie['grupo']; ?>
                    </p>

                    <p>
                        <strong>Familia:</strong>
                        <?php echo $especie['familia']; ?>
                    </p>

                    <p>
                        <strong>Descripción:</strong>
                        <?php echo $especie['descripcion']; ?>
                    </p>

                    <p>
                        <strong>Tamaño:</strong>
                        <?php echo $especie['tamano_min_cm']; ?>
                        -
                        <?php echo $especie['tamano_max_cm']; ?> cm
                    </p>

                    <p>
                        <strong>Dieta:</strong>
                        <?php echo $especie['dieta']; ?>
                    </p>

                    <p>
                        <strong>Hábitat:</strong>
                        <?php echo $especie['habitat']; ?>
                    </p>

                    <p>
                        <strong>Zona geográfica:</strong>
                        <?php echo $especie['zona_geografica']; ?>
                    </p>

                    <p>
                        <strong>Profundidad:</strong>
                        <?php echo $especie['profundidad_min_m']; ?>
                        -
                        <?php echo $especie['profundidad_max_m']; ?> m
                    </p>

                    <p>
                        <strong>Estado de conservación:</strong>
                        <?php echo $especie['estado_conservacion']; ?>
                    </p>

                </section>

                <div class="boton-volver-especies-contenedor">

                    <a class="boton-volver-especies" href="especies.php">
                        Volver a especies
                    </a>

                </div>

            <?php } else { ?>

                <section>

                    <h2>Especie no encontrada</h2>

                    <p>
                        No se ha encontrado la especie solicitada.
                    </p>

                </section>

            <?php } ?>

        </main>


        <!-- BARRA LATERAL -->
       
        <?php include 'includes/sidebar.php'; ?>
        
    </div>

    <hr>

    <!-- PIE DE PAGINA -->
    <footer>
        <img src="images/banner-footer.png" alt="Banner footer">
    </footer>

</body>

</html>