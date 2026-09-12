<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto · Velatida Atlas</title>
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

            <!-- SOBRE EL PROYECTO -->
            <section class="proyecto-bloque">

                <h1>Proyecto personal</h1>

                <hr>

                <h2>Sobre Velatida Atlas</h2>

                <p>
                    Velatida Atlas es un proyecto personal que une mi interés por el mundo marino 
                    con mi formación en informática. Un espacio dedicado a la exploración 
                    de especies marinas y al registro de inmersiones y avistamientos.
                </p>

            </section>

            <hr>

            <!-- BASE DE DATOS -->
            <section class="proyecto-bloque">

                <h2>Base de datos</h2>

                <p>
                    La información del Atlas se organiza mediante una base de datos relacional 
                    diseñada para almacenar y relacionar diferentes tipos de información.
                </p>

                <p>
                    Las especies incluyen datos sobre sus características, 
                    hábitat, distribución geográfica, profundidad y estado de conservación. 
                    El Logbook permite registrar inmersiones y asociar a cada una 
                    las especies observadas y sus correspondientes datos.
                </p>

            </section>

            <hr>

            <!-- TECNOLOGIAS -->
            <section class="proyecto-bloque">

                <h2>Tecnologías</h2>

                <ul>
                    <li>HTML</li>
                    <li>CSS</li>
                    <li>PHP</li>
                    <li>MySQL / MariaDB</li>
                    <li>Git y GitHub</li>
                </ul>

            </section>

            <hr>

            <!-- OBJETIVO -->
            <section class="proyecto-bloque">

                <h2>Objetivo</h2>

                <p>
                    Este proyecto forma parte de mi aprendizaje en Administración de Sistemas Informáticos en Red y 
                    me permite poner en práctica el diseño de bases de datos, SQL y desarrollo web.
                </p>

                <p>
                    El proyecto seguirá creciendo progresivamente con nuevas funcionalidades y contenidos, 
                    formando parte de mi portfolio y de mi proceso de aprendizaje en el ámbito tecnológico.
                </p>

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