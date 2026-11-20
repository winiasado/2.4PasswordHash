<?php
// Iniciamos la sesión para poder guardar el arreglo de usuarios entre páginas
session_start();

// Si el arreglo de usuarios aún no existe en la sesión, lo creamos vacío
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = array();
}

// Variables para mostrar mensajes y mantener los datos escritos
$mensaje = "";
$tipoMensaje = "";
$nombre = "";
$usuario = "";

// Verificamos si el formulario fue enviado por el método POST
if (isset($_POST['registrar'])) {
    // Recuperamos los datos enviados desde el formulario
    $nombre = trim($_POST['nombre']);
    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    // Validamos que ningún campo esté vacío
    if ($nombre == "" || $usuario == "" || $password == "" || $confirmar == "") {
        $mensaje = "Todos los campos son obligatorios.";
        $tipoMensaje = "error";
    } 
    // Validamos que la contraseña tenga al menos 6 caracteres
    else if (strlen($password) < 6) {
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
        $tipoMensaje = "error";
    } 
    // Validamos que la contraseña y su confirmación sean iguales
    else if ($password != $confirmar) {
        $mensaje = "Las contraseñas no coinciden.";
        $tipoMensaje = "error";
    } 
    else {
        // Buscamos si el nombre de usuario ya fue registrado anteriormente
        $existe = false;
        for ($i = 0; $i < count($_SESSION['usuarios']); $i++) {
            if ($_SESSION['usuarios'][$i]['usuario'] == $usuario) {
                $existe = true;
            }
        }

        if ($existe == true) {
            $mensaje = "Ese nombre de usuario ya está en uso.";
            $tipoMensaje = "error";
        } else {
            // Encriptamos la contraseña usando password_hash()
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Creamos el arreglo con los datos del nuevo empleado
            $nuevoUsuario = array(
                'nombre' => $nombre,
                'usuario' => $usuario,
                'password' => $passwordHash
            );

            // Guardamos el usuario en el arreglo general de la sesión
            $_SESSION['usuarios'][] = $nuevoUsuario;

            // Limpiamos los campos y mostramos el mensaje de éxito
            $mensaje = "Usuario registrado correctamente.";
            $tipoMensaje = "exito";
            $nombre = "";
            $usuario = "";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuarios</title>
    <!-- Enlazamos la hoja de estilos externa -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="contenedor">
        <!-- Imagen decorativa para el módulo de registro -->
        <div class="imagen-cabecera">
            <img src="img/registro.png" alt="Icono de registro">
        </div>

        <h2>Registro de Empleados</h2>

        <!-- Mostramos alertas de error o de confirmación si existen -->
        <?php if ($mensaje != "") { ?>
            <div class="alerta <?php echo $tipoMensaje; ?>">
                <p><?php echo $mensaje; ?></p>
            </div>
        <?php } ?>

        <!-- Formulario de registro -->
        <form method="POST" action="">
            <label>Nombre completo:</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" required>

            <label>Nombre de usuario (login):</label>
            <input type="text" name="usuario" value="<?php echo $usuario; ?>" required>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <label>Confirmar contraseña:</label>
            <input type="password" name="confirmar" required>

            <button type="submit" name="registrar">Registrar Usuario</button>
        </form>

        <!-- Enlace para ir a la página de inicio de sesión -->
        <div class="enlace">
            <p>¿Ya tienes una cuenta? <a href="loginFN.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>