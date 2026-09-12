<?php

require_once 'includes/conexion.php';

$busqueda = $_GET['busqueda'] ?? '';

$busqueda = trim($busqueda);

if ($busqueda !== '') {

    $busqueda_sql = "%" . $busqueda . "%";

    $sql = "SELECT *
            FROM Especies
            WHERE nombre_comun LIKE ?
               OR nombre_cientifico LIKE ?
            ORDER BY nombre_comun";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "ss",
        $busqueda_sql,
        $busqueda_sql
    );

    $stmt->execute();

    $resultado = $stmt->get_result();

} else {

    $resultado = null;

}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velatida Atlas</title>
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

        <h1>Resultados de búsqueda</h1>

        <hr

            <?php if ($busqueda === '') { ?>

                <p>
                    Escribe el nombre de una especie para realizar una búsqueda.
                </p>

            <?php } else { ?>

                <p>
                    Resultados para:
                    <strong><?php echo htmlspecialchars($busqueda); ?></strong>
                </p>

                <hr>

                <?php if ($resultado->num_rows === 0) { ?>

                    <p>
                        No se han encontrado especies que coincidan con tu búsqueda.
                    </p>

                <?php } else { ?>

                    <section class="resultados-busqueda">

                        <?php while ($especie = $resultado->fetch_assoc()) { ?>

                            <article class="tarjeta-especie">

                                <?php if (!empty($especie['imagen_url'])) { ?>

                                    <img
                                        src="<?php echo htmlspecialchars($especie['imagen_url']); ?>"
                                        alt="<?php echo htmlspecialchars($especie['nombre_comun']); ?>"
                                    >

                                <?php } ?>

                                <h2>
                                    <?php echo htmlspecialchars($especie['nombre_comun']); ?>
                                </h2>

                                <p>
                                    <em>
                                        <?php echo htmlspecialchars($especie['nombre_cientifico']); ?>
                                    </em>
                                </p>

                                <a
                                    class="boton-ver-ficha"
                                    href="ficha.php?id=<?php echo htmlspecialchars($especie['id_especie']); ?>"
                                >
                                    Ver ficha
                                </a>

                            </article>

                        <?php } ?>

                    </section>

                <?php } ?>

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