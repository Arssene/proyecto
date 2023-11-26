<?php
session_start();

// Verificar si el usuario está autenticado y es profesor
if (!isset($_SESSION['id_usuario']) || !$_SESSION['profesor']) {
    header("location: login.php"); // Redirigir a la página de inicio de sesión si no está autenticado o no es profesor
    exit();
}

// Procesar las acciones de administración de grupos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];

    switch ($accion) {
        case 'crear_grupo':
            // Crear un nuevo grupo
            $nombre_grupo = $_POST['nombre_grupo'];
            $conexion = new mysqli("localhost", "root", "", "proyecto");
            $sql = "INSERT INTO grupos (nombre_grupo) VALUES ('$nombre_grupo')";
            $conexion->query($sql);
            $conexion->close();
            break;

        case 'agregar_usuario':
            // Agregar un usuario a un grupo
            $id_usuario = $_POST['id_usuario'];
            $id_grupo = $_POST['id_grupo'];
            $conexion = new mysqli("localhost", "root", "", "proyecto");
            $sql = "INSERT INTO usuarios_grupos (id_usuario, id_grupo) VALUES ($id_usuario, $id_grupo)";
            $conexion->query($sql);
            $conexion->close();
            break;

        case 'quitar_usuario':
            // Quitar un usuario de un grupo
            $id_usuario = $_POST['id_usuario'];
            $id_grupo = $_POST['id_grupo'];
            $conexion = new mysqli("localhost", "root", "", "proyecto");
            $sql = "DELETE FROM usuarios_grupos WHERE id_usuario = $id_usuario AND id_grupo = $id_grupo";
            $conexion->query($sql);
            $conexion->close();
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Administrar Grupos</title>
</head>
<body>
    <h2>Administrar Grupos</h2>

    <!-- Formulario para crear un nuevo grupo -->
    <form method="post" action="administrar_grupos.php">
        <input type="hidden" name="accion" value="crear_grupo">
        <label for="nombre_grupo">Nombre del nuevo grupo:</label>
        <input type="text" name="nombre_grupo" required>
        <input type="submit" value="Crear Grupo">
    </form>

    <br>

    <!-- Formulario para añadir o quitar usuarios en grupos existentes -->
    <form method="post" action="administrar_grupos.php">
        <input type="hidden" name="accion" value="agregar_usuario">

        <!-- Seleccionar usuario -->
        <label for="id_usuario">Seleccionar Usuario:</label>
        <select name="id_usuario" required>
            <!-- Obtener la lista de usuarios -->
            <?php
            $conexion = new mysqli("localhost", "root", "", "proyecto");
            $sqlUsuarios = "SELECT id_usuario, nombre FROM usuarios";
            $resultadoUsuarios = $conexion->query($sqlUsuarios);

            while ($filaUsuario = $resultadoUsuarios->fetch_assoc()) {
                echo "<option value='{$filaUsuario['id_usuario']}'>{$filaUsuario['nombre']}</option>";
            }

            $conexion->close();
            ?>
        </select>

        <!-- Seleccionar grupo -->
        <label for="id_grupo">Seleccionar Grupo:</label>
        <select name="id_grupo" required>
            <!-- Obtener la lista de grupos -->
            <?php
            $conexion = new mysqli("localhost", "root", "", "proyecto");
            $sqlGrupos = "SELECT id_grupo, nombre_grupo FROM grupos";
            $resultadoGrupos = $conexion->query($sqlGrupos);

            while ($filaGrupo = $resultadoGrupos->fetch_assoc()) {
                echo "<option value='{$filaGrupo['id_grupo']}'>{$filaGrupo['nombre_grupo']}</option>";
            }

            $conexion->close();
            ?>
        </select>

        <input type="submit" value="Agregar Usuario a Grupo">
    </form>

    <br>

    <!-- Formulario para quitar usuario de un grupo -->
    <form method="post" action="administrar_grupos.php">
        <input type="hidden" name="accion" value="quitar_usuario">

        <!-- Seleccionar usuario -->
        <label for="id_usuario">Seleccionar Usuario:</label>
        <select name="id_usuario" required>
            <!-- Obtener la lista de usuarios -->
            <?php
            $conexion = new mysqli("localhost", "root", "", "proyecto");
            $sqlUsuarios = "SELECT id_usuario, nombre FROM usuarios";
            $resultadoUsuarios = $conexion->query($sqlUsuarios);

            while ($filaUsuario = $resultadoUsuarios->fetch_assoc()) {
                echo "<option value='{$filaUsuario['id_usuario']}'>{$filaUsuario['nombre']}</option>";
            }

            $conexion->close();
            ?>
        </select>

        <!-- Seleccionar grupo -->
        <label for="id_grupo">Seleccionar Grupo:</label>
        <select name="id_grupo" required>
            <!-- Obtener la lista de grupos -->
            <?php
            $conexion = new mysqli("localhost", "root", "", "proyecto");
            $sqlGrupos = "SELECT id_grupo, nombre_grupo FROM grupos";
            $resultadoGrupos = $conexion->query($sqlGrupos);

            while ($filaGrupo = $resultadoGrupos->fetch_assoc()) {
                echo "<option value='{$filaGrupo['id_grupo']}'>{$filaGrupo['nombre_grupo']}</option>";
            }

            $conexion->close();
            ?>
        </select>

        <input type="submit" value="Quitar Usuario de Grupo">
    </form>

    <br>
    <p><a href="usuarios_registrados1.php">Volver</p>
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>
