<?php
        include 'classLogin.php';
        $usuario= new usuario();
        // Se obtiene el mail de usuari y queda guardado en $email
        $usuario -> id($id);
        $usuario -> nombre($nombre); 

        $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());



        // Se utiliza solo para habilitar la edicion
        if(isset($_POST['edit'])){
            header("Location: ../vista_perfil.php?md=save");
        }

        // se utiliza para guardar los cambios
        if(isset($_POST['save'])){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $dni = $_POST['dni'];
            $contraseña =  $_POST['clave'];

            $sql= "UPDATE usuarios
            SET 
                usuarios.nombre = '$nombre',
                usuarios.apellido = '$apellido',
                usuarios.email = '$email',
                usuarios.DNI = '$dni',
                usuarios.clave = '$contraseña'
            WHERE usuarios.id = '$id'";
            mysqli_query($db,$sql);

            // Actualizacion de los datos de la sesion
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['email'] = $email;
            $_SESSION['DNI'] = $dni;
            $_SESSION['clave'] = $contraseña;
            
            header("Location: ../vista_perfil.php?md=edit&nombre=$nombre");
        }

        if(isset($_POST['suscribirse1'])){
            header("Location: ../vista_suscripcion.php");
        }

        if(isset($_POST['suscribirse2'])){
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