<?php
        include 'classLogin.php';
        $usuario= new usuario();
        // Se obtiene el mail de usuari y queda guardado en $email
        $usuario -> id($id);
        $usuario -> nombre($nombre); 

        $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
        

        // Es obligatorio cambiar el nro_tarjeta por bigint

        if(isset($_POST['suscribirse'])){
            $nombre_tarjeta = $_POST['name'];
            $nro_tarjeta = (int) $_POST['numero_tarjeta'];
            $cvv = $_POST['numero_cvv'];
            $mes = $_POST['mes'];
            $año = $_POST['año'];
            $fecha = "$año-$mes-01";
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

            //actualizar los datos de la sesion
            $_SESSION['fecha_vencimiento'] = $fecha;
            $_SESSION['cod_seguridad'] = $cvv;
            $_SESSION['nro_tarjeta'] = $nro_tarjeta;
            $_SESSION['suscrito'] = 1;
            header("Location: ../vista_perfil.php");
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
             <a href='../vista_perfil.php'>
                 <button class='btn btn-sm btn-success float-right' type='submit' >
                     <i class='mdi mdi-gamepad-circle' id='volver_menu'></i> Volver</button>
                 </div>
             </a>
             ";
            // Actualizar los datos de la sesion
             $_SESSION['fecha_vencimiento'] = NULL;
             $_SESSION['cod_seguridad'] = NULL;
             $_SESSION['nro_tarjeta'] = NULL;
             $_SESSION['suscrito'] = 0;
        }
        //Boton de volver en formulario de tarjeta
        if(isset($_POST['volver'])){
            header("Location: ../vista_perfil.php");
        }
;