<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <h1>INTRODUCE TUS DATOS</h1>

    <form action="comprueba_login.php" method="post">
        <table>
            <tr>
                <td>Login:</td>
            </tr>
            <tr>    
                <td><input type="text" name="login"></td>
            </tr>
            <tr>    
                <td><input type="password" name="password"></td>
            </tr>
            <tr>    
                <td colspan="2"><input type="submit" name="enviar" value="LOGIN"></td>
            </tr>
        </table>



</body>
</html>
