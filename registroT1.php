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
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>