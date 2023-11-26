<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <?php
    
        try{

            $base=new PDO("mysql:host=localhost; dbname= NOMBREDELABASEDETADOS", /* Usuario */"root",/* Password */"");

            #establecer propiedades de la conexion. El objeto conexion llama a la funcion setAttribute

            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            #instruccion sql que mira en la bbdd si existe o no el usuario

            $sql="SELECT * FROM PASS_USUARIOS WHERE USUARIO= :login AND PASSWORD= :password ";

            $resultado=$base->prepare($sql);

            #crear variable login y password para almacenar el login y el password

            #htmlentities convierte cualquier simbolo en html y addslashes evita simbolos, para evitar la injeccion sql

            $login=htmlentities(addslashes($_POST["login"]));
            $password=htmlentities(addslashes($_POST["password"]));

            #asignamos los marcadores con sus variables login y password

            $resultado->bindValue(":login, $login");
            $resultado->bindValue(":password, $password");
            $resultado->execute();


            #contamos las filas y luego evaluamos si existe el usuario (devuelve 0 si no lo encuentra)

            $numero_registro=$resultado->rowCount();
            if($numero_registro !=0){

                #redireccionamos hacia la pagina si existe usuario
                #iniciamos tambien la sesion para el usuario

                session_start();
                $_SESSION["usuario"]=$_POST["login"];

                header("location:usuarios_registrados1.php");

            }else{
                #si no existe volvemos al login
                header("location:login.php");
            }





        }catch(Exception $e){

            die ("Error: " . $e->getMessage());
        }

    
    
    
    
    
    ?>




</body>
</html>
