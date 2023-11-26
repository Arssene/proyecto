<?php 
	if(isset($_POST["submit"])){

		$nombre = $_POST["nombre"];
		$email = $_POST["email"];
		$mensaxe = $_POST["mensaxe"];
		$destinatario = "kkintas@gmail.com";
		$asunto = "Nuevo mensaje de $nombre";
		$contenido = $mensaxe;
		
		$header ="from: apuntate@academiaepsilon.com";
		$mail = mail($destinatario, $asunto,$contenido,$header);
		header("location: index.html");
	}else{
		header("location: index.html");
	}
	
	exit;
?>