<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Formulario de Inicio de Sesión</h2>
    <form action="comprueba.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
