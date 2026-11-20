<?php
// Iniciamos la sesión para acceder al arreglo de usuarios registrados
session_start();

// Si no existe el arreglo aún, lo inicializamos vacío para evitar errores
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = array();
}

// Variables para controlar los mensajes de acceso
$mensaje = "";
$tipoMensaje = "";
$usuarioIngresado = "";

// Verificamos si se envió el formulario de inicio de sesión
if (isset($_POST['ingresar'])) {
    // Recuperamos el usuario y la contraseña capturados
    $usuarioIngresado = trim($_POST['usuario']);
    $passwordIngresada = $_POST['password'];

    // Validamos que los campos no estén vacíos
    if ($usuarioIngresado == "" || $passwordIngresada == "") {
        $mensaje = "Por favor completa todos los campos.";
        $tipoMensaje = "error";
    } else {
        // Variables auxiliares para buscar al usuario en el arreglo
        $usuarioEncontrado = false;
        $hashGuardado = "";
        $nombreEmpleado = "";

        // Recorremos el arreglo de usuarios registrados
        for ($i = 0; $i < count($_SESSION['usuarios']); $i++) {
            if ($_SESSION['usuarios'][$i]['usuario'] == $usuarioIngresado) {
                $usuarioEncontrado = true;
                $hashGuardado = $_SESSION['usuarios'][$i]['password'];
                $nombreEmpleado = $_SESSION['usuarios'][$i]['nombre'];
            }
        }

        // Si el usuario existe, verificamos su contraseña con password_verify()
        if ($usuarioEncontrado == true) {
            if (password_verify($passwordIngresada, $hashGuardado)) {
                $mensaje = "Bienvenido al sistema, " . $nombreEmpleado;
                $tipoMensaje = "exito";
            } else {
                $mensaje = "Contraseña incorrecta";
                $tipoMensaje = "error";
            }
        } else {
            $mensaje = "El usuario no se encuentra registrado.";
            $tipoMensaje = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <!-- Enlazamos la hoja de estilos externa -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor">
        <!-- Imagen decorativa para el módulo de inicio de sesión -->
        <div class="imagen-cabecera">
            <img src="img/login.png" alt="Icono de inicio de sesión">
        </div>

        <h2>Iniciar Sesión</h2>

        <!-- Mostramos el resultado de la validación de acceso -->
        <?php if ($mensaje != "") { ?>
            <div class="alerta <?php echo $tipoMensaje; ?>">
                <p><?php echo $mensaje; ?></p>
            </div>
        <?php } ?>

        <!-- Formulario de acceso -->
        <form method="POST" action="">
            <label>Nombre de usuario:</label>
            <input type="text" name="usuario" value="<?php echo $usuarioIngresado; ?>" required>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit" name="ingresar">Entrar al sistema</button>
        </form>

        <!-- Enlace para regresar al formulario de registro -->
        <div class="enlace">
            <p>¿No tienes cuenta? <a href="registroFN.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>