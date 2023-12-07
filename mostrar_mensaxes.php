<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header("location: entra.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit();
}

// Obtener mensajes de la base de datos dirigidos al grupo del usuario
//$conexion = new mysqli("localhost", "root", "", "proyecto");
$conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");

$id_usuario = $_SESSION['id_usuario'];

// Verificar si el usuario es un profesor
$es_profesor = isset($_SESSION['profesor']) && $_SESSION['profesor'] == 1;

// Definir la cantidad de mensajes por página
$mensajes_por_pagina = 4;

// Obtener la página actual
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el offset
$offset = ($pagina_actual - 1) * $mensajes_por_pagina;

// Obtener mensajes dirigidos a los grupos del usuario o a todos los grupos si es profesor
if ($es_profesor) {
    $sql = "SELECT DISTINCT mensajes.mensaje, mensajes.fecha, grupos.nombre_grupo 
            FROM mensajes 
            INNER JOIN mensajes_grupos ON mensajes.id_mensaje = mensajes_grupos.id_mensaje 
            INNER JOIN grupos ON grupos.id_grupo = mensajes_grupos.id_grupo 
            ORDER BY mensajes.fecha DESC
            LIMIT $mensajes_por_pagina OFFSET $offset;";
    // Realizar la consulta de conteo antes de cerrar la conexión
    $sql_paginacion = "SELECT COUNT(DISTINCT mensajes.mensaje) as total FROM mensajes 
    INNER JOIN mensajes_grupos ON mensajes.id_mensaje = mensajes_grupos.id_mensaje 
    INNER JOIN grupos ON grupos.id_grupo = mensajes_grupos.id_grupo";
    
} else {
    $sql = "SELECT DISTINCT mensajes.mensaje, mensajes.fecha, grupos.nombre_grupo 
            FROM mensajes 
            INNER JOIN mensajes_grupos ON mensajes.id_mensaje = mensajes_grupos.id_mensaje 
            INNER JOIN usuarios_grupos ON mensajes_grupos.id_grupo = usuarios_grupos.id_grupo and usuarios_grupos.id_usuario = $id_usuario 
            INNER JOIN grupos ON grupos.id_grupo = usuarios_grupos.id_grupo 
            ORDER BY mensajes.fecha DESC
            LIMIT $mensajes_por_pagina OFFSET $offset;";
    // Realizar la consulta de conteo antes de cerrar la conexión
    $sql_paginacion = "SELECT COUNT(DISTINCT mensajes.mensaje) as total FROM mensajes 
    INNER JOIN mensajes_grupos ON mensajes.id_mensaje = mensajes_grupos.id_mensaje 
    INNER JOIN usuarios_grupos ON mensajes_grupos.id_grupo = usuarios_grupos.id_grupo and usuarios_grupos.id_usuario = $id_usuario 
    INNER JOIN grupos ON grupos.id_grupo = usuarios_grupos.id_grupo ";
}
$resultado_paginacion = $conexion->query($sql_paginacion);
$fila_total = $resultado_paginacion->fetch_assoc();
$total_paginas = ceil($fila_total['total'] / $mensajes_por_pagina);

$resultado = $conexion->query($sql);



$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
	<title>Mostrar mensaxes</title>

	<link rel="shortcut icon" href="assets/images/logo.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" id="boton-desplegable" aria-label="menu desplegable" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="imagenes"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.html">Principal</a></li>
					<li><a href="actividades.html">Actividades</a></li>
					<li><a href="sobrenos.html">Sobre nós</a></li>
					<li><a href="ondeestamos.html">Onde estamos</a></li>
					<li><a class="btn" href="entra.php">ENTRAR</a></li>
				</ul>
			</div>
		</div>
	</div> 

	<header id="head" class="secondary"></header>

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Principal</a></li>
            <li class="active">Mostrar mensaxes</li>
        </ol>

        <div class="row">
            <article class="col-sm-9 maincontent">
                <header class="page-header">
                    <h1 class="page-title">Mostrar mensaxes</h1>
                </header>

                <div class="mensajes-section">

                    <?php
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<div class='panel panel-default'>
                                  <div class='panel-heading'><strong>{$fila['nombre_grupo']}</strong> - {$fila['fecha']}</div>
                                  <div class='panel-body'>{$fila['mensaje']}</div>
                              </div>";
                    }
                    ?>

                    <!-- Paginación -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php
                            // Mostrar enlaces de paginación
                            for ($i = 1; $i <= $total_paginas; $i++) {
                                echo "<li " . ($i == $pagina_actual ? "class='active'" : "") . "><a href='?pagina=$i'>$i</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><a class="btn btn-danger" href="paxinausuarios.php">Volver</a></p>
                                    </div>
                                </div>
            </article>
            
        </div>
    </div>


    <footer id="footer" class="top-space">
        <div class="footer2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="simplenav">
                                <a href="index.html">Principal</a> |
                                <a href="sobrenos.html">Sobre nós</a> |
                                <a href="actividades.html">Actividades</a> |
                                <a href="ondeestamos.html">Onde estamos</a> |
                                <b><a href="entra.php">Entra</a></b>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="text-right">
                                &copy; 2023 Carlos Quintas <a href="https://cifpacarballeira.gal/" rel="designer">CIFP A Carballeira</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/headroom.min.js"></script>
    <script src="assets/js/jQuery.headroom.min.js"></script>
    <script src="assets/js/template.js"></script>
</body>
</html>
