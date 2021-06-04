<?php
        include 'classLogin.php';
        $usuario= new usuario();
        // Se obtiene el mail de usuari y queda guardado en $email
        $usuario -> id($id);
        $usuario -> nombre($nombre); 

        $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
        $nombre_tarjeta = $_POST['name'];
        $nro_tarjeta = (int) $_POST['numero_tarjeta'];
        $cvv = $_POST['numero_cvv'];
        $mes = $_POST['mes'];
        $año = $_POST['año'];
        $fecha = "$año-$mes-01";
        $tipo = gettype($nro_tarjeta);
        
        // Es obligatorio cambiar el nro_tarjeta por bigint

        if(isset($_POST['suscribirse'])){
            $sql= "UPDATE usuarios
            SET 
                usuarios.suscrito = 1,
                usuarios.nro_tarjeta = $nro_tarjeta,
                usuarios.cod_seguridad = $cvv,
                usuarios.fecha_vencimiento = '$fecha'
            WHERE usuarios.id = '$id'";
            mysqli_query($db,$sql);

            echo "<h1>Gracias $nombre por suscribirte a Combi19!!</h1>".
            "
            <a href='../pagprincipal.php'>
                <button class='btn btn-sm btn-success float-right' type='submit' >
                    <i class='mdi mdi-gamepad-circle' id='volver_menu'></i> Volver</button>
                </div>
            </a>
            ";
            $_SESSION['suscrito'] = 1;
        }


        //Si se selecciona la opcion de desuscribirse.
        if(isset($_POST['desuscribirse'])){
            $sql= "UPDATE usuarios
            SET 
                usuarios.suscrito = 0,
                usuarios.nro_tarjeta = NULL,
                usuarios.cod_seguridad = NULL,
                usuarios.fecha_vencimiento = NULL
            WHERE usuarios.id = '$id'";
            mysqli_query($db,$sql);
            echo "<h1>Te acabas de desuscribir de Combi19 :(</h1>".
             "
             <a href='../pagprincipal.php'>
                 <button class='btn btn-sm btn-success float-right' type='submit' >
                     <i class='mdi mdi-gamepad-circle' id='volver_menu'></i> Volver</button>
                 </div>
             </a>
             ";
             $_SESSION['suscrito'] = 0;
        }

        if(isset($_POST['volver'])){
            header("Location: ../vista_suscripcion.php");
        }
;