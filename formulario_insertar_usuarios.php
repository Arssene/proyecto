<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Nuevo Usuarios</title>
</head>
<body>
    
    <h2>Registro Nuevo Usuarios</h2>
    <form action="pagina_insertar_usuarios.php" method="post">
        <table>
            <tr>
                <td>Usuario</td>
                <td><input type="text" name="usuario" id="usuario"></td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td><input type="text" name="apellido" id="apellido"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" id="email"></td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td><input type="text" name="telefono" id="telefono"></td>
            </tr>
            <tr>
                <td>Es profesor</td>
                <td><input type="checkbox" name="profesor" id="profesor"></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="enviado" value="Enviar"></td>
            </tr>
        </table>
    </form>

</body>
</html>