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


    // Alta de lugares
    if(isset($_POST['submit'])){
        $idaux = $_POST["id"];
        $cantidad_asientos = $_POST["cantidad_asientos"];
        $cantidad_asientos = $cantidad_asientos +1;
        var_dump($idaux);
        var_dump($cantidad_asientos);
        if (false){
            $sql = "INSERT INTO lugares (`provincia`, `nombre`, `activo`) VALUES
            ('$provincia', '$nombre', 1);";
            mysqli_query($db,$sql);
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


    
