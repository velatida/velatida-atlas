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

            <!-- PRESENTACION -->
            <section class="presentacion">

                <h1>Velatida Atlas</h1>

                <hr>

                <h2>Bienvenidos</h2>

                <p>
                    Velatida Atlas es un proyecto personal dedicado a la exploración del mundo marino. 
                </p>
                
                <p>
                    Un espacio para explorar la vida bajo la superficie y registrar tus experiencias en el mar.
                </p>

            </section>

            <hr>

            <!-- INTRODUCCION AL ATLAS -->
            <section class="introduccion">

                <h2>Explora el Atlas</h2>

                <p>
                    Descubre diferentes especies marinas y consulta información sobre 
                    sus características principales.
                </p>
            
                <p>
                    Utiliza el buscador para encontrar una especie concreta 
                    o explora el Atlas navegando por los diferentes grupos.
                </p>

            </section>

            <!-- BUSCADOR -->
            <section class="buscador">

               <form action="busqueda.php" method="get">

                    <div class="form-buscador">
                        <input
                            type="text"
                            name="busqueda"
                            placeholder="Escribe el nombre de una especie..."
                        >
                        <button type="submit">Buscar</button>
                    </div>

                </form>

                <p class="mensaje-busqueda">
                    ¿No encuentras la especie que buscas? Es posible que todavía no esté incluida en el Atlas.
                </p>

            </section>

            <hr>

            <!-- ESPECIES DESTACADAS -->
            <section class="destacadas">

                <h2>Especies destacadas</h2>

                <div class="tarjetas-destacadas">

                    <!-- ESPECIE 1 -->
                    <article class="tarjeta-destacada">

                        <img src="images/especies/amphiprion-ocellaris.jpg" alt="Pez payaso">

                        <div class="datos-destacada">

                            <h3>Pez payaso</h3>

                            <a class="boton-ver-ficha" href="ficha.php?id=0000001">
                                Ver ficha
                            </a>

                        </div> 

                    </article>

                    <!-- ESPECIE 2 -->
                    <article class="tarjeta-destacada">

                        <img src="images/especies/hippocampus-guttulatus.jpg" alt="Caballito de mar">

                        <div class="datos-destacada">

                            <h3>Caballito de mar</h3>

                            <a class="boton-ver-ficha" href="ficha.php?id=0000002">
                                Ver ficha
                            </a>

                        </div>

                    </article>

                    <!-- ESPECIE 3 -->
                    <article class="tarjeta-destacada">

                        <img src="images/especies/rhincodon-typus.jpg" alt="Tiburón ballena">

                        <div class="datos-destacada">

                            <h3>Tiburón ballena</h3>

                            <a class="boton-ver-ficha" href="ficha.php?id=0000003">
                                Ver ficha
                            </a>

                        </div>

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
