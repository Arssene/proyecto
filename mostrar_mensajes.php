<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit();
}

// Obtener mensajes de la base de datos dirigidos al grupo del usuario
$conexion = new mysqli("localhost", "root", "", "proyecto");
$id_usuario = $_SESSION['id_usuario'];

// Obtener mensajes dirigidos a los grupos del usuario
$sql = "SELECT DISTINCT mensajes.mensaje, mensajes.fecha, grupos.nombre_grupo 
        FROM mensajes 
        INNER JOIN mensajes_grupos ON mensajes.id_mensaje = mensajes_grupos.id_mensaje 
        INNER JOIN usuarios_grupos ON mensajes_grupos.id_grupo = usuarios_grupos.id_grupo and usuarios_grupos.id_usuario = $id_usuario 
        INNER JOIN grupos ON grupos.id_grupo = usuarios_grupos.id_grupo 
        INNER JOIN usuarios ON usuarios_grupos.id_usuario = usuarios.id_usuario 
        ORDER BY mensajes.fecha DESC;";
$resultado = $conexion->query($sql);

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mostrar Mensajes</title>
</head>
<body>
    <h2>Mensajes</h2>

    <?php
    while ($fila = $resultado->fetch_assoc()) {
        echo "<p><strong>Grupo: {$fila['nombre_grupo']}</strong> el {$fila['fecha']}</p>
        <p> {$fila['mensaje']} </p>";
    }
    ?>

    <br>
    <p><a href="usuarios_registrados1.php">Volver</p>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>
