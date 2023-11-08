<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php

        $usuario= $_POST["usu"];
        $password= $_POST["pass"];

        #ciframos la password del ususario

        $cifrado_pass=password_hash($password, PASSWORD_DEFAULT);
    
        try{

            $base=new PDO('mysql:host=localhost; dbname=pruebas', 'root', '');

            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $base->exec("SET CHARACTER SET utf8");

            $sql="INSERT INTO USUARIOS (USUARIO,PASSWORD) VALUES (:usu, :contra)";
            $resultado=$base->prepare($sql);
            $resultado->execute(array(":usu"=>$usuario, ":pass"=>$cifrado_pass));

            echo "Registro insertado";

            $resultado->closeCursor();

        }catch(Exception $e){

            echo "Linea del error" . $e->getLine();
        }finally{
            $base=null;
        }
    
    
    
    ?>




</body>
</html>