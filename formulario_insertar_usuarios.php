<?php
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION['nombre'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	
	<title>Alta usuarios</title>

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
					<li><a href="index.html">Principal</a></li>
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
			<li class="active">Alta usuario/a</li>
		</ol>

		<div class="row">
			
		<article class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 form-container">
				<header class="page-header">
					<h1 class="page-title">Alta usuario/a</h1>
				</header>

				<div class="panel panel-default">
					<div class="panel-body" style="padding:45px;">
						<form action="pagina_insertar_usuarios.php" method="post">
							<div class="row">
								<div class="col-md-12">
									<h3>Usuario</h3>
									<input type="text" name="usuario" id="usuario" class="form-control">
								</div>
								<div class="col-md-12">
									<h3>Apelido</h3>
									<input type="text" name="apellido" id="apellido" class="form-control">
								</div>
								<div class="col-md-12">
									<h3>Email</h3>
									<input type="email" name="email" id="email" class="form-control">
								</div>
								<div class="col-md-12">
									<h3>Telefono</h3>
									<input type="text" name="telefono" id="telefono" class="form-control">
								</div>
								<div class="col-md-12">
									<h3>Password</h3>
									<input type="password" name="password" id="password" class="form-control">
								</div>
								<div class="col-md-12 checkbox-container">
									<h3>Docente</h3>	
									<div style="display: inline-block;">
										<input type="checkbox" name="profesor" id="profesor">
									</div>
									<p style="display: inline-block;">*Marcar si é docente</p>
								</div>
								<div class="col-xs-12">
									<input class="btn btn-danger" type="submit" name="enviado" style="width:200px;" value="Agregar usuario/a">
								</div>
								<div class="col-md-6">
									<p><a class="btn btn-danger" href="paxinausuarios.php"  style="margin-top:20px; width:200px;">Volver</a></p>
								</div>
							</div>
						</form>
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