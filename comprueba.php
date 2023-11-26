<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "proyecto");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Recuperar datos del formulario
$nombre = $_POST['nombre'];
$password = $_POST['password'];

// Obtener el id_usuario, la contraseña y la información de profesor almacenada en la base de datos
$sql = "SELECT id_usuario, password, profesor FROM usuarios WHERE nombre = '$nombre'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $id_usuario = $fila['id_usuario'];
    $hash = $fila['password'];
    $es_profesor = $fila['profesor'];

    // Verificar la contraseña
    if (password_verify($password, $hash)) {
        echo "Inicio de sesión exitoso";
        session_start();
        $_SESSION["id_usuario"] = $id_usuario;
        $_SESSION["nombre"] = $nombre;
        $_SESSION["profesor"] = $es_profesor; // Convertir a booleano para asegurar que sea true o false

        header("location:usuarios_registrados1.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Contraseña incorrecta";
        echo "<br>Contraseña ingresada: $password";
        echo "<br>Contraseña almacenada: $hash";
        echo "<br>Longitud de la contraseña ingresada: " . strlen($password);
        echo "<br>Longitud de la contraseña almacenada: " . strlen($hash);
    }
} else {
    echo "Usuario no encontrado";
}

// Cerrar la conexión
$conexion->close();
?>
