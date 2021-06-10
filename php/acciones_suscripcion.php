<?php
        include 'classLogin.php';
        $usuario= new usuario();
        // Se obtiene el mail de usuari y queda guardado en $email
        $usuario -> id($id);
        $usuario -> nombre($nombre); 
        $usuario -> tipoUsuario($tipo);

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
            $contraseña =  $_POST['clave'];
            $dni = $_POST['dni'];
            switch($tipo){
                case "pasajero":
                    $num_tarjeta =  $_POST['numero_tarjeta'];
                    $cod_seguridad = $_POST['cod_seguridad'];
                    $mes_tarjeta = $_POST['mes_tarjeta'];
                    $año_tarjeta = $_POST['año_tarjeta'];
                    $fecha_vencimiento = "$año_tarjeta-$mes_tarjeta-01";

                    $sql= "UPDATE usuarios
                    SET 
                        usuarios.nombre = '$nombre',
                        usuarios.apellido = '$apellido',
                        usuarios.email = '$email',
                        usuarios.clave = '$contraseña',
                        usuarios.DNI = '$dni',
                        usuarios.nro_tarjeta = $num_tarjeta,
                        usuarios.cod_seguridad = $cod_seguridad,
                        usuarios.fecha_vencimiento = '$fecha_vencimiento'
                    WHERE usuarios.id = '$id'";

                    mysqli_query($db,$sql);
                    
                    //Actualizacion de datos de session
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['apellido'] = $apellido;
                    $_SESSION['email'] = $email;
                    $_SESSION['DNI'] = $dni;
                    $_SESSION['clave'] = $contraseña;
                    $_SESSION['nro_tarjeta'] = $num_tarjeta;
                    $_SESSION['cod_seguridad'] = $cod_seguridad;
                    $_SESSION['fecha_vencimiento'] = $fecha_vencimiento;

                    break;
                case "administrador":
                    $sql= "UPDATE usuarios
                    SET 
                        usuarios.nombre = '$nombre',
                        usuarios.apellido = '$apellido',
                        usuarios.email = '$email',
                        usuarios.clave = '$contraseña',
                        usuarios.DNI = '$dni'
                    WHERE usuarios.id = '$id'";

                    mysqli_query($db,$sql);
                    
                    //Actualizacion de datos de session
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['apellido'] = $apellido;
                    $_SESSION['email'] = $email;
                    $_SESSION['DNI'] = $dni;
                    $_SESSION['clave'] = $contraseña;
                    break;
                case "chofer":
                    break;
            }
             header("Location: ../vista_perfil.php?md=edit&result=3");
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

            //actualizar los datos de la sesion
            $_SESSION['fecha_vencimiento'] = $fecha;
            $_SESSION['cod_seguridad'] = $cvv;
            $_SESSION['nro_tarjeta'] = $nro_tarjeta;
            $_SESSION['suscrito'] = 1;
            header("Location: ../vista_perfil.php?result=1");
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

            // Actualizar los datos de la sesion
             $_SESSION['fecha_vencimiento'] = NULL;
             $_SESSION['cod_seguridad'] = NULL;
             $_SESSION['nro_tarjeta'] = NULL;
             $_SESSION['suscrito'] = 0;
             header("Location: ../vista_perfil.php?result=2");
        }
        //Boton de volver en formulario de tarjeta
        if(isset($_POST['volver1'])){
            header("Location: ../vista_perfil.php");
        }
        if(isset($_POST['volver2'])){
            header("Location: ../vista_perfil.php");
        }
;