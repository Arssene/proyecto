<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    $db_host = "localhost";
    $db_nombre = "proyecto";
    $db_usuario = "root";
    $db_contra = "";

    $conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre);

    // Verificar la conexión
    if (!$conexion) {
        die("La conexión falló: " . mysqli_connect_error());
    }

    $consulta = "SELECT * FROM usuarios";

    $resultados = mysqli_query($conexion, $consulta);

    $fila = mysqli_fetch_row($resultados);

    echo $fila[0];

    // Cerrar la conexión
    mysqli_close($conexion);
?>





</body>
</html>