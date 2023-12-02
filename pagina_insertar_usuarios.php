<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado Registro</title>
</head>
<body>
    
    <?php
        $usuario = $_POST["usuario"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $password = $_POST["password"];
        $profesor = isset($_POST["profesor"]) ? 1 : 0;

        #ciframos la password del usuario
        $cifrado_pass = password_hash($password, PASSWORD_DEFAULT);
        try {
            $base = new PDO('mysql:host=localhost; dbname=proyecto', 'root', '');
        
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $base->exec("SET CHARACTER SET utf8");
        
            $sql = "INSERT INTO usuarios (nombre, apellido, email, telefono, profesor, password) 
                    VALUES (:usuario, :apellido, :email, :telefono, :profesor, :password)";
            
            $resultado = $base->prepare($sql);
            $resultado->execute(array(
                ":usuario" => $usuario,
                ":apellido" => $apellido,
                ":email" => $email,
                ":telefono" => $telefono,
                ":profesor" => $profesor, // Updated variable name
                ":password" => $cifrado_pass
            ));
        
            echo "Registro insertado";
        
            $resultado->closeCursor();
        
        } catch(Exception $e) {
            echo "Linea del error : " . $e->getLine();
        } finally {
            $base = null;
        }

        header("location: formulario_insertar_usuarios.php");
    ?>
    <p><a href="usuarios_registrados1.php">Volver</p>
    <p><a href="enviar_mensaje.php">Enviar mensaje</a></p>
    <p><a href="mostrar_mensajes.php">Ver mensajes</a></p>
    <p><a href="administrar_grupos.php">Administrar grupos</a></p>
    <p><a href="cierre.php">Cierra sesion</a></p>
</body>
</html>
