<?php

require_once '../includes/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    $sql_id = "SELECT MAX(CAST(id_usuario AS UNSIGNED)) AS ultimo_id
           FROM Usuarios";

    $resultado_id = $conexion->query($sql_id);
    $fila_id = $resultado_id->fetch_assoc();

    $nuevo_id = ($fila_id['ultimo_id'] ?? 0) + 1;

    $id_usuario = str_pad($nuevo_id, 7, '0', STR_PAD_LEFT);
    

    $sql = "INSERT INTO Usuarios 
            (id_usuario, nombre_usuario, email, password, fecha_registro)
            VALUES (?, ?, ?, ?, CURDATE())";

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param(
        "ssss",
        $id_usuario,
        $nombre_usuario,
        $email,
        $password_hash
    );

    if ($stmt->execute()) {
        $mensaje = "Usuario registrado correctamente.";
    } else {
        $mensaje = "Error al registrar el usuario.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook - Velatida Atlas</title>
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

        <h2>Crear cuenta</h2>

        <form method="post">

            <label>
                Nombre de usuario:
                <input type="text" name="nombre_usuario" required>
            </label>

            <br><br>

            <label>
                Email:
                <input type="email" name="email" required>
            </label>

            <br><br>

            <label>
                Contraseña:
                <input type="password" name="password" required>
            </label>

            <br><br>

            <button type="submit" class="boton-registro">Registrarse</button>

        </form>

        <p>
            <?php echo $mensaje; ?>
        </p>

        <p class="enlace-registro">
            ¿Ya tienes una cuenta?
            <a href="login.php">
                Inicia sesión
            </a>
        </p>

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