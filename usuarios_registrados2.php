<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        session_start();

        if(!isset($_SESSION["usuario"])){
            #comprobamos si esta seteado un usuario y si no lo enviamos al login
            header("location:login.php");
        }
    
    
    ?>

    <h2>Info solo para registrados</h2>
    <?php
        #uasando la variable global podemos coger el nombre de usuario para usarlo
        echo "Hola " . $_SESSION["usuario"] . "<br></br>";
    
    ?>
    <p><a href="usuarios_registrados1.php">Volver</p>
    <p><a href="cierre.php">Cierra sesion</a></p>

</body>
</html>