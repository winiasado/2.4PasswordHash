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
            <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>