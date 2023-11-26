<?php
session_start();

// Verificar si el usuario está autenticado y es profesor


if (isset($_SESSION['id_usuario']) && isset($_SESSION['profesor']) && $_SESSION['profesor'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesar el formulario de envío de mensajes
    
        $mensaje = $_POST['mensaje'];
        $id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario autenticado
    
        // Verificar si 'grupos_destino' está definido antes de intentar acceder a él
        $grupos_destino = isset($_POST['grupos_destino']) ? $_POST['grupos_destino'] : [];
    
        // Obtener la lista de grupos a los que pertenece el usuario
        $conexion = new mysqli("localhost", "root", "", "proyecto");
    
        // Insertar el mensaje en la base de datos
        $sqlInsertarMensaje = "INSERT INTO mensajes (id_usuario, mensaje) VALUES ($id_usuario, '$mensaje')";
        $conexion->query($sqlInsertarMensaje);
    
        // Obtener el ID del último mensaje insertado
        $id_mensaje = $conexion->insert_id;
    
        // Asociar el mensaje con los grupos seleccionados
        foreach ($grupos_destino as $id_grupo) {
            $sqlInsertarMensajeGrupo = "INSERT INTO mensajes_grupos (id_mensaje, id_grupo) VALUES ($id_mensaje, $id_grupo)";
            $conexion->query($sqlInsertarMensajeGrupo);
        }
    
        $conexion->close();
    }
    ?>
    
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Enviar Mensaje</title>
    </head>
    <body>
        <h2>Enviar Mensaje</h2>
    
        <form method="post" action="enviar_mensaje.php">
        <label for="mensaje">Mensaje:</label>
        <textarea name="mensaje" id="mensaje" required></textarea><br>
        <label for="grupos_destino">Seleccionar Grupos Destino:</label>
        <!-- Seleccionar los grupos a los que se enviará el mensaje con checkboxes -->
        <?php
        $conexion = new mysqli("localhost", "root", "", "proyecto");
        $sqlGrupos = "SELECT id_grupo, nombre_grupo FROM grupos";
        $resultadoGrupos = $conexion->query($sqlGrupos);
    
        while ($filaGrupo = $resultadoGrupos->fetch_assoc()) {
            echo "<label><input type='checkbox' name='grupos_destino[]' value='{$filaGrupo['id_grupo']}'>{$filaGrupo['nombre_grupo']}</label><br>";
        }
    
        $conexion->close();
        ?>
    
        <br>
        <input type="submit" value="Enviar Mensaje">
    </form>
    
    
        <br>
        <p><a href="usuarios_registrados1.php">Volver</p>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </body>
    </html>
    <?php
}

else{
    header("location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado o no es profesor
    exit();
}
?>