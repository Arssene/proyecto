<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

        #cogemos la sesion en curso y la cerramos, luego llevamos a index
        session_start();
        session_destroy();

        header("location:index.html");

    ?>










</body>
</html>