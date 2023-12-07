<?php
                        session_start();
                        if(isset($_SESSION["nombre"])){
                            #comprobamos si esta seteado un usuario si no lo enviamos al login
                            header("location:paxinausuarios.php");
                        }
                
                        
                    ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
	
	<title>Entra</title>

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
				<button type="button" class="navbar-toggle" id="boton-desplegable" aria-label="menu desplegable" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="imagenes"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.html">Principal</a></li>
					<li><a href="actividades.html">Actividades</a></li>
					<li><a href="sobrenos.html">Sobre nós</a></li>
					<li><a href="ondeestamos.html">Onde estamos</a></li>
					<li class="active"><a class="btn" href="entra.html">ENTRAR</a></li>
				</ul>
			</div>
		</div>
	</div> 

	<header id="head" class="secondary"></header>

	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Principal</a></li>
			<li class="active">Entra</li>
		</ol>

		<div class="row">
			
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Entra</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Accede a túa conta</h3>
							<p class="text-center text-muted">Introduce as túas credenciales para acceder ó sitio. </p>
							<hr>
							
							<form action="comprueba.php" method="post">
								<div class="top-margin">
									<label>Usuario <span class="text-danger">*</span></label>
									<input type="text" name="nombre" class="form-control">
								</div>
								<div class="top-margin">
									<label>Contrasinal <span class="text-danger">*</span></label>
									<input type="password" name="password" class="form-control">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<b><a href="">Esqueciches a contrasinal?</a></b>
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-danger" type="submit">Entra</button>
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