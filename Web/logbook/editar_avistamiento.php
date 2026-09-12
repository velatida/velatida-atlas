<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require_once '../includes/conexion.php';

$id_avistamiento = $_GET['id'];


// BUSCAR EL AVISTAMIENTO

$sql_avistamiento = "SELECT
                            Avistamientos.*,
                            Especies.nombre_comun
                     FROM Avistamientos
                     INNER JOIN Especies
                     ON Avistamientos.id_especie = Especies.id_especie
                     INNER JOIN Inmersiones
                     ON Avistamientos.id_inmersion = Inmersiones.id_inmersion
                     WHERE Avistamientos.id_avistamiento = ?
                     AND Inmersiones.id_usuario = ?";

$stmt = $conexion->prepare($sql_avistamiento);
$stmt->bind_param("ss", $id_avistamiento, $_SESSION['id_usuario']);
$stmt->execute();

$resultado_avistamiento = $stmt->get_result();

if ($resultado_avistamiento->num_rows !== 1) {
    header("Location: logbook.php");
    exit;
}

$avistamiento = $resultado_avistamiento->fetch_assoc();


// BUSCAR LAS ESPECIES DEL ATLAS

$sql_especies = "SELECT id_especie, nombre_comun
                 FROM Especies
                 ORDER BY nombre_comun";

$resultado_especies = $conexion->query($sql_especies);

$especies = [];

while ($especie = $resultado_especies->fetch_assoc()) {

    $especies[] = [
        'id' => $especie['id_especie'],
        'nombre' => $especie['nombre_comun']
    ];

}


// ACTUALIZAR AVISTAMIENTO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_especie = $_POST['id_especie'];
    $profundidad = $_POST['profundidad'];
    $cantidad = $_POST['cantidad'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE Avistamientos
            SET id_especie = ?,
                profundidad = ?,
                cantidad = ?,
                observaciones = ?
            WHERE id_avistamiento = ?";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "siiss",
        $id_especie,
        $profundidad,
        $cantidad,
        $observaciones,
        $id_avistamiento
    );

    if ($stmt->execute()) {

        header("Location: inmersion.php?id=" . $avistamiento['id_inmersion']);
        exit;
    }
}

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
        
        <h1>Editar avistamiento</h1>

        <hr>

        <form method="post">


            <div class="campo-especie">

                <label for="buscador-especie">
                    Especie:
                </label>

                <div class="buscador-especie">

                    <input
                        type="text"
                        id="buscador-especie"
                        value="<?php echo htmlspecialchars($avistamiento['nombre_comun']); ?>"
                        autocomplete="off"
                    >

                    <input
                        type="hidden"
                        name="id_especie"
                        id="id_especie"
                        value="<?php echo htmlspecialchars($avistamiento['id_especie']); ?>"
                        required
                    >

                    <div id="resultados-especies"></div>

                </div>

            </div>

            <br>

            <label>

                Profundidad:

                <input
                    type="number"
                    name="profundidad"
                    value="<?php echo htmlspecialchars($avistamiento['profundidad']); ?>"
                >

            </label>

            <br><br>

            <label>

                Cantidad:

                <input
                    type="number"
                    name="cantidad"
                    min="1"
                    value="<?php echo htmlspecialchars($avistamiento['cantidad']); ?>"
                >

            </label>

            <br><br>

            <label>

                Observaciones:

                <textarea name="observaciones"><?php echo htmlspecialchars($avistamiento['observaciones']); ?></textarea>

            </label>

            <br><br>

            <button
                type="submit"
                class="boton-guardar-avistamiento">
                Guardar cambios
            </button>


        </form>

        <hr>

        <div class="botones-cancelar-edicion">

            <a
                class="boton-cancelar-edicion"
                href="inmersion.php?id=<?php echo $avistamiento['id_inmersion']; ?>">
                Cancelar
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

 <script>

    const especies = <?php echo json_encode($especies, JSON_UNESCAPED_UNICODE); ?>;

    const buscador = document.getElementById('buscador-especie');
    const resultados = document.getElementById('resultados-especies');
    const idEspecie = document.getElementById('id_especie');


    buscador.addEventListener('input', function () {

        const texto = buscador.value.toLowerCase().trim();

        resultados.innerHTML = '';

        idEspecie.value = '';


        if (texto === '') {
            return;
        }


        const coincidencias = especies.filter(function(especie) {

            return especie.nombre.toLowerCase().startsWith(texto);

        });


        coincidencias.forEach(function(especie) {

            const opcion = document.createElement('div');

            opcion.textContent = especie.nombre;


            opcion.addEventListener('click', function () {

                buscador.value = especie.nombre;

                idEspecie.value = especie.id;

                resultados.innerHTML = '';

            });


            resultados.appendChild(opcion);

        });

    });

    </script>