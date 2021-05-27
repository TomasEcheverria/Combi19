<?php

    function puede_borrar($unaDB,$idChofer){
        /* $consulta_chofer_viaje_pendiente = "SELECT * FROM usuarios u INNER JOIN combis c ON u.id = c.idu INNER JOIN viajes v ON c.idc = v.idc WHERE u.activo=1 AND v.estado <> 'finalizado'AND u.id =$idChofer ";
        $resultado_consulta_chofer_viaje_pendiente = mysqli_query($unaDB,$consulta_chofer_viaje_pendiente);*/
        $consulta_combis_chofer = "SELECT * FROM `usuarios` INNER JOIN combis ON usuarios.id = combis.idu WHERE usuarios.activo=1 AND id='$idChofer'";
        $resultado_consulta_combi_chofer = mysqli_query($unaDB,$consulta_combis_chofer);
        return (empty(mysqli_fetch_assoc($resultado_consulta_combi_chofer)));
    }

    function get_patente($unaDB,$idChofer){
        $consulta_combi_asociada = "SELECT combis.patente FROM `usuarios`
        INNER JOIN combis
        ON usuarios.id = combis.idu 
        WHERE usuarios.activo=1 AND id='$idChofer'";
        $resultado_consulta_combi_asociada = $unaDB->query($consulta_combi_asociada) or die ($db->error());
        $combi = $resultado_consulta_combi_asociada->fetch_array();
        return $combi['patente'];
    }

    //Definicion de variables y inicializacion BD.
    $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
    $row = '';
    $nombre = '';
    $apellido = '';
    $dni = '';
    $correo = '';
    $clave = '';
    $update = false;
    $id ='';
    $mensaje='';
    $tipo='';
    //Funcionalidad de agregar un Chofer
    if(isset($_POST['submit'])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $dni = $_POST["dni"];
        $password = $_POST["password"];
    
        $email_existe = "SELECT * FROM usuarios WHERE ((email='$email') AND activo=1)";
        $resultado_email_existe = mysqli_query($db,$email_existe);

        // Agrego solo si el email no esta cargado antes en la bd   
        if(empty(mysqli_fetch_assoc($resultado_email_existe))){

            $sql = "INSERT INTO usuarios (`email`, `nombre`, `apellido`, `DNI`, `clave`, `tipo_usuario`, `suspendido`, `suscrito`, `nro_tarjeta`, `cod_seguridad`, `fecha_vencimiento`, `activo`) VALUES
            ('$email', '$firstName', '$lastName', $dni, '$password', 'chofer', 0, 0, NULL, NULL, NULL,1);";
            mysqli_query($db,$sql);
        }

    
        header("Location: ../vista_choferes.php?insert=success");
    }

    //Cambia el boton de submit a update, y trae los datos del chofer correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $sql = "SELECT * from usuarios WHERE activo=1 AND id='$id'";
        $result = $db->query($sql) or die ($db->error());

        //Usuario buscado de la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $dni = $row['DNI'];
            $correo = $row['email'];
            $clave = $row['clave'];
        }
    }

    //Actualiza los datos del chofer seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nombre = $_POST["firstName"];
        $apellido = $_POST["lastName"];
        $dni = $_POST['dni'];
        $correo = $_POST['email'];
        $clave = $_POST['password'];

        $email_existe_edit = "SELECT * FROM usuarios WHERE (((email='$correo') AND (id<>'$id')) AND activo=1)";
        $resultado_email_existe_edit = mysqli_query($db,$email_existe_edit);

        if(empty(mysqli_fetch_assoc($resultado_email_existe_edit))){
            $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', DNI='$dni', email='$correo', clave='$clave' WHERE id='$id'";
            $db->query($sql) or die($db->error);
        }

        
        header("Location: ../vista_choferes.php");
    }

    //baja de choferes
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        if(puede_borrar($db,$id)){
            $sql = "UPDATE usuarios SET activo=0 WHERE activo=1 AND id='$id'";
            mysqli_query($db,$sql);
            header("Location: ../vista_choferes.php");
        } else {
            $patente = get_patente($db,$id);
            header("Location: ../vista_choferes.php?errormsg=1&ptn=$patente");
        };


    }
;



