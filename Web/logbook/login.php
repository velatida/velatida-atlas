<?php

session_start();

require_once '../includes/conexion.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT *
            FROM Usuarios
            WHERE email = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario['password'])) {

            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];

            header("Location: logbook.php");
            exit;

        } else {
            $mensaje = "Email o contraseña incorrectos.";
        }

    } else {
        $mensaje = "Email o contraseña incorrectos.";
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

            <h2>Iniciar sesión</h2>

            <form method="post">

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

                <button type="submit" class="boton-login">Iniciar sesión</button>

            </form>

            <p>
                <?php echo $mensaje; ?>
            </p>

            <p class="enlace-registro">
                ¿No tienes una cuenta?
                <a href="registro.php">
                    Regístrate aquí
                </a>
            </p>

        </main>


        <!-- BARRA LATERAL -->
        
        <?php include '../includes/sidebar.php'; ?>
        
        </aside>

    </div>

    <hr>

    <!-- PIE DE PAGINA -->
    <footer>
        <img src="../images/banner-footer.png" alt="Banner footer">
    </footer>

</body>

</html>