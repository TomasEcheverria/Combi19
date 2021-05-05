<?php


    require 'includes/database.php';    //conecta a la base de datos
    $db = connectDB();


    //se ejecuta al ingresar datos
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        
        $email = $_POST['email'];       //recupera los datos del input
        $password = $_POST['password'];

        $query = "SELECT * FROM usuarios WHERE email = '${email}' ";    
        $resultado = mysqli_query($db, $query);         //realiza la consulta a la base de datos
        
        
        

        if( $resultado->num_rows ){         

            $usuario = mysqli_fetch_assoc($resultado);      

            if ( $password === $usuario['clave'] ){
                echo "golazo nene";
            } else {
                echo "La contraseña es incorrecta";
            }
            
        } else {
            echo"El mail ingresado no existe";
        }
    }   

//    require 'includes/functions.php';
?> 


   <main>
        <h1>Iniciar Sesión</h1>
        
        <form method="POST" >
            <fieldset>
                <legend>Email y Password</legend>
                <label> E-mail </label>
                <input type="email" name="email" placeholder="Email" id="email" required>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Contraseña" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión">
        </form>
   </main>      