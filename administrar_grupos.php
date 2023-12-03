<?php
session_start();

// Verificar si el usuario está autenticado y es profesor
if (!isset($_SESSION['id_usuario']) || !$_SESSION['profesor']) {
    header("location: index.html"); // Redirigir a la página de inicio de sesión si no está autenticado o no es profesor
    exit();
}

// Procesar las acciones de administración de grupos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $nombre_grupo = $_POST['nombre_grupo'];
    $conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");
    
    switch ($accion) {
        case 'crear_grupo':
            // Crear un nuevo grupo
            $sql = "INSERT INTO grupos (nombre_grupo) VALUES ('$nombre_grupo')";
            break;

        case 'agregar_usuario':
            // Agregar un usuario a un grupo
            $sql = "INSERT INTO usuarios_grupos (id_usuario, id_grupo) VALUES ($id_usuario, $id_grupo)";
            break;

        case 'quitar_usuario':
            // Quitar un usuario de un grupo
            $sql = "DELETE FROM usuarios_grupos WHERE id_usuario = $id_usuario AND id_grupo = $id_grupo";
            break;
    }

    $conexion->query($sql);
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
	<title>Administrar grupos</title>

	<link rel="shortcut icon" href="assets/images/logo.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">


</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="imagenes"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li class="active"><a href="index.html">Principal</a></li>
					<li><a href="actividades.html">Actividades</a></li>
					<li><a href="sobrenos.html">Sobre nós</a></li>
					<li><a href="ondeestamos.html">Onde estamos</a></li>
					<li><a class="btn" href="entra.html">ENTRAR</a></li>
				</ul>
			</div>
		</div>
	</div> 

    <header id="head" class="secondary"></header>

    <div class="container">

    <ol class="breadcrumb">
        <li><a href="index.html">Principal</a></li>
        <li class="active">Administrar grupos</li>
    </ol>

    <div class="row">
        
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title">Administrar Grupos</h1>
            </header>
            
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body" style="padding:45px;">
                        
                        <h3><p class="text-center text-muted">Crear novo grupo</p></h3>
                        <hr>
                        
                        
                            <div class="top-margin">
                                <!-- Formulario para crear un nuevo grupo -->
                                <form method="post" action="administrar_grupos.php">
                                    <input type="hidden" name="accion" value="crear_grupo">
                                    <label for="nombre_grupo">Nome do grupo:</label>
                                    <br>
                                    <input type="text" name="nombre_grupo" required>
                                    <br>
                                    <input type="submit" style ="margin-left:20px;" class="btn btn-danger" value="Crear">
                                </form>
                            </div>

                            <hr>
                            <h3 style="margin-top:70px"><p class="text-center text-muted">Agregar usuario a grupo</p></h3>
                            <hr>

                            <div class="top-margin">
                                <!-- Formulario para añadir o quitar usuarios en grupos existentes -->
                                <form method="post" action="administrar_grupos.php">
                                    <input type="hidden" name="accion" value="agregar_usuario">

                                    <!-- Seleccionar usuario -->
                                    <label for="id_usuario">Usuario:</label>
                                    <select name="id_usuario" class="form-control" required>
                                        <!-- Obtener la lista de usuarios -->
                                        <?php
                                        $conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");
                                        $sqlUsuarios = "SELECT id_usuario, nombre FROM usuarios";
                                        $resultadoUsuarios = $conexion->query($sqlUsuarios);

                                        while ($filaUsuario = $resultadoUsuarios->fetch_assoc()) {
                                            echo "<option value='{$filaUsuario['id_usuario']}'>{$filaUsuario['nombre']}</option>";
                                        }

                                        $conexion->close();
                                        ?>
                                    </select>

                                    <!-- Seleccionar grupo -->
                                    <label for="id_grupo">Grupo:</label>
                                    <select name="id_grupo" class="form-control" required>
                                        <!-- Obtener la lista de grupos -->
                                        <?php
                                        $conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");
                                        $sqlGrupos = "SELECT id_grupo, nombre_grupo FROM grupos";
                                        $resultadoGrupos = $conexion->query($sqlGrupos);

                                        while ($filaGrupo = $resultadoGrupos->fetch_assoc()) {
                                            echo "<option value='{$filaGrupo['id_grupo']}'>{$filaGrupo['nombre_grupo']}</option>";
                                        }

                                        $conexion->close();
                                        ?>
                                    </select>
                                    <br>
                                    <input type="submit" class="btn btn-danger" value="Agregar">
                                </form>
                            </div>

                            <hr>
                            <h3 style="margin-top:70px"><p class="text-center text-muted">Eliminar usuario de grupo</p></h3>
                            <hr>
                            
                            <div>
                                <!-- Formulario para quitar usuario de un grupo -->
                                <form method="post" action="administrar_grupos.php">
                                    <input type="hidden" name="accion" value="quitar_usuario">

                                    <!-- Seleccionar usuario -->
                                    <label for="id_usuario">Usuario:</label>
                                    <select name="id_usuario" class="form-control" required>
                                        <!-- Obtener la lista de usuarios -->
                                        <?php
                                        $conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");
                                        $sqlUsuarios = "SELECT id_usuario, nombre FROM usuarios";
                                        $resultadoUsuarios = $conexion->query($sqlUsuarios);

                                        while ($filaUsuario = $resultadoUsuarios->fetch_assoc()) {
                                            echo "<option value='{$filaUsuario['id_usuario']}'>{$filaUsuario['nombre']}</option>";
                                        }

                                        $conexion->close();
                                        ?>
                                    </select>

                                    <!-- Seleccionar grupo -->
                                    <label for="id_grupo">Grupo:</label>
                                    <select name="id_grupo" class="form-control" required>
                                        <!-- Obtener la lista de grupos -->
                                        <?php
                                        $conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");
                                        $sqlGrupos = "SELECT id_grupo, nombre_grupo FROM grupos";
                                        $resultadoGrupos = $conexion->query($sqlGrupos);

                                        while ($filaGrupo = $resultadoGrupos->fetch_assoc()) {
                                            echo "<option value='{$filaGrupo['id_grupo']}'>{$filaGrupo['nombre_grupo']}</option>";
                                        }

                                        $conexion->close();
                                        ?>
                                    </select>
                                        <br>
                                    <input type="submit" class="btn btn-danger" value="Quitar">

                                    <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><a class="btn btn-danger" href="paxinausuarios.php">Volver</a></p>
                                    </div>
                                </div>
                                </form>
                            </div>       
                    </div>
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
								<b><a href="entra.html">Entra</a></b>
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
