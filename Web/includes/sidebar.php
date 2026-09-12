<?php

require_once __DIR__ . '/conexion.php';

$ruta = '';

if (strpos($_SERVER['PHP_SELF'], '/logbook/') !== false) {
    $ruta = '../';
}

$sql_destacada = "SELECT id_especie, nombre_comun, nombre_cientifico, imagen_url
                  FROM Especies
                  WHERE id_especie = '0000005'";

$resultado_destacada = $conexion->query($sql_destacada);

$especie_destacada = $resultado_destacada->fetch_assoc();

?>

<!-- BARRA LATERAL -->
<aside>

    <!-- BUSCAR -->
    <section class="sidebar-bloque">

        <h2>Buscar</h2>

        <p>
            Encuentra una especie en el Atlas.
        </p>

    </section>

    <section class="buscador-lateral">

        <form action="<?php echo $ruta; ?>busqueda.php" method="get">

            <div class="form-buscador">

                <input
                    type="text"
                    name="busqueda"
                    placeholder="Busca una especie..."
                >

                <button type="submit">Buscar</button>

            </div>

        </form>

        <p class="mensaje-busqueda">
            ¿No encuentras la especie que buscas? Es posible que todavía no esté incluida en el Atlas.
        </p>

    </section>

    <hr>


    <!-- ESPECIE DESTACADA -->
    <section class="sidebar-bloque">

        <h2>Calendario</h2>

        <p>
            12 de septiembre <br>
            Día Mundial del Delfín
        </p>

        <?php if ($especie_destacada) { ?>

            <div class="especie-destacada">

                <img
                    src="<?php echo $ruta . $especie_destacada['imagen_url']; ?>"
                    alt="<?php echo htmlspecialchars($especie_destacada['nombre_comun']); ?>"
                >

                <h3>
                    <?php echo htmlspecialchars($especie_destacada['nombre_comun']); ?>
                </h3>

                <p>
                    <?php echo htmlspecialchars($especie_destacada['nombre_cientifico']); ?>
                </p>

                <a
                    class="boton-ver-ficha-destacada"
                    href="<?php echo $ruta; ?>ficha.php?id=<?php echo $especie_destacada['id_especie']; ?>"
                >
                    Ver ficha
                </a>

            </div>

        <?php } ?>

    </section>

    <hr>


    <!-- CONSERVACIÓN -->
    <section class="sidebar-bloque">

        <h2>Conservación marina</h2>

        <p>
            Conocer las especies marinas y su estado de conservación 
            es un primer paso para comprender y proteger los ecosistemas que habitan.
        </p>

            <li>
                <a href="https://www.iucnredlist.org/es/" target="_blank" class="boton-conservacion">
                    Lista Roja de la UICN
                </a>
            </li>

    </section>

    <hr>


    <!-- ENLACES -->
    <section class="sidebar-bloque">

        <h2>Enlaces</h2>

        <div class="redes-sociales">

            <li>
                <a href="https://github.com/velatida" target="_blank">
                    <img src="<?php echo $ruta; ?>images/icono-github.png" alt="GitHub">
                </a>
                
            </li>

            <li>
                <a href="https://linkedin.com/in/raquelparu" target="_blank">
                    <img src="<?php echo $ruta; ?>images/icono-linkedin.png" alt="LinkedIn">
                </a>
            </li>

        </div>

    </section>

</aside>