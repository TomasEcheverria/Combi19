<?php
    $row = '';
    $nombre = '';
    $apellido = '';
    $dni = '';
    $correo = '';
    $clave = '';

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
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

