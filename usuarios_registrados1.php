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

        if(!isset($_SESSION["nombre"])){
            #comprobamos si esta seteado un usuario y si no lo enviamos al login
            header("location:login.php");
        }
    
    
    ?>

    <h2>Info solo para registrados</h2>
    <?php
    
        echo "Hola " . $_SESSION["nombre"] . "<br></br>";
    
    ?>
    <p><a href="enviar_mensaje.php">Enviar mensaje</a></p>
    <p><a href="mostrar_mensajes.php">Ver mensajes</a></p>
    <p><a href="administrar_grupos.php">Administrar grupos</a></p>
    <p><a href="cierre.php">Cierra sesion</a></p>
    
</body>
</html>