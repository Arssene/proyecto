<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
	<title>Páxina persoal</title>

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
			<li class="active">Paxina persoal</li>
		</ol>

		<div class="row">
			
			<article class="col-sm-9 maincontent">
				<header class="page-header">
					<h1 class="page-title">
                    <?php

                        session_start();

                        if(!isset($_SESSION["nombre"])){
                            #comprobamos si esta seteado un usuario y si no lo enviamos al login
                            header("location:index.html");
                        }
                
                        echo "Hola " . $_SESSION["nombre"] . "<br></br>";
                    ?>

                    </h1>
				</header>
		
				<br>
					
       <!-- Verificar si el usuario es profesor antes de mostrar los enlaces -->
       <?php if (isset($_SESSION['profesor']) && $_SESSION['profesor'] == 1): ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><a class="btn btn-danger" href="enviar_mensaje.php">Enviar mensaje</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><a class="btn btn-danger" href="formulario_insertar_usuarios.php">Alta usuarios</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p><a class="btn btn-danger" href="administrar_grupos.php">Administrar grupos</a></p>
                        </div>
                    </div>
                <?php endif; ?>



                <div class="row">
                    <div class="col-sm-6">
                        <p><a class="btn btn-danger" href="mostrar_mensaxes.php">Ver mensajes</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p><a class="btn btn-danger" href="cierre.php">Pecha sesion</a></p>
                    </div>
                </div>
            </article>
        </div>
    </div>
	
	<section class="container-full top-space">
		<div id="map"></div>
	</section>

    

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