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

            #almacenamos en login y password lo introducido en login y password
        
            $login=htmlentities(addslashes($_POST["login"]));
            $password=htmlentities(addcslashes($_POST["password"]));

            $contador=0;


            #hacemos la conexion con la bbdd

            $base= NEW PDO("mysql:host=localhost; dbname=pruebas", "root", "");

            #se establecen los atributos de la conexion

            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            #consultamos la tabla por los login

            $sql="SELECT * FROM USUARIOS_PASS WHERE USUARIOS= :login";

            #creamos la consulta preparada, luego la ejecutamos metiendo en el marcador :login lo que el usuario metio en login

            $resultado=$base->prepare($sql);

            $resultado=execute(array(":login"=>$login));

                #con la funcion fetch y el array fetchassoc recorremos el resultado y lo almacenamos en el array $registro

                while($registro=$resultado)->fetch(PDO::FETCH_ASSOC){

                    #passwordverify devuelve true si la contra cifrada y la que introduzco son iguales
                    if(password_verify($password, $registro['PASSWORD'])){
                        
                        $contador++;

                    }
                }

                if($contador)


            $resultado->closeCursor();    

        }catch{

            die("Error: " . $e->getMessage());
        }

    
    
    
    
    
    ?>




</body>
</html>
