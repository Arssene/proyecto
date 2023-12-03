<?php 
	if(isset($_POST["submit"])){

		$nombre = $_POST["nombre"];
		$email = $_POST["email"];
		$mensaxe = $_POST["mensaxe"];
		$telefono = $_POST["telefono"];
		$destinatario = "kkintas@gmail.com";
		$asunto = "Nova mensaxe de " . $nombre;
		$contenido = "Nome: " . $nombre . "\n Email: " . $email . "\n Telefono: " . $telefono . "\n Mensaxe: " . $mensaxe;
		
		$header ="from: apuntate@academiaepsilon.com";
		$mail = mail($destinatario, $asunto,$contenido,$header);
		header("location: index.html");
	}else{
		header("location: index.html");
	}
	
	exit;
?>