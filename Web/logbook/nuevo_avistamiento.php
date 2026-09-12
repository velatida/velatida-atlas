<?php

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

require_once '../includes/conexion.php';

$id_inmersion = $_GET['id_inmersion'];


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

// GUARDAR AVISTAMIENTO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_avistamiento = uniqid();

    $id_especie = $_POST['id_especie'];
    $profundidad = $_POST['profundidad'];
    $cantidad = $_POST['cantidad'];
    $observaciones = $_POST['observaciones'];

    $sql = "INSERT INTO Avistamientos
            (id_avistamiento, id_inmersion, id_especie, profundidad, cantidad, observaciones)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "sssiis",
        $id_avistamiento,
        $id_inmersion,
        $id_especie,
        $profundidad,
        $cantidad,
        $observaciones
    );

    if ($stmt->execute()) {

        header("Location: inmersion.php?id=$id_inmersion");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo avistamiento | Velatida Atlas</title>
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

    <h1>Nuevo avistamiento</h1>

    <hr>

    <h2>Añadir avistamiento</h2>

    <form method="post">

        <div class="campo-especie">

            <label for="buscador-especie">
                Especie:
            </label>

            <div class="buscador-especie">

                <input
                    type="text"
                    id="buscador-especie"
                    placeholder="Escribe una especie..."
                    autocomplete="off"
                >

                <input
                    type="hidden"
                    name="id_especie"
                    id="id_especie"
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
            >
        </label>

        <br><br>

        <label>
            Cantidad:
            
            <input
                type="number"
                name="cantidad"
                min="1"
            >
        </label>

        <br><br>

        <label>
            Observaciones:

            <textarea name="observaciones"></textarea>

        </label>

        <br><br>

        <button type="submit" class="boton-guardar-avistamiento">Guardar avistamiento</button>

    </form>

    <br>
    
        <div class="botones-inmersion">
            <a class="boton-volver-inmersion" href="inmersion.php?id=<?php echo $id_inmersion; ?>">
                Volver a la inmersión
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


</body>

</html>