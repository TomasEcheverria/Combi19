<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
    $update= false;

    // Alta de insumos
    if(isset($_POST['submit'])){
        $nombre = $_POST["nombre"];
        $inventario = $_POST["inventario"];
        $precio = $_POST["precio"];
    
    
        $sql = "INSERT INTO insumos (`nombre`, `inventario`, `precio`, `activo`) VALUES
        ('$nombre', '$inventario', '$precio', 1);";
        mysqli_query($db,$sql);
    
        header("Location: ../vista_insumos.php");
    }