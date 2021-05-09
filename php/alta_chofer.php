<?php

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

    //Funcionalidad de agregar un Chofer
    if(isset($_POST['submit'])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $dni = $_POST["dni"];
        $password = $_POST["password"];
    
    
        $sql = "INSERT INTO usuarios (`email`, `nombre`, `apellido`, `DNI`, `clave`, `tipo_usuario`, `suspendido`, `suscrito`, `nro_tarjeta`, `cod_seguridad`, `fecha_vencimiento`, `activo`) VALUES
        ('$email', '$firstName', '$lastName', $dni, '$password', 'chofer', 0, 0, NULL, NULL, NULL,1);";
        mysqli_query($db,$sql);
    
        header("Location: ../vista_choferes.php?insert=success");
    }

    //Cambia el boton de submit a update, y trae los datos del chofer correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $sql = "SELECT * from usuarios WHERE activo=1 AND email='$id'";
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
        $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', DNI='$dni', email='$correo', clave='$clave' WHERE email='$id'";
        $db->query($sql) or die($db->error);
        
        header("Location: ../vista_choferes.php");
    }


