<?php
session_start();

// Verificar si el usuario está autenticado y es profesor


if (isset($_SESSION['id_usuario']) && isset($_SESSION['profesor']) && $_SESSION['profesor'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesar el formulario de envío de mensajes
    
        $mensaje = $_POST['mensaje'];
        $id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario autenticado
    
        // Verificar si 'grupos_destino' está definido antes de intentar acceder a él
        $grupos_destino = isset($_POST['grupos_destino']) ? $_POST['grupos_destino'] : [];
    
        // Obtener la lista de grupos a los que pertenece el usuario
        $conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");
    
        // Insertar el mensaje en la base de datos
        $sqlInsertarMensaje = "INSERT INTO mensajes (id_usuario, mensaje) VALUES ($id_usuario, '$mensaje')";
        $conexion->query($sqlInsertarMensaje);
    
        // Obtener el ID del último mensaje insertado
        $id_mensaje = $conexion->insert_id;
    
        // Asociar el mensaje con los grupos seleccionados
        foreach ($grupos_destino as $id_grupo) {
            $sqlInsertarMensajeGrupo = "INSERT INTO mensajes_grupos (id_mensaje, id_grupo) VALUES ($id_mensaje, $id_grupo)";
            $conexion->query($sqlInsertarMensajeGrupo);
        }
    
        $conexion->close();
    }
    ?>
    
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport"    content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
             
            <title>Enviar mensaxe</title>

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
			<li class="active">Enviar mensaxe</li>
		</ol>

		<div class="row">
			
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Enviar mensaxes</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Envía unha mensaxe</h3>
							<p class="text-center text-muted">Selecciona os grupos aos que vai dirixida. </p>
							<hr>
                            <form class="col-6" method="post" action="enviar_mensaje.php">
                                <label for="mensaje">Mensaxe:</label>
                                <textarea class="form-control" name="mensaje" id="mensaje" required></textarea><br>
                                <label for="grupos_destino">Seleccionar Grupos Destino:</label>
                                <br>
                                <!-- Seleccionar los grupos a los que se enviará el mensaje con checkboxes -->
                                <?php
                                $conexion = new mysqli("localhost", "u808422263_root", "Alumno.123", "u808422263_proyecto");
                                $sqlGrupos = "SELECT id_grupo, nombre_grupo FROM grupos";
                                $resultadoGrupos = $conexion->query($sqlGrupos);
                            
                                while ($filaGrupo = $resultadoGrupos->fetch_assoc()) {
                                    echo "<label><input type='checkbox' class='form-check' name='grupos_destino[]' value='{$filaGrupo['id_grupo']}'><span style='margin-left: 5px;'>{$filaGrupo['nombre_grupo']}</span></label><br>";
                                }
                            
                                $conexion->close();
                                ?>
                            
                                <br>
                                <input type="submit" class="btn btn-danger" value="Enviar Mensaxe">
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
    <?php
}

else{
    header("location: login.php"); // Redirixir a página de inicio de sesión si no está autenticado o no es profesor
    exit();
}
?>