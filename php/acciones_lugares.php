<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    $update= false;
    $id =0;
    $codigo_postal = 0;
    $nombre = '';


    // Alta de lugares
    if(isset($_POST['submit'])){
        $codigo_postal = $_POST["codigo_postal"];
        $nombre = $_POST["nombre"];
    
    
        $sql = "INSERT INTO lugares (`codigo_postal`, `nombre`, `activo`) VALUES
        ('$codigo_postal', '$nombre', 1);";
        mysqli_query($db,$sql);
    
        header("Location: ../vista_lugares.php");
    }

    //Baja de lugares
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $sql = "UPDATE lugares SET activo=0 WHERE activo=1 AND codigo_postal='$id'";
        mysqli_query($db,$sql);
        header("Location: ../vista_lugares.php");
    }

    //Cambia el boton de submit a update, y trae los datos del insumo correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $sql = "SELECT * from lugares WHERE activo=1 AND codigo_postal='$id'";
        $result = $db->query($sql) or die("error". mysqli_error ($db));

        //Usuario buscado de la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $codigo_postal = $row["codigo_postal"];
            $nombre = $row["nombre"];
        }
    }
    
    //Actualiza los datos del insumo seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $codigo_postal = $_POST["codigo_postal"];
        $nombre = $_POST["nombre"];
        $sql = "UPDATE lugares SET codigo_postal='$codigo_postal', nombre='$nombre' WHERE codigo_postal='$id'";
        $db->query($sql) or die("error". mysqli_error ($db));
        
        header("Location: ../vista_lugares.php");
    }
    
