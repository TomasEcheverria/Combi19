<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    $id =0;
    $idr = '';
    $nombre = '';
    $precio = "";
    $fecha = "";
    $hora = "";
    $idr = "";
    $idc = "";



    if(isset($_POST['submit'])){
        $idp="";
        $id_viaje = $_POST["id"];
        $id_usuario = $_POST["id_usuario"];
        $cantidad_asientos = $_POST["cantidad_asientos"]+1;
        //Definición de variables

        $pasaje_existe="SELECT * FROM pasajes WHERE (idu='$id_usuario') AND (idv='$id_viaje') AND (activo=1)";
        $resultado_pasaje_existe = mysqli_query($db,$pasaje_existe);
        $row = mysqli_fetch_assoc($resultado_pasaje_existe);
        //Consulta db si existe/fantasma
        
        if (isset($row)){
            if ($row['fantasma']==1){
            //confirma que el viaje existe y es fantasma, entonces para no agregar uno nuevo
            //toma el que ya existe
            //la idea es generar un nuevo pasaje para tener una id que no tenga pasajeros "fantasma"
                echo "entro en row fantasma";
                $idp = $row['idp'];

                $sql = "DELETE FROM pasajes WHERE idp='$idp';";
                $db->query($sql) or die("error". mysqli_error ($db));
                $sql = "DELETE FROM pasajeros WHERE (idp='$idp') AND (activo=0);";
                $db->query($sql) or die("error". mysqli_error ($db));
                
                $agregar_pasaje = "INSERT INTO pasajes (`cantidad_asientos`, `idu`, `idv`, `fantasma`, `activo`) VALUES
                ('$cantidad_asientos', '$id_usuario', '$id_viaje', 1, 1);";           
                mysqli_query($db,$agregar_pasaje);
                
                $pasaje_creado="SELECT * FROM pasajes WHERE (idu='$id_usuario') AND (idv='$id_viaje') AND (activo=1)";
                $resultado_pasaje_creado = mysqli_query($db,$pasaje_creado);
                $row = mysqli_fetch_assoc($resultado_pasaje_creado);
                $idp = $row['idp'];

            } else{
                //si no es fantasma entonces ya tiene el pasaje comprado y activo
                //programar comportamiento
                echo "esta comprado y activo, no se realiza modificacion";
            }


        }else{
            //el pasaje no existe y hay que armar uno nuevo
            echo "no existe y se crea uno nuevo";
             $agregar_pasaje = "INSERT INTO pasajes (`cantidad_asientos`, `idu`, `idv`, `fantasma`, `activo`) VALUES
                ('$cantidad_asientos', '$id_usuario', '$id_viaje', 1, 1);";           
            mysqli_query($db,$agregar_pasaje);
            //ahora debo obtener la id de pasaje
            $pasaje_creado="SELECT * FROM pasajes WHERE (idu='$id_usuario') AND (idv='$id_viaje') AND (activo=1)";
            $resultado_pasaje_creado = mysqli_query($db,$pasaje_creado);
            $row = mysqli_fetch_assoc($resultado_pasaje_creado);
            $idp = $row['idp'];
        }
        $cantidad_asientos = $cantidad_asientos-1;
        
        if ($idp != ""){
            $usuario_consulta = "SELECT nombre, apellido, dni FROM usuarios WHERE (id=$id_usuario) AND (activo=1)";
            $resultado_usuario = mysqli_query($db,$usuario_consulta);
            $usuario_informacion = mysqli_fetch_assoc($resultado_usuario);
            $usuario_nombre = $usuario_informacion['nombre'];
            $usuario_apellido = $usuario_informacion['apellido'];
            $usuario_dni = $usuario_informacion['dni'];

            //consulta para saber si el pasajero existe
            $pasajero_consulta= "SELECT * FROM pasajeros WHERE (dni='$usuario_dni') AND (idp='$idp') AND (activo=0)";
            $resultado_pasajero = mysqli_query($db,$pasajero_consulta);
            $pasajero_informacion = mysqli_fetch_assoc($resultado_pasajero);

            if (isset($pasajero_informacion)){
                //si el pasajero existe y no esta activo, es decir, cancelaron la creacion despues de esta etapa
                //se updatea el existente
                $updatear_pasajero = "UPDATE pasajeros SET nombre='$usuario_nombre', apellido='$usuario_apellido' WHERE (idp='$idp') AND (dni='$usuario_dni')";
                $db->query($updatear_pasajero) or die("error". mysqli_error ($db));  
                echo "pasajero existente updateado";
            } else{
                //si no existe el pasajero se crea
                $agregar_pasajero = "INSERT INTO pasajeros (`nombre`, `apellido`, `dni`, `idp`, `activo`) VALUES
                    ('$usuario_nombre', '$usuario_apellido', '$usuario_dni', '$idp', 0);"; 
                mysqli_query($db,$agregar_pasajero);
                echo "pasajero nuevo creado";
            }
            
            if ($cantidad_asientos== 0){
                //reidirigir a la seleccion de insumos
                header("Location: ../vista_carga_insumos.php?idp='$idp'");
            } else {
                //reidirigir a la especificiacion de nombre apellido y dni de los pasajeros "invitados"
                    var_dump($idp);
                    var_dump($cantidad_asientos);
                    header("Location: ../vista_pasajeros.php?idp=".$idp."&ca=".$cantidad_asientos); 
            }
        } else {
            echo "No se que hiciste";
            //al final de todo debe tener una idp si o si, no debe haber manera de que llegue a este punto, lo dejo como debug por el momento
        }

        

    }


    if(isset($_GET['ver'])){
        $id = $_GET['ver'];
        $update = true;
        $sql = "SELECT * from viajes WHERE activo=1 AND idv='$id'";
        $result = $db->query($sql) or die("error". mysqli_error ($db));

        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $precio = $row["precio"];
            $fecha = $row["fecha"];
            $hora = $row["hora"];
            $idr = $row["idr"];
            $idc = $row["idc"];
        }

    }


    
