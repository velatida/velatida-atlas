<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especies | Velatida Atlas</title>
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

        <h1>Especies</h1>

        <hr>

            <!-- TITULO DEL GRUPO -->
            <section class="presentacion">

                <?php 
                    
                require_once 'includes/conexion.php';

                    $grupo = $_GET['grupo'];

                    $sql = "SELECT id_especie, nombre_comun, nombre_cientifico, imagen_url
                            FROM Especies
                            WHERE grupo = ?";

                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param("s", $grupo);
                    $stmt->execute();

                    $resultado = $stmt->get_result();

                ?>
                
                <h2>
                    <?php echo htmlspecialchars($grupo); ?>
                </h2>

                <p>
                    Número de especies encontradas:
                    <?php echo $resultado->num_rows; ?>
                </p>

            </section>

            <!-- ESPECIES DEL GRUPO -->
            <section class="grupo-especies">

                <div class="tarjetas-especies">

                    <?php while ($especie = $resultado->fetch_assoc()) { ?>

                        <article class="tarjeta-especie">

                            <img
                                src="<?php echo $especie['imagen_url']; ?>"
                                alt="<?php echo $especie['nombre_comun']; ?>"
                            >

                            <h3>
                                <?php echo $especie['nombre_comun']; ?>
                            </h3>

                            <p>
                                <?php echo $especie['nombre_cientifico']; ?>
                            </p>

                            <a class="boton-ver-ficha-grupo" href="ficha.php?id=<?php echo $especie['id_especie']; ?>">
                                Ver ficha
                            </a>

                        </article>

                    <?php } ?>

                </div>

            </section>

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