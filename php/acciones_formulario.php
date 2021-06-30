<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    
    if (isset ($_POST['dni'])){
        $dni = $_POST['dni'];  
    } else{
        if (isset ($_GET['idpasajero'])){
            $idpasajero = $_GET['idpasajero'];
        }
    }

    if(isset($_POST['submit'])){
        if ((($_POST['temperatura'] + $_POST['olfato'] + $_POST['afeccion'] + $_POST['garganta']) >= 2) || ($_POST['temperatura']==1)){
            if (isset ($_POST['express'])){
                //resolver express cuando tiene covid
                $suspender = "UPDATE usuarios SET suspendido=1 WHERE dni='$dni'";
                mysqli_query($db,$suspender);
                header("Location: ../vista_compra_express.php?msg=1");

            } else {
                //resolver cuando no es express y tiene covid
                $sql="SELECT * FROM pasajeros WHERE (idpasajero='$idpasajero') AND (activo=1)";
                $pasajero_info = mysqli_query($db,$sql);
                $row = mysqli_fetch_assoc($pasajero_info);
                $idp=$row['idp'];
                $dni=$row['dni'];
                $sql="SELECT * FROM pasajes WHERE (idpasajero='$idp') AND (activo=1)";
                $pasaje_sql = mysqli_query($db,$sql);
                $pasaje_info = mysqli_fetch_assoc($pasaje_sql);
                $idv = $pasaje_info['idv'];
                $tarjeta = $pasaje_info['tarjeta'];
                $sql="SELECT * FROM viajes WHERE (idv='$idv') AND (activo=1)";
                $viaje_sql = mysqli_query($db,$sql);
                $viaje_info = mysqli_fetch_assoc($viaje_sql);
                $precio = $viaje_info['precio'];
                //info necesaria

                $presente = "UPDATE pasajeros SET presente=1, sospechoso_covid=1 WHERE idpasajero='$idpasajero'";
                mysqli_query($db,$presente);
                $pasaje = "UPDATE pasajes SET sospechoso_covid=1 WHERE idp='$idp'";
                // sospechosos y presente

                //Si tiene usuario se suspende BEGIN
                $sql="SELECT * FROM usuarios WHERE (DNI='$dni') AND (activo=1)";
                $usuario_info = mysqli_query($db,$sql);
                $usuario = mysqli_fetch_assoc($usuario_info);
                if (!empty($usuario)){
                    $usuario_sus = "UPDATE usuarios SET suspendido=1 WHERE (DNI='$dni') AND (activo=1)";
                    mysqli_query($db,$usuario_sus);
                }
                //END

                $agregar_pasaje = "INSERT INTO reembolso (`precio`, `tarjeta`, `fecha`, `activo`) VALUES
                    ('$precio', '$tarjeta', 0, 1);";
                mysqli_query($db,$agregar_pasaje);
                
                header("Location: ../vista_compra_express.php?msg=2");
            }

        }else {
            if (isset ($_POST['express'])){           
                //resolver express cuando compra
                $dni = $_POST['dni'];     
                header("Location: ../vista_compra_express.php?d=".$dni);
            } else {
                //resolver no express y compra
                $presente = "UPDATE pasajeros SET presente=1 WHERE idpasajero='$idp'";
                mysqli_query($db,$presente);
                header("Location: ../viaje.php?idv=".$idv);
            }
        }

                  
        echo "Por el momento confio, 1% probabilidades, 99% de fe (?";

    }