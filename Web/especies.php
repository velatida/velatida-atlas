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

        <!-- PRESENTACION -->
        <section class="presentacion">

            <h1>Especies</h1>

            <hr>
            
            <h2>Explora el Atlas</h2>

            <p>
                Las especies están organizadas por grupos para facilitar su consulta.
            </p>
            
        </br>

        </section>


        <!-- GRUPOS DE ESPECIES -->
        <section class="grupos-especies">

            <div class="tarjetas-grupos">

                <!-- PECES -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/peces.jpg" alt="Peces">

                    <h3>Peces</h3>

                    <a href="grupos.php?grupo=Peces">
                        Ver especies
                    </a>

                </article>


                <!-- ELASMOBRANQUIOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/elasmobranquios.jpg" alt="Elasmobranquios">

                    <h3>Elasmobranquios</h3>

                    <a href="grupos.php?grupo=Elasmobranquios">
                        Ver especies
                    </a>

                </article>


                <!-- MAMIFEROS MARINOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/mamiferos-marinos.jpg" alt="Mamíferos marinos">

                    <h3>Mamíferos marinos</h3>

                    <a href="grupos.php?grupo=Mamíferos%20marinos">
                        Ver especies
                    </a>

                </article>


                <!-- REPTILES MARINOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/reptiles-marinos.jpg" alt="Reptiles marinos">

                    <h3>Reptiles marinos</h3>

                    <a href="grupos.php?grupo=Reptiles%20marinos">
                        Ver especies
                    </a>

                </article>


                <!-- CRUSTACEOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/crustaceos.jpg" alt="Crustáceos">

                    <h3>Crustáceos</h3>

                    <a href="grupos.php?grupo=Crustáceos">
                        Ver especies
                    </a>

                </article>


                <!-- MOLUSCOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/moluscos.jpg" alt="Moluscos">

                    <h3>Moluscos</h3>

                    <a href="grupos.php?grupo=Moluscos">
                        Ver especies
                    </a>

                </article>


                <!-- EQUINODERMOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/equinodermos.jpg" alt="Equinodermos">

                    <h3>Equinodermos</h3>

                    <a href="grupos.php?grupo=Equinodermos">
                        Ver especies
                    </a>

                </article>


                <!-- CNIDARIOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/cnidarios.jpg" alt="Cnidarios">

                    <h3>Cnidarios</h3>

                    <a href="grupos.php?grupo=Cnidarios">
                        Ver especies
                    </a>

                </article>


                <!-- PORIFEROS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/poriferos.jpg" alt="Poríferos">

                    <h3>Poríferos</h3>

                    <a href="grupos.php?grupo=Poríferos">
                        Ver especies
                    </a>

                </article>


                <!-- OTROS INVERTEBRADOS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/otros-invertebrados.jpg" alt="Otros invertebrados">

                    <h3>Otros invertebrados</h3>

                    <a href="grupos.php?grupo=Otros%20invertebrados">
                        Ver especies
                    </a>

                </article>


                <!-- FANEROGAMAS MARINAS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/fanerogamas-marinas.jpg" alt="Fanerógamas marinas">

                    <h3>Fanerógamas marinas</h3>

                    <a href="grupos.php?grupo=Fanerógamas%20marinas">
                        Ver especies
                    </a>

                </article>


                <!-- ALGAS -->
                <article class="tarjeta-grupo">

                    <img src="images/grupos/algas.jpg" alt="Algas">

                    <h3>Algas</h3>

                    <a href="grupos.php?grupo=Algas">
                        Ver especies
                    </a>

                </article>

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